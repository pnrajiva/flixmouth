<?php
function remove_settings_options() {
    
    bp_core_remove_nav_item('settings');


}
add_action( 'bp_setup_nav', 'remove_settings_options' );
?>
