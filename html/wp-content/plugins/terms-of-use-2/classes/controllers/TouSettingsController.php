<?php
class TouSettingsController{
    function TouSettingsController(){
        add_action('admin_menu', array( &$this, 'menu'));
    }
    
    function menu(){
        add_submenu_page(TOU_ADMIN_EDIT_PAGE, TOU_PLUGIN_TITLE .' | '. __('Edit', 'terms_of_use'), __('Edit', 'terms_of_use'). ' '. TOU_PLUGIN_TITLE, 'administrator', 'terms-of-use-settings', array(&$this,'route'));
    }

    function display_form($errors='', $message=''){
        global $tou_settings;
      
        $pages = TouAppHelper::get_pages();
        $page_count = count($pages);
        $half_pages = ceil($page_count/2);
        
        $admin_page_list = array(
            'index.php' => 'All Admin pages', 'themes.php' => 'Themes', 
            'post-new.php' => 'New Post', 'page-new.php' => 'New Page', 
            'media-new.php' => 'New Media', 'profile.php' => 'Profile'
        );

        $admin_menu_options = array(
            'index.php' => 'Dashboard', 'tools.php' => 'Tools', 
            'options-general.php' => 'Settings', 'profile.php' => 'Profile'
        );

        require_once(TOU_VIEWS_PATH . '/settings/form.php');
    }

    function process_form(){
        global $tou_settings;
      
        $errors = $tou_settings->validate($_POST,array());
        $tou_settings->update($_POST);

        if( empty($errors) ){
            $tou_settings->store();
            $message = __('Settings Saved', 'terms_of_use');
        }
        
        $this->display_form($errors, $message);
    }

    function route(){
        $action = TouAppHelper::get_param('action');
        if($action == 'process-form')
            return $this->process_form();
        else
            return $this->display_form();
    }

}