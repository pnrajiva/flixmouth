<?php get_header(); ?>
		
<div id="main-content" class="main-content-other<?php if(get_post_meta($post->ID, 'ghostpool_layout', true) == "Full Width") { ?> fullwidth<?php } ?>">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2 class="page-title"><?php the_title(); ?></h2>

		<?php the_content(); ?>
	
		<?php wp_link_pages('before=<div class="wp-pagenavi post-navi">&pagelink=<span>%</span>&after=</div>'); ?>		
		
		<?php comments_template(); ?>
		
	<?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>