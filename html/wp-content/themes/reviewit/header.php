<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset=<?php bloginfo('charset'); ?> />
<title>
<?php if(function_exists('bp_get_options_nav')) { ?>
<?php wp_title('&laquo; ', true, 'right'); ?><?php if(!bp_is_blog_page()) {} else { ?><?php bloginfo('name'); ?><?php } ?>
<?php } else { ?>
<?php wp_title('&laquo; ', true, 'right'); ?> <?php bloginfo('name'); ?>
<?php } ?>
</title>

<?php require(ghostpool_inc . 'options.php'); ?>

<meta name="description" content="<?php if(is_single()) { ?><?php single_post_title(); ?><?php } elseif(is_page()) { ?><?php wp_title('&laquo; ', true, 'right'); ?><?php bloginfo('name'); ?><?php } else { bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php } ?>" /> 

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/reset.css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<?php if($theme_skin == "Light") { ?><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-light.css" media="screen" /><?php } ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/prettyPhoto.css" media="screen" />

<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-ie.css" media="screen" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-ie7.css" media="screen" />
<![endif]-->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if($theme_favicon_ico) { ?><link rel="icon" href="<?php echo($theme_favicon_ico); ?>" type="image/vnd.microsoft.icon" />
<link rel="SHORTCUT ICON" href="<?php echo($theme_favicon_ico); ?>" /><?php } ?>
<?php if($theme_favicon_png) { ?><link rel="icon" type="image/png" href="<?php echo($theme_favicon_png); ?>" /><?php } ?>
<?php if($theme_apple_icon) { ?><link rel="apple-touch-icon" href="<?php echo($theme_apple_icon); ?>" /><?php } ?>

<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>

<?php if($theme_custom_css) { ?><style><?php echo stripslashes($theme_custom_css); ?></style><?php } ?>

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/cufon-yui.js"></script>
<?php if($theme_leaguegothic) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/League_Gothic_400.font.js"></script><?php } ?>
<?php if($theme_quicksand) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/Quicksand_Book_400-Quicksand_Bold_700-Quicksand_Book_Oblique_oblique_400-Quicksand_Bold_Oblique_oblique_700.font.js"></script><?php } ?>
<?php if($theme_journal) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/Journal_400.font.js"></script><?php } ?>
<?php if($theme_chunkfive) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/ChunkFive_400.font.js"></script><?php } ?>
<?php if($theme_sansation) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/Sansation_400-Sansation_700.font.js"></script><?php } ?>
<?php if($theme_vegur) { ?><script src="<?php bloginfo('stylesheet_directory'); ?>/js/fonts/Vegur_400-Vegur_700-Vegur_300.font.js"></script><?php } ?>
<?php if($theme_leaguegothic OR $theme_quicksand OR $theme_sansation OR $theme_journal OR $theme_chunkfive OR $theme_vegur) { ?>
<script>Cufon.replace('h1,h2,h3,h4,h5,h6,#nav li a', {hover: true});
<?php echo stripslashes($theme_cufon_code); ?></script>
<?php } ?>

<script src="<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/jwplayer.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.cookies.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.nivo.slider.js"></script>
<script>var rootFolder='<?php bloginfo('template_directory'); ?>';</script>
<?php echo stripslashes($theme_scripts); ?>

<!-- Facebook Opengraph Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8" />
<meta property="fb:app_id" content="293620923982816" />
<meta property="og:site_name" content="FLIXMOUTH" />

<?php 
if ('review' == get_post_type()) { ?>
<meta property="og:title" content="<?php the_title() ?>" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="og:description" content="Flixmouth: Share your movie reviews and ratings with friends. 
Click on the link to find the movie's current rating" />
<meta property="og:type" content="article" />
<?php
		
		$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
		
		if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
	
			<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
			
		<meta property="og:image" content="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=150&amp;zc=1<?php } ?>" />
							
			<?php } else { ?>
			
				<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
					
		<meta property="og:image" content="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=150&amp;zc=1<?php } ?>"/>
					
				<?php }} ?>	
			
			<?php } ?>
		
		<?php } ?>
<?php } else { ?>
<meta property="og:title" content="Visit Flixmouth" />
<meta property="og:url" content="<?php bloginfo('url') ?>" />
<meta property="og:description" content="Your friend has requested you to visit flixmouth.
flixmouth.com is a community for movie buffs! 
On Flixmouth.com, you can share movie reviews and ratings with friends, form your movie network, start conversations, initiate and participate in movie discussions with your friends, form fan clubs and much more" />
<meta property="og:type" content="article" />
<meta property="og:image" content="http://http://www.flixmouth.com/wp-content/uploads/13-07-2011-12715-1-3.jpg" />
<?php } ?>


</head>					
<body <?php body_class( $class ); ?>>

<script>
	var el = document.getElementsByTagName("html")[0];
	el.className = "";
</script>
<!-- Facebook Script -->

<a id="top"></a>


<!--Begin Page Wrapper-->
<div id="page-wrapper">
	<?php if($theme_community_links == "1") {} else { 
	//if ( is_home() ) { // added by PR fro displaying the language tabs on home page
	?>
	<div class="myst">
	
	<?php $lang_temp = $_SESSION['reglang']; if($lang_temp == 1) { ?>
	<a class="button1" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=1"><span>Hindi</span></a>
	<?php } else { ?>
	<a class="button" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=1"><span>Hindi</span></a>
	 <?php }  ?>
	<?php $lang_temp = $_SESSION['reglang']; if($lang_temp == 2) { ?>
	<a class="button1" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=2"><span>Tamil</span></a>
	<?php } else { ?>
	<a class="button" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=2"><span>Tamil</span></a>
	 <?php }  ?>
	<?php $lang_temp = $_SESSION['reglang']; if($lang_temp == 3) { ?>
	<a class="button1" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=3"><span>Telugu</span></a>
	<?php } else { ?>
	<a class="button" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=3"><span>Telugu</span></a>
	 <?php }  ?>
	<?php $lang_temp = $_SESSION['reglang']; if($lang_temp == 4) { ?>
	<a class="button1" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=4"><span>Malayalam</span></a>
	<?php } else { ?>
	<a class="button" href="<?php bloginfo('url'); ?>/Pra_Session_Button_Language.php?langoption=4"><span>Malayalam</span></a>
	 <?php }  ?>
	
	</div>
	<?php //} ?>
	
	
	<div id="login">
	<?php if(is_user_logged_in()) { ?>	
		<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?> <span>|</span>
		<?php if(function_exists('bp_get_options_nav')) { ?>
		<a href="<?php bloginfo('url'); ?>/members/<?php echo $current_user->user_login; ?>/profile"><?php echo gp_profile; ?></a> <span>|</span>		
		<?php } else { ?>
		<a href="<?php bloginfo('url'); ?>/?author=<?php echo $current_user->ID; ?>"><?php echo gp_profile; ?></a> <span>|</span>
		<?php } ?>
		<a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>"><?php echo gp_logout; ?></a>
		
	<?php } else { ?>
		<a href="#login-box" rel="prettyPhoto">FMLogin</a> <span>|</span>
		<?php if(function_exists('bp_get_options_nav')) { ?>
		<a href="register" rel="register"><?php echo gp_register; ?></a> <span>|</span>
		 <?php jfb_output_facebook_btn(); ?>
                <?php } else { ?>
		<a href="register" rel="register"><?php echo gp_register; ?></a>
		<?php } ?>
	<?php } ?>
	</div>	
	
	<!--Begin Login Box-->
	<?php if($theme_login_link == "1") { } else { ?>
<div id="login-box" class="login-box-hidden">
<?php//CM Begin ?>

    

<?php//CM End?>
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
			
	<div class="clear"></div>
	<?php } ?>
	
	<!--Begin Header Top-->
	<div id="header-top">
			
		<!--Begin Logo-->
		<?php if($theme_custom_logo) { ?>
			<div id="logo">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php echo($theme_custom_logo); ?>" alt="" /></a>
			</div>
		<?php } else { ?>
			<a href="<?php bloginfo('url'); ?>"><div id="logo" class="logo-default"></div></a>
		<?php } ?>
		<!--End Logo-->
		
		<!--Begin Nav-->
		<div id="nav">
		<span id="nav-left"></span>
              
			<?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=header-nav&fallback_cb=null'); ?>
                  
                        
		</div>
		<!--End Nav-->
		
		<?php get_search_form(); ?>
	
	</div>	
	<!--End Header Top-->

	<!--Begin Slider-->
	<?php if(function_exists('bp_get_options_nav') && !bp_is_blog_page()) {} else { if((is_home() && $theme_slider_display == "Homepage") OR $theme_slider_display == "All Pages" OR is_page(explode(',',$theme_slider_pages)) OR is_single(explode(',',$theme_slider_posts))) { require('slider.php'); } } ?>
	<!--End Slider-->
	
	<!--Begin Header Bottom-->
	<div id="header-bottom">
	
		<div id="display-options">
			<?php if((is_home() && $theme_home_ce) OR (is_category() && $theme_gen_cat_ce) OR (is_tax('review_categories') && $theme_review_cat_ce)) { ?>
				<a href="#" id="display-compact"></a><a href="#" id="display-extended"></a>
			<script>
			jQuery(document).ready(function(){
			var display_cookie = jQuery.cookie('display_cookie');
				if (display_cookie == 'compact') {
					jQuery(".review-display").fadeIn("fast").addClass("review-box-top-compact");
					jQuery(".review-display").fadeIn("fast").removeClass("review-box-top-extended");
				} else {
					jQuery(".review-display").fadeIn("fast").addClass("review-box-top-extended");
					jQuery(".review-display").fadeIn("fast").removeClass("review-box-top-compact");
				};
			});
			</script>
			<?php } ?>
		&nbsp;</div>
	
		<?php if(!is_home()) { if($theme_breadcrumbs == "1") {} else { ?><div id="breadcrumbs"><?php echo the_breadcrumb(); ?></div><?php }} ?>
		
		<!--Begin Social Icons-->
		<div id="social-icons">
			<?php if($theme_email) { ?><a href="mailto:<?php echo($theme_email); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_email.png" alt="" /></a><?php } ?>	
			<?php if($theme_rss_button == "0") { ?>
			<a href="<?php if($theme_rss) { ?><?php echo($theme_rss); ?><?php } else { ?><?php bloginfo('rss2_url'); ?><?php } ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_rss.png" alt="" /></a><?php } ?>
			<?php if($theme_twitter) { ?><a href="<?php echo($theme_twitter); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_twitter.png" alt="" /></a><?php } ?>
			<?php if($theme_myspace) { ?><a href="<?php echo($theme_myspace); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_myspace.png" alt="" /></a><?php } ?>
			<?php if($theme_facebook) { ?><a href="<?php echo($theme_facebook); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_facebook.png" alt="" /></a><?php } ?>
			<?php if($theme_digg) { ?><a href="<?php echo($theme_digg); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_digg.png" alt="" /></a><?php } ?>
			<?php if($theme_flickr) { ?><a href="<?php echo($theme_flickr); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_flickr.png" alt="" /></a><?php } ?>
			<?php if($theme_delicious) { ?><a href="<?php echo($theme_delicious); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_delicious.png" alt="" /></a><?php } ?>
			<?php if($theme_youtube) { ?><a href="<?php echo($theme_youtube); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social_youtube.png" alt="" /></a><?php } ?>			
		</div>
		<!--End Social Icons-->
	
	</div>
	<!--End Header Bottom-->
	
	<!--Begin Content Wrapper-->
	<div id="content-wrapper">
