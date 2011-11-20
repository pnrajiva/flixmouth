<?php
class TouAppController{
    function TouAppController(){
        add_action('admin_menu', array( &$this, 'menu'));
        add_filter( 'plugin_action_links_terms-of-use-2', array( &$this, 'settings_link'), 10, 2 );
        add_shortcode('terms-of-use', array(&$this, 'get_terms'));
        add_shortcode('privacy-policy', array(&$this, 'get_privacy_policy'));
        add_filter('the_content', array(&$this, 'check_for_shortcode'), 9);
        if(isset($_GET) and isset($_GET['page']) and preg_match('/terms-of-use*/', $_GET['page'])){
            add_action('admin_init', array(&$this, 'admin_scripts'));
        }else{
            add_action('admin_head', array(&$this, 'admin_check'));
        }
        
        //insert agreement
        add_action('frm_entry_form', array(&$this, 'add_frm_field'), 100, 3);
        add_action('register_form', array(&$this, 'add_registration_field'), 900);
        add_action('signup_extra_fields', array(&$this, 'add_registration_field'), 900); //WPMU
        add_action('signup_hidden_fields', array(&$this, 'add_hidden_fields'));
        
        //validate agreement
        add_filter('frm_validate_entry', array(&$this, 'validate_frm_form'), 10, 2);
        add_filter('registration_errors', array(&$this, 'validate_registration'));
        add_filter('wpmu_validate_user_signup', array(&$this,'validate_registration')); //WPMU
        
        //save agreement
        add_action('frm_after_create_entry', array(&$this, 'save_frm_agreement'), 10, 2);
        add_action('init', array(&$this, 'set_cookie'));
        add_action('user_register', array(&$this, 'save_registration'));
        add_filter('add_signup_meta', array(&$this, 'add_registration_meta'));
        add_action('wpmu_activate_user', array(&$this, 'save_agreement'), 10, 3);
        
        //comment form
        add_action('comment_form', array(&$this, 'comment_terms'));
        add_filter('preprocess_comment', array(&$this, 'check_comment_agreement'), 1);
        add_action('comment_post', array(&$this, 'save_for_comment'));
        add_filter('manage_edit-comments_columns', array(&$this, 'add_comment_column_header'));
        add_action('manage_comments_custom_column', array(&$this, 'add_comment_column'), 10, 2 );
        
        //show agreement
        add_action('frm_show_entry', array(&$this, 'show_frm_date'));
        add_action('show_user_profile', array(&$this, 'show_date'), 200);
        add_action('edit_user_profile', array(&$this, 'show_date'), 200);
        add_filter('manage_users_columns', array(&$this, 'add_admin_column_header'));
        add_action('manage_users_custom_column', array(&$this, 'add_user_column'), 10, 3 );
    }
    
    function menu(){
        global $user_ID, $tou_settings;

        add_submenu_page($tou_settings->menu_page, TOU_PLUGIN_TITLE, TOU_PLUGIN_TITLE, 'read', 'terms-of-use-conditions', array(&$this, 'route'));

        if (!current_user_can('administrator') and //if not an admin
        !TouAppHelper::get_user_meta($user_ID, 'terms_and_conditions') and //if hasn't agreed
        !isset($_POST) and in_array('index.php', (array)$tou_settings->admin_page)){
            global $menu;
            foreach ( $menu as $id => $data )
                unset($menu[$id]);
        }    
        
    }
    
    function route(){
        $action = TouAppHelper::get_param('tou_page');
        if($action == 'tou')
            return $this->welcome_message();
        else
            return $this->get_terms(array('admin' => true, 'echo' => true));
    }
        
    // Adds a settings link to the plugins page
    function settings_link($links){
        $settings_link = '<a href="'. admin_url(TOU_ADMIN_EDIT_PAGE). '?page=terms-of-use-settings">' . __('Settings', 'terms_of_use') . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }
    
    function admin_scripts(){
        add_action( 'admin_print_footer_scripts', 'wp_tiny_mce', 25 );
        if ( user_can_richedit() )
        	wp_enqueue_script('editor');
    }
    
    //check if the user has agreed to the terms and conditions
    function admin_check(){
        global $user_ID, $tou_settings;
        if (current_user_can('administrator')) 
            return;

        $current_page = false;
        if ($_SERVER["REQUEST_URI"] and !empty($tou_settings->admin_page)){
            foreach((array)$tou_settings->admin_page as $admin_page){
                if($current_page)
                    continue;
                    
                $current_page = strpos($_SERVER["REQUEST_URI"], $admin_page);
            }
        }
        
        if(!TouAppHelper::get_user_meta($user_ID, 'terms_and_conditions') and 
            (empty($tou_settings->admin_page) or in_array('index.php', (array)$tou_settings->admin_page) or $current_page)){
                
                die("<script type='text/javascript'>location='". admin_url($tou_settings->menu_page) ."?page=terms-of-use-conditions'</script>");
        }
    }
    
    

    /*****************************SHORTCODE*****************************/
    function get_terms($atts=array()) {
        extract(shortcode_atts(array('display' => true, 'admin' => false, 'echo' => false), $atts));
        
        global $user_ID, $tou_settings;
        
        $content = '';
        $url = get_bloginfo('url');
        
        $tou_name = stripslashes($tou_settings->site_name);
        if(!$tou_name)
            $tou_name = get_option('blogname');

        $atts['terms'] = '';
        $atts['privacy_policy'] = '';
        
        foreach(array('terms', 'privacy_policy', 'member_agreement', 'agree', 'welcome') as $info){
            $atts[$info] = str_replace('[website-name]', $tou_name, stripslashes($tou_settings->{$info}));
            $atts[$info] = wpautop(str_replace('[website-url]', $url, $atts[$info]));
        }
        
        $atts['error'] = '';
        $atts['referer'] = (isset($_POST) and isset($_POST['tou_referer'])) ? $_POST['tou_referer'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        $atts['initials'] = (isset($_POST) and isset($_POST['initials'])) ? $_POST['initials'] : ''; 

        $atts['show_buttons'] = true;
        //if user has already agreed, show the terms for reference
        if (TouAppHelper::get_user_meta($user_ID, 'terms_and_conditions')) 
            $atts['show_buttons'] = false;

        $atts['disagree_url'] = wp_logout_url();
        
        if ($admin)
           $content .= '<div class="wrap tou">';
           
        if (!is_admin()){
            $atts['disagree_url'] = $url;
            $atts['show_buttons'] = (isset($_GET['redirected']) or !$display) ? true : false;
            
            if (isset($_POST) and isset($_POST['terms-and-conditions'])){
                if ($tou_settings->initials and !$_POST['initials']){ //the agreement page
                    $atts['error'] = __('You must enter your initials', 'terms_of_use');
                	$content .= TouAppHelper::get_include_contents('classes/views/shared/agreement_form.php', $atts);
                	return $content;
                }
                	
                if ($user_ID)
                    TouAppHelper::save_meta($user_ID, $atts['initials']);
                
                if(is_page($tou_settings->terms_url)){
                    $referrer = (isset($_POST['tou_referrer'])) ? $_POST['tou_referrer'] : $url;
                }else{
                    global $post;
                    $referrer = get_permalink($post->ID);
                }
                die("<script type='text/javascript'>location='". $referrer ."' </script>");
            }else{
                if ($atts['show_buttons'])
                    $content .= TouAppHelper::get_include_contents('classes/views/shared/agreement_form.php', $atts);
                else    
                    $content .= $atts['terms'];
            }
        
        //Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
        }else if(isset($_POST) and isset($_POST['terms-and-conditions'])){
            //update current users terms_and_conditions

            if ($tou_settings->initials and !$_POST['initials']){ //the agreement page
                $atts['error'] = __('You must enter your initials', 'terms_of_use');
            	$content .= TouAppHelper::get_include_contents('classes/views/shared/agreement_form.php', $atts);
            }else{
                TouAppHelper::save_meta($user_ID, $initials);

                //display welcome message.
                $content .= $atts['welcome'];
            }
        }else{  //the agreement page
            $content .= TouAppHelper::get_include_contents('classes/views/shared/agreement_form.php', $atts);
        }
        
        if ($admin)
           $content .= '</div>';

        if($echo)
            echo $content;
        else
            return $content;
    }
    
    function get_privacy_policy($atts=array()){
        global $tou_settings;
        
        $url = get_bloginfo('url');
        
        $tou_name = stripslashes($tou_settings->site_name);
        if(!$tou_name)
            $tou_name = get_option('blogname');
            
        $privacy = str_replace('[website-name]', $tou_name, stripslashes($tou_settings->privacy_policy));
        $privacy = wpautop(str_replace('[website-url]', $url, $privacy));
        
        return $privacy;
    }
    
    function welcome_message(){
        global $tou_settings;
        
        $tou_name = stripslashes($tou_settings->site_name);
        if(!$tou_name)
            $tou_name = get_option('blogname');
            
        $welcome = str_replace('[website-name]', $tou_name, stripslashes($tou_settings->welcome)); ;
        
        include(TOU_VIEWS_PATH . '/shared/welcome.php');
    }
    
    function check_for_shortcode($content){
        global $post, $tou_settings;
        if ($post and isset($tou_settings->terms_url) and ($tou_settings->terms_url == $post->ID) and $content == ''){
            $content = $this->get_terms();
        }else{ 
            //check if terms are required on front-end
            global $current_user;

            if (empty($tou_settings->frontend_page) or 
                ($post and !in_array($post->ID, (array)$tou_settings->frontend_page)) or 
                ($current_user and isset($current_user->terms_and_conditions)) or
                (isset($_COOKIE['terms_user_' . COOKIEHASH]) and !isset($tou_settings->cleared_on)) or 
                (isset($_COOKIE['terms_user_' . COOKIEHASH]) and isset($tou_settings->cleared_on) and isset($_COOKIE['terms_user_date_' . COOKIEHASH]) and (strtotime($tou_settings->cleared_on) < strtotime($_COOKIE['terms_user_date_' . COOKIEHASH]))))
                return $content; //terms are not required

            if (is_numeric($tou_settings->terms_url))
                return $this->get_terms(array('display' => false));
            else
                die("<script type='text/javascript'>location='". add_query_arg('redirected', 'true', $tou_settings->terms_url) ."' </script>");
        }

        return $content;
    }
    
    
    /*****************************REGISTER/SIGNUP***********************/
    function add_frm_field($form, $action, $errors=''){
        global $tou_settings;

        if(isset($tou_settings->frm_forms) and in_array($form->id, (array)$tou_settings->frm_forms) and
            isset($tou_settings->terms_url) and $tou_settings->terms_url != '' and ($action == 'create' or $action == 'new')){
            TouAppHelper::insert_checkbox($errors, 'formidable');
        }
    }
    
    function add_registration_field($errors=''){
        global $tou_settings;
        if($tou_settings->signup_page and isset($tou_settings->terms_url) and $tou_settings->terms_url != ''){
            TouAppHelper::insert_checkbox($errors);
        }
    }
    
    function add_hidden_fields(){
        global $user_ID;
        if ($value = TouAppHelper::get_user_meta( $user_id, 'tou_initials' ))
            echo '<input type="hidden" name="tou_initials" id="tou_initials" value="'.$value.'" />';
        else if (isset($_POST['tou_initials']) and $_POST['tou_initials'])
            echo '<input type="hidden" name="tou_initials" id="tou_initials" value="'.$_POST['tou_initials'].'" />';

        if ($value or (isset($_POST['terms']) and $_POST['terms']))
            echo '<input type="hidden" name="terms" id="terms" value="1" />';    
    }

    function validate_frm_form($errors, $values){
        global $user_ID, $tou_settings;

        if(isset($tou_settings->frm_forms) and in_array($values['form_id'], (array)$tou_settings->frm_forms)){
            if(isset($values['action']) and $values['action'] == 'update')
                return $errors;
                
            if ($tou_settings->initials and isset($_POST['tou_initials']) and !$_POST['tou_initials'])
                $errors['tou_initials'] = $tou_settings->initials_error;

            if (!isset($_POST['terms']))
                $errors['terms'] = $tou_settings->terms_error;
        }        
        return $errors;
    }
        
    function validate_registration($errors){
        global $user_ID, $tou_settings;

        if(is_admin() or !$tou_settings->signup_page)
            return $errors;
            
        if ($tou_settings->initials and !$_POST['tou_initials']){
            if (IS_WPMU)
                $errors['errors']->add('tou_initials', $tou_settings->initials_error);
            else
                $errors->add('tou_initials', '<strong>'. __( 'ERROR', 'terms_of_use' ).'</strong>: '. $tou_settings->initials_error);
        }

        if (!isset($_POST['terms'])){
            if (IS_WPMU)
                $errors['errors']->add('terms', $tou_settings->terms_error);
            else
                $errors->add('terms', '<strong>'. __( 'ERROR', 'terms_of_use' ).'</strong>: '. $tou_settings->terms_error );   
        }
      
        return $errors;
    }
    
    function save_frm_agreement($entry_id, $form_id){
        if(!isset($_POST['terms']))
            return;
            
        global $tou_settings, $frm_version, $user_ID;
        
        $value = ($tou_settings->initials and isset($_POST['initials'])) ? $_POST['tou_initials'] : 'agree';
        $v = explode('.', $frm_version);

        if((int)$v[1] > 5 or ((int)$v[1] == 5 and (int)$v[2] > 2))
            FrmEntryMeta::add_entry_meta($entry_id, 0, '', serialize(array('initials' => $value)));
            
        TouAppHelper::save_meta($user_ID, $value);
    }
    
    function set_cookie(){
        global $user_ID;
        
        if ($_POST and isset($_POST['terms-and-conditions']) and !$user_ID){
            global $tou_settings;
            
            $terms_cookie_lifetime = apply_filters('terms_cookie_lifetime', 30000000);
            $cookie_value = ($tou_settings->initials and isset($_POST['initials'])) ? $_POST['initials'] : 'agree';
            setcookie('terms_user_' . COOKIEHASH, $cookie_value, time() + $terms_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
            setcookie('terms_user_date_' . COOKIEHASH, current_time('mysql', 1), time() + $terms_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
        }   
    }
       
    function save_registration($new_user_ID){
        if (!isset($_POST['terms']))
            return;
            
        global $user_ID;
        if($user_ID and $user_ID != $new_user_ID)
            return;
            
        $initials = (isset($_POST['tou_initials']) and $_POST['tou_initials']) ? $_POST['tou_initials'] : '';
        TouAppHelper::save_meta($new_user_ID, $initials);
    }
    
    
    function add_registration_meta($meta){
        if (isset($_POST['tou_initials']) and $_POST['tou_initials'])
            $meta['tou_initials'] = $_POST['tou_initials'];

        if (isset($_POST['terms']) and $_POST['terms'])
            $meta['terms_and_conditions'] = current_time('mysql', 1);
            
        return $meta;
    }
    
    function save_agreement($user_id, $password='', $meta=array()){
        global $wpdb, $tou_settings;

        if (isset($tou_settings->signup_page) and $tou_settings->signup_page and !is_admin()){
            $user_email = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE ID = $user_id" );
            $signup_data = $wpdb->get_var( "SELECT meta FROM $wpdb->signups WHERE user_email = '$user_email'" );
            $meta = unserialize($signup_data);
            
        	$initials = ( isset($meta[ 'tou_initials' ]) and $meta['tou_initials'] ) ? $meta['tou_initials'] : '';
        	$date = ( isset($meta[ 'terms_and_conditions' ]) and $meta['terms_and_conditions'] ) ? $meta['terms_and_conditions'] : false;
            TouAppHelper::save_meta($user_id, $initials, $date);
    	}
    }
    
    /****************************COMMENT FORM***************************/
    function comment_terms($post_id){
        global $tou_settings;

    	if ($tou_settings->comment_form and $tou_settings->terms_url != '')
            TouAppHelper::insert_checkbox('', 'comment');
    }

    //Checks for terms agreement and sets an error session variable if not
    function check_comment_agreement($comment_data) {
    	global $tou_settings;

    	if ($tou_settings->comment_form and $comment_data['comment_type'] == '' ) { // Do not check trackbacks/pingbacks
    	    if (!isset($_POST['terms']))
                wp_die('<strong>'. __( 'ERROR', 'terms_of_use' ) .'</strong>: '. $tou_settings->terms_error);

    	    if ($tou_settings->initials and !$_POST['tou_initials'])
                wp_die('<strong>'. __( 'ERROR', 'terms_of_use' ) .'</strong>: '. $tou_settings->initials_error);
    	}

    	return $comment_data;
    }

    function save_for_comment($comment_id){
        global $tou_settings, $user_ID;
        if ($tou_settings->comment_form){
            $meta_value = ($tou_settings->initials and isset($_POST['tou_initials'])) ? $_POST['tou_initials'] : 'Agreed';
            add_comment_meta($comment_id, 'terms_and_conditions', $meta_value);
            
            TouAppHelper::save_meta($user_ID, $meta_value);
        }
        
        if (empty($_COOKIE['terms_user_' . COOKIEHASH])){
            $terms_cookie_lifetime = apply_filters('terms_cookie_lifetime', 30000000);
            $cookie_value = ($tou_settings->initials and isset($_POST['tou_initials'])) ? $_POST['tou_initials'] : 'agree';
            setcookie('terms_user_' . COOKIEHASH, $cookie_value, time() + $terms_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);   
        }
    }


    /***************************** ADMIN TABLES **********************/
    function add_comment_column_header($column_headers){
        return $this->add_admin_column_header($column_headers, 'comment');
    }

    function add_comment_column($column_name, $comment_id){
        if( $column_name == 'terms' ) {
            global $tou_settings;
    	    if ($tou_settings->comment_form)
                echo get_comment_meta($comment_id, 'terms_and_conditions', true);
        }
    }
    
    function add_admin_column_header($column_headers, $page='user'){
        global $tou_settings;
        if ($page == 'comment' and !$tou_settings->comment_form)
            return $column_headers;
            
    	$column_headers['terms'] = __('Terms of Use', 'terms_of_use ');
        return $column_headers;
    }
    
    function add_user_column($value, $column_name, $user_id){
        if( $column_name == 'terms' ) {
            $date = TouAppHelper::get_user_meta($user_id, 'terms_and_conditions');
            $initials = TouAppHelper::get_user_meta($user_id, 'tou_initials');
            if($date)
                $value = date(get_option('date_format'), strtotime($date));
                
            if($initials and strtolower($initials) != 'agree')
                $value .= ' '. __('by', 'terms_of_use') .' '. $initials;
        }
        
        return $value;
    }
    
    

    /*****************************SHOW AGREEMENT***********************/
    function show_frm_date($entry){
        $metas = FrmEntryMeta::getAll("item_id=$entry->id and field_id=0", ' ORDER BY it.created_at DESC');
        $initials = '';
        foreach($metas as $meta){
            if(!empty($initials))
                continue;
                
            $value = maybe_unserialize($meta->meta_value);
            if(!isset($value['initials']))
                continue;
            
            $initials = $value['initials'];
            $date = $meta->created_at;
            
            unset($meta);
            unset($value);
        }
        
        if(!empty($initials))
            TouAppHelper::show_date($date, $initials); 
    }
    
    function show_date(){
        global $profileuser, $tou_settings;

    	if (isset($tou_settings->show_date) and $tou_settings->show_date and 
    	$date = TouAppHelper::get_user_meta($profileuser->ID, 'terms_and_conditions')){
    	    $initials = TouAppHelper::get_user_meta($profileuser->ID, 'tou_initials');
    	    TouAppHelper::show_date($date, $initials); 
        }

    }


    
}
?>