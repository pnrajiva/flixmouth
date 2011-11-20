<?php
/*
Template Name: Page List
*/
get_header(); ?>
		
<div id="main-content" class="main-content-other<?php if(get_post_meta($post->ID, 'ghostpool_layout', true) == "Full Width") { ?> fullwidth<?php } ?>">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2 class="page-title"><?php the_title(); ?></h2>

		<?php
		$children = wp_list_pages('depth=1&title_li=&child_of='.$post->ID.'&echo=0');
		if ($children) { ?>
		<ul>
			<?php echo $children; ?>
		</ul>
		<?php } ?>
		
	<?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>