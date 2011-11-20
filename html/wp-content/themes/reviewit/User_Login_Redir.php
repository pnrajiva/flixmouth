<?php
/**
 * Template Name: User_Login_Redir
 *
 * Page to invite friends on Facebook to your website
 *
 * Written by: Tim Nicholson on 1/15/2010
 * Contact Info: tim@xtremelysocial.com, http://xtremelysocial.com
 *
 * Version: 1.0 2010-01-15
 */
?>
<?php if(is_user_logged_in()) { ?>
<?php $redir_temp = $_SESSION['rediroption'];
global $current_user; get_currentuserinfo();
if($redir_temp == 1)
    {//redirects to buddypress friends page
        echo $current_user->user_login;
        $location= 'http://flixmouth.com/members/'.$current_user->user_login.'/friends/';
        wp_redirect($location);
        exit;
    }
elseif($redir_temp == 2)
    {
        echo $current_user->user_login;
        $location = 'http://flixmouth.com/members/'.$current_user->user_login.'/activity/friends/';
        wp_redirect($location);
        exit;
    }
    else{?>
<a href="<?php bloginfo('url') ?>">Click Here to Continue..</a>
<?php } ?>
<?php } else { ?>

<?php if(is_page()) get_header(); ?>
<?php if(is_page()) echo '<div id="content" class="column">'; ?>

<br/>
<div id="page-wrapper">

<br/>
<h2>Please Login to Access this page</h2>
<a href="#login-box" rel="prettyPhoto">FMLogin</a> <span>|</span>
<?php if(function_exists('bp_get_options_nav')) { ?>
<a href="register" rel="register"><?php echo gp_register; ?></a> <span>|</span>
<?php jfb_output_facebook_btn(); ?>
<?php } else { ?>
<a href="register" rel="register"><?php echo gp_register; ?></a>
<?php } ?>
<br/>
<br/>

<?php } ?>
<!--Begin Login Box-->
	<?php if($theme_login_link == "1") { } else { ?>
<div id="login-box" class="login-box-hidden">
		<?php if(function_exists('bp_get_options_nav') && bp_is_activation_page()) { ?>
			<?php wp_login_form(array('redirect' => get_bloginfo('url'))); ?>
		<?php } else { ?>
			<?php wp_login_form(array('redirect' => "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])); ?>
		<?php } ?>
		<a href="<?php bloginfo('url') ?>/wp-login.php?action=lostpassword"><?php echo gp_lost_password; ?></a>
	</div>
	<?php } ?>
<!--End Login Box-->

	<!--Begin Register Box-->
	<div id="register-box" class="login-box-hidden">
		<?php global $user_ID, $user_identity, $user_level ?>
		<form id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
			<p class="login-username"><label><?php echo gp_username; ?></label>
			<input type="text" name="user_login" id="user_register" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="22" /></p>
			<p class="login-email"><label><?php echo gp_email; ?></label>
			<input type="text" name="user_email" id="user_email" class="input" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="22" /></p>
			<?php do_action('register_form'); ?>
			<p><?php echo gp_email_password; ?></p>
			<p><input type="submit" name="wp-submit" id="wp-register" value="<?php echo gp_register; ?>" tabindex="100" /></p>
		</form>
	</div>
	<!--End Register Box-->

	<div class="clear">
</div>
</div>

<?php if(is_page()) echo '</div>'; ?>



<?php if(is_page()) get_footer(); ?>
