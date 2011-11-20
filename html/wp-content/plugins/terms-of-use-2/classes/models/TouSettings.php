<?php
class TouSettings{
    var $member_agreement;
    var $terms;
    var $privacy_policy;
    var $welcome;
    var $site_name;
    
    var $agree;
    var $cleared_on;
    var $show_date;
    var $initials;

    var $signup_page;
    var $comment_form;
    var $frm_forms;
    var $admin_page;
    var $frontend_page;
    
    var $terms_url;
    var $menu_page;
    
    function TouSetting(){
        $this->set_default_options();
    }
    
    function set_default_options(){
        $settings = $this->default_options();
        
        foreach($settings as $setting => $default){
            if(!isset($this->{$setting}))
                $this->{$setting} = $default;
        }
            
        if (!empty($this->terms_url) and !is_numeric($this->terms_url))
            $this->terms_url = trailingslashit($this->terms_url);

        if(!isset($this->site_name) or !$this->site_name)
            $this->site_name = get_option('blogname');
            
        if(!isset($this->terms))
            $this->terms = TouAppHelper::get_include_contents('classes/views/settings/terms.php');
        
        if(!isset($this->privacy_policy))
            $this->privacy_policy = TouAppHelper::get_include_contents('classes/views/settings/privacy_policy.php');
    }
    
    function default_options(){
        return array(
            'member_agreement' => 'Welcome to [website-name], before you can start using this service, you must read and agree to the Terms of Use and Privacy Policy, including any future amendments.',
            'welcome' => "<h2>Welcome</h2>\nThank you, you are now a full member of [website-name]\n\n<h2>What Now</h2>\n[website-name] is packed with many amazing features. So now that you've got an account, what should you do?",
            'agree' => 'By clicking \"I agree\" you are indicating that you have read and agree to the above Terms of Use and Privacy Policy.',
            'cleared_on' => current_time('mysql', 1),
            'show_date' => 0,
            'initials' => false,
            'signup_page' => false,
            'comment_form' => false,
            'frm_forms' => array(),
            'admin_page' => array('index.php'),
            'frontend_page' => array(),
            'terms_url' => '',
            'menu_page' => 'index.php',
            'agreement_text' => sprintf(__('I have read and agree to the %1$sTerms & Conditions%2$s', 'terms_of_use'), '<a href="[terms-url]">', '</a>'),
            'terms_error' => __( 'Please accept Terms.', 'terms_of_use' ),
            'initials_error' => __( 'Please enter your initials.', 'terms_of_use' )
        );
    }
    
    function validate($params, $errors){
        return $errors;
    }
    
    function update($params){
        $this->member_agreement = $params['member_agreement'];
  	    $this->terms = $params['terms'];
  	    $this->privacy_policy = $params['privacy_policy']; 
  	    $this->welcome = $params['welcome'];
  	    $this->site_name = $params['site_name'];
  	    $this->agree = $params['agree'];  	        
  	    $this->show_date = isset($params['show_date']) ? 1 : 0; 
  	    $this->initials = isset($params['initials']) ? 1 : 0;
  	    $this->signup_page = isset($params['signup_page']) ? 1 : 0;
  	    $this->comment_form = isset($params['comment_form']) ? 1 : 0;
  	    $this->frm_forms = isset($params['frm_forms']) ? (array)$params['frm_forms'] : array();
  	    $this->admin_page = isset($params['admin_page']) ? (array)$params['admin_page'] : array();
  	    $this->frontend_page = isset($params['frontend_page']) ? (array)$params['frontend_page'] : array();
  	    $this->terms_url = isset($params['terms_url']) ? $params['terms_url'] : ''; 
  	    $this->menu_page = isset($params['menu_page']) ? $params['menu_page'] : 'index.php';
  	    $this->agreement_text = isset($params['agreement_text']) ? $params['agreement_text'] : ''; 
  	    $this->terms_error = $params['terms_error'];
  	    $this->initials_error = $params['initials_error'];
  	    
  	    if (isset($params['clear_all']) and $params['clear_all'] == 1){
            global $wpdb;
            $wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE meta_key = 'terms_and_conditions'") );
            $this->cleared_on = current_time('mysql', 1);
        }
    }
    
    function store(){
        // Save the posted value in the database
        if(IS_WPMU)
            update_site_option('tou_options', $this);
        else
            update_option('tou_options', $this);
    }
}