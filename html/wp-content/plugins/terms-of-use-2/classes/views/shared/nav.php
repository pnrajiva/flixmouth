<?php if (is_admin() and current_user_can('administrator')){ 
global $tou_settings;
?>
<div id="button_bar">
<ul class="subsubsub">
    <li><a href="<?php echo admin_url(TOU_ADMIN_EDIT_PAGE) ?>?page=terms-of-use-settings"><?php _e('Edit Terms of Use', 'terms_of_use') ?></a> | </li>
    <li><a href="<?php echo $tou_settings->menu_page ?>?page=terms-of-use-conditions"><?php _e('View Terms of Use', 'terms_of_use') ?></a> | </li>
    <li><a href="<?php echo $tou_settings->menu_page ?>?page=terms-of-use-conditions&amp;tou_page=tou"><?php _e('View Welcome Message', 'terms_of_use') ?></a></li>
</ul>
</div>
<div style="clear:both;"></div>
<?php } ?>