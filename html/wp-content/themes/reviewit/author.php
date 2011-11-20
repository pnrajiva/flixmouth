<?php get_header(); ?>

<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
get_userdatabylogin(get_the_author_login());
(get_the_author_login());
else :
$curauth = get_userdata(intval($author));
endif;
?>

<div id="main-content" class="main-content-other">

	<h2 class="page-title"><?php global $current_user; get_currentuserinfo(); echo $curauth->display_name; ?>'s <?php echo gp_profile; ?></h2>
	
	<div class="profile-avatar">
		<?php echo get_avatar($curauth->ID, '60', $default=get_template_directory_uri().'/images/gravatar.gif'); ?>
	</div>
	
	<div class="profile-options">
	
		<?php if($curauth->ID == $user_ID) { ?>
		<p><a href="<?php bloginfo('url') ?>/wp-admin/"><?php echo gp_dashboard; ?></a> <span>|</span>
		<?php if ( $user_level >= 1 ) { ?><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php"><?php echo gp_write_article; ?></a> <span>|</span><?php } ?>
		<a href="<?php bloginfo('url') ?>/wp-admin/profile.php"><?php echo gp_edit_profile; ?></a></p>
		<?php } ?>
		
		<ul><li><strong><?php echo gp_member_since; ?>:</strong> <?php echo date_i18n("d, F Y", strtotime($curauth->user_registered)); ?></li>
		<?php if($curauth->user_url != "" && $curauth->user_url != "http://") { ?><li><strong><?php echo gp_website; ?>:</strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></li><?php } ?>
		<?php if($curauth->user_description) { ?><li><strong><?php echo gp_bio; ?>:</strong> <?php echo $curauth->user_description; ?></a></li><?php } ?></ul>
		
	</div>
	
	<div class="clear"></div>

	<?php if ( $user_level >= 1 ) { ?>

		<div class="profile-list">
		
			<h3><?php echo gp_recent_posts; ?></h3>
			<?php query_posts('post_type=any&author='.$curauth->ID.'&showposts=10'); if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="row">
				<div class="left"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
				<div class="right"><?php echo gp_posted_on; ?> <?php the_time('d M Y'); ?></div>
			</div>
			
			<?php endwhile; else : ?>
			<?php echo $curauth->nickname ?> <?php echo gp_no_user_posts; ?>.
			<?php endif; ?>
			
		</div>
	
		<div class="clear"></div>
	
	<?php } ?>

	<div class="profile-list">

		<h3><?php echo gp_recent_comments; ?></h3>
	
		<?php
		$thisauthor = get_userdata(intval($author));
		$querystr = "SELECT comment_ID, comment_post_ID, post_title, comment_content
		FROM $wpdb->comments, $wpdb->posts
		WHERE user_id = $thisauthor->ID
		AND comment_post_id = ID
		AND comment_approved = 1
		ORDER BY comment_ID DESC
		LIMIT 10";
		$comments_array = $wpdb->get_results($querystr, OBJECT); if ($comments_array): ?>

		<?php foreach ($comments_array as $comment):setup_postdata($comment); ?>
		
		<div class="row">		
			<a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><strong><?php echo gp_comment_on; ?> <?php echo($comment->post_title) ?></strong></a>
			<?php comment_excerpt($comment->comment_ID); ?>	
		</div>
		
		<?php endforeach; ?>

		<?php else : ?>
		<?php echo $curauth->nickname ?> <?php echo gp_no_user_comments; ?>.
		<?php endif; ?>

	</div>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>