<?php
class TouAppHelper{
    
    function get_param($param, $default=''){
        return (isset($_POST[$param])?$_POST[$param]:(isset($_GET[$param])?$_GET[$param]:$default));
    }
    
    function get_pages(){
      return get_posts( array('post_type' => 'page', 'post_status' => 'publish', 'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'));
    }
    
    function get_user_meta($user_ID, $meta_key){
        if(function_exists('get_user_meta'))
            return get_user_meta($user_ID, $meta_key, true);
        else
            return get_usermeta($user_ID, $meta_key);
    }
    
    function update_user_meta($user_ID, $meta_key, $value){
        if(function_exists('update_user_meta'))
            update_user_meta($user_ID, $meta_key, $value);
        else
            update_usermeta($user_ID, $meta_key, $value);
    }
    
    function save_meta($user_ID, $initials='', $date=false){
        if(!$user_ID)
            return;
            
        if ($initials and !empty($initials))
            TouAppHelper::update_user_meta($user_ID, 'tou_initials', $initials);
        
        if(!$date)
            $date = current_time('mysql', 1);
            
        TouAppHelper::update_user_meta($user_ID, 'terms_and_conditions', $date);
    }
    
    function clear_agreement($user_ID){
        delete_user_meta($user_ID, 'terms_and_conditions');
        delete_user_meta($user_ID, 'tou_initials');
        setcookie('terms_user_' . COOKIEHASH, '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
        setcookie('terms_user_date_' . COOKIEHASH, '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    }
    
    function get_include_contents($filename, $atts=array()) {
        extract($atts);
            
        if (is_file(TOU_PATH.'/'.$filename)) {
            ob_start();
            include(TOU_PATH.'/'. $filename);
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        return false;
    }
    
    function forms_checkboxes( $field_name, $field_value=array(), $cols=1 ){
        if(!class_exists('FrmForm')) return;
        
        global $frm_form;
            
        $forms = $frm_form->getAll("is_template=0 AND (status is NULL OR status = '' OR status = 'published')",' ORDER BY name');
        $count = count($forms);
        $col_count = ceil($count/$cols);
        $width = 100/$cols;
        
        $i = 0;
        foreach($forms as $form){
            if($i == $col_count){ ?>
        </div>
        <div style="width:<?php echo $width ?>%" class="alignleft">
        <?php    
            }
            
            $i++;
        ?>
            <input name="<?php echo $field_name; ?>[]" type="checkbox" value="<?php echo $form->id; ?>" <?php TouAppHelper::checked($field_value, $form->id); ?> /> <?php echo substr(stripslashes($form->name), 0, 50); ?><br/>
        <?php } 
    }
    
    function insert_checkbox($errors='', $location='register'){
        global $tou_settings;

        $terms_url = (is_numeric($tou_settings->terms_url)) ? get_permalink($tou_settings->terms_url) : $tou_settings->terms_url;

        $checked = $initials = '';
        if (!empty($_COOKIE['terms_user_' . COOKIEHASH])){
            $checked = 'checked="checked"';
            $initials = $_COOKIE['terms_user_' . COOKIEHASH];
        }
                
        $agreement_text = str_replace(array('[terms-url]', '[terms_url]'), $terms_url, $tou_settings->agreement_text);
        
        if($location == 'formidable'){
        ?> 
        <div id="frm_field_terms_container" class="form-field form-required">
        <div class="frm_checkbox">
            <input type="checkbox" id="terms" name="terms" class="checkbox" value="1" style="width:auto;" /> 
            <label for="terms" class="checkbox"><?php echo stripslashes($agreement_text) ?></label>
        </div>
        <?php if(is_array($errors) and isset($errors['terms'])){ ?>
        <div class="frm_error"><?php echo $errors['terms'] ?></div>
        <?php } ?>
        </div> 

        <?php if ($tou_settings->initials){ ?>            
        <div id="frm_field_tou_initials_container" class="form-field form-required frm_top_container">
            <label class="frm_primary_label" for="tou_initials"><?php _e('Initials', 'terms_of_use' ) ?></label> 
            <input type="text" name="tou_initials" id="tou_initials" size="4" value="" class="text required" />
            <?php if(is_array($errors) and isset($errors['tou_initials'])){ ?>
            <div class="frm_error"><?php echo $errors['tou_initials'] ?></div>
            <?php } ?>
        </div>
        <?php }
        
        }else{
        if ( IS_WPMU and $location == 'register' and $errmsg = $errors->get_error_message('terms') ){ ?>
        <p class="error"><?php echo $errmsg ?></p>
        <?php } ?>
        
        <p><input type="checkbox" id="terms" name="terms" value="1" <?php echo $checked ?> style="width:auto;"> 
        <label for="terms" class="checkbox"><?php echo stripslashes($agreement_text) ?></label>
        </p>    
        <?php if ($tou_settings->initials){ 
            if ( IS_WPMU and $location == 'register' and $errmsg = $errors->get_error_message('tou_initials') )
                echo "<p class='error'>$errmsg</p>";
        ?>
        <p><label for="tou_initials"><?php _e('Initials', 'terms_of_use') ?></label> 
        <input type="text" name="tou_initials" id="tou_initials" size="4" value="<?php echo $initials ?>" style="width:auto;"></p>    
        <?php }
        }
    }
    
    function checked($values, $current){
        if(in_array($current, (array)$values))
            echo ' checked="checked"';
    }
    
    function show_date($date, $initials='', $html=true){
        global $tou_settings;
    
        if(!$date)
            return;
            
        $content = '';
        if($html)
            $content .= '<p class="description">';

        
        if (isset($tou_settings->initials) and $tou_settings->initials and $initials)
                $content .= $initials;
        
        $content .= ' '. sprintf(__('Agreed to site %1$sTerms & Conditions%2$s on %3$s', 'terms_of_use'), '<a href="'. $tou_settings->menu_page .'?page=terms-of-use-conditions">', '</a>', date(get_option('date_format'), strtotime($date))); 
        
        if($html)
            $content .= '</p>';
        
        if(!$html)
            return $content;
        
        echo $content;
    }
}