<?php
require('./wp-blog-header.php');
?>
<?php if(is_user_logged_in()) { ?>
		<?php global $current_user; get_currentuserinfo();?>
		<?php if(function_exists('bp_get_options_nav')) { header("Location: http://www.flixmouth.com/members/$current_user->user_login/activity/friends/"); ?>


		<?php } else { ?>

		<?php } ?>
		

	
<?php }else { session_start(); $_SESSION['rediroption'] = 2; header("Location: http://www.flixmouth.com/login/");?>



<?php } ?>