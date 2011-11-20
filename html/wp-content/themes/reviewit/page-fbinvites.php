<?php
/**
 * Template Name: Page - Facebook Invites
 *
 * Page to invite friends on Facebook to your website
 *
 * Written by: Tim Nicholson on 1/15/2010
 * Contact Info: tim@xtremelysocial.com, http://xtremelysocial.com
 *
 * Version: 1.0 2010-01-15
 */
?>

<?php if(is_page()) get_header(); ?>
<?php if(is_page()) echo '<div id="content" class="column">'; ?>

<br/>

<h2>Facebook Invite</h2>
<br/>
<p>Invite your friends on facebook to join flixmouth. Lets talk movies!!</p>
<br/>
<form action="<?php echo get_option('siteurl'); ?>/fb_invite-post.php" method="post">
	<p>
        <input name="submit" type="submit" id="submit" tabindex="5" value="Invite Friends on Facebook" /></p>
</form>
<br/>
<br/>
<div class="fb-send" data-font="arial"></div>
<br/>

<br/>



<?php if(is_page()) echo '</div>'; ?>

<?php if(is_page()) get_sidebar(); ?>

<?php if(is_page()) get_footer(); ?>
