<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="main-content" class="main-content-other<?php if(get_post_meta($post->ID, 'ghostpool_layout', true) == "Full Width") { ?> fullwidth<?php } ?>">
		
		<h2><?php the_title(); ?></h2>
				
		<!--Begin Post Meta Details-->
		<div class="post-meta"><?php echo gp_by; ?> <?php the_author(); ?> <?php echo gp_on; ?> <?php the_time('d F Y'); ?> <?php echo gp_in; ?> <?php the_category(', '); ?> <?php echo gp_with; ?> <?php comments_popup_link(gp_no_comments, gp_one_comment, gp_more_comments, 'comments-link', ''); ?> <?php edit_post_link(gp_edit, ' ', ''); ?></div>
		<!--End Post Meta Details-->
		
		<?php the_content(); ?>
		
		<?php wp_link_pages('before=<div class="clear"></div><div class="wp-pagenavi post-navi">&pagelink=<span>%</span>&after=</div>'); ?>
		
		<?php comments_template(); ?>

	</div>

<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>