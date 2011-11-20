<?php get_header(); ?>

<div id="main-content" class="main-content-other">

	<h4><?php echo gp_error_404_message; ?></h4>

	<div class="divider"></div>
	
	<h4><?php echo gp_search_site; ?></h4>
	<?php get_search_form(); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>