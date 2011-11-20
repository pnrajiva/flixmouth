<?php get_header(); ?>

<!--Begin Main Content-->
<div id="main-content" class="main-content-other attachment">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
		
		<?php the_attachment_link($post->post_ID, true) ?>
		<?php the_content(); ?>
	
		<?php comments_template(); ?>

	<?php endwhile; endif; ?>

</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>