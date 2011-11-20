<?php get_header(); ?>

<div id="main-content" class="main-content-other">

	<h2 class="page-title"><?php single_tag_title(); ?></h2>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php require('post-loop.php'); ?>
	
	<?php endwhile; ?>
	
		<?php wp_pagenavi(); ?>
		
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>