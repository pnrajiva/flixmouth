<?php get_header(); ?>

<?php if(is_tax() && taxonomy_exists('review_categories')) { ?>

	<?php include('review-list.php'); ?>

<?php } else { ?>
	
	<div id="main-content" class="main-content-other">
	
		<h2 class="page-title"><?php echo gp_archives; ?> <?php wp_title(" / "); ?></h2>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<?php require('post-loop.php'); ?>
		
		<?php endwhile; ?>
		
			<?php gp_pagination(); ?>
	
		<?php endif; ?>
	
	</div>
	
	<?php get_sidebar(); ?>

<?php } ?>

<?php get_footer(); ?>