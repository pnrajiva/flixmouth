<?php
require('./wp-blog-header.php');
?>
<?php if(is_user_logged_in()) { ?>
		<?php global $current_user; get_currentuserinfo();?>
		<?php
                $app_url = "/members/$current_user->user_login/activity/friends/";
                $nav_url = site_url($app_url,'http');
                if(function_exists('bp_get_options_nav')) {
                  echo $nav_url;   //wp_redirect(nav_url); ?>
		<?php } else { ?>
		
		<?php } ?>
		

	
<?php }else { session_start(); $_SESSION['rediroption'] = 2; header("Location: http://www.flixmouth.com/login/");?>



<?php } ?>