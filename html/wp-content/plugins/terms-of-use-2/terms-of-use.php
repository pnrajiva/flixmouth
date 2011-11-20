<?php
/*
Plugin Name: Terms of Use
Plugin URI: http://strategy11.com/terms-of-use-2-wordpress-plugin/
Description: Require users to agree to terms and conditions on first login, registration, comment form, or first access to specified page.
Author: Strategy11
Author URI: http://strategy11.com
Version: 2.0
*/

// Check for WPMU installation
if (!defined ('IS_WPMU')){
    global $wpmu_version;
    $is_wpmu = ((function_exists('is_multisite') and is_multisite()) or $wpmu_version) ? 1 : 0;
    define('IS_WPMU', $is_wpmu);
}

load_plugin_textdomain('terms_of_use', false, 'terms-of-use-2/languages/' );
   
define('TOU_PLUGIN_TITLE', __('Terms of Use', 'terms_of_use'));
define('TOU_PATH', WP_PLUGIN_DIR.'/terms-of-use-2');
define('TOU_MODELS_PATH', TOU_PATH.'/classes/models');
define('TOU_VIEWS_PATH', TOU_PATH.'/classes/views');
define('TOU_HELPERS_PATH', TOU_PATH.'/classes/helpers');
define('TOU_CONTROLLERS_PATH', TOU_PATH.'/classes/controllers');

define('TOU_URL', WP_PLUGIN_URL.'/terms-of-use-2');
define('TOU_ADMIN_EDIT_PAGE', 'options-general.php');

require_once(TOU_MODELS_PATH.'/TouSettings.php');

require_once(TOU_HELPERS_PATH. '/TouAppHelper.php');

/***** SETUP SETTINGS OBJECT *****/
global $tou_settings;
if(IS_WPMU)
    $tou_settings = get_site_option('tou_options');
else
    $tou_settings = get_option('tou_options');

// If unserializing didn't work
if(!is_object($tou_settings)){
    if($tou_settings and is_string($tou_settings))
        $tou_settings = unserialize($tou_settings);

    // If it still isn't an object then let's create it
    if(!is_object($tou_settings))
        $tou_settings = new TouSettings();

    if(IS_WPMU)
        update_site_option('tou_options', $tou_settings);
    else
        update_option('tou_options', $tou_settings);
}

$tou_settings->set_default_options(); // Sets defaults for unset options


// Instansiate Controllers
require_once(TOU_CONTROLLERS_PATH . "/TouAppController.php");
require_once(TOU_CONTROLLERS_PATH . "/TouSettingsController.php");

global $tou_app_controller;
global $tou_settings_controller;

$tou_app_controller         = new TouAppController();
$tou_settings_controller    = new TouSettingsController();