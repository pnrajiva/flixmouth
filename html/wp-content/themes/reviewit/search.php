<?php get_header();

// Review Stars Styling		
if($theme_skin == "Light") {
$stars = 'reviewit_stars_light';
} else {
$stars = 'reviewit_stars_default';
}
		
?>

<div id="main-content" class="main-content-other">

	<h2 class="page-title"><?php echo $wp_query->found_posts; ?> <?php echo gp_search_results; ?> "<?php echo esc_html($s); ?>"</h2>

	<form name="revieworderform">
		<select name="revieworder" id="revieworder" OnChange="location.href=revieworderform.revieworder.options[selectedIndex].value">
		<option selected><?php echo gp_sort_results_by; ?>...</option>
		
		<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>"><?php echo gp_sort_by_most_relevant; ?></option>
		
		<?php if($theme_our_rating_type == "1") { ?>
			<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;gdsr_sort=review&amp;gdsr_multi=<?php echo($theme_our_rating_multi_id); ?>&amp;gdsr_order=DESC"><?php echo gp_sort_review_score_highest; ?></option>			
		<?php } else { ?>
			<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;gdsr_sort=review&amp;gdsr_order=DESC"><?php echo gp_sort_review_score_highest; ?></option>	
		<?php } ?>
		
		<?php if($theme_your_rating_type == "1") { ?>
			<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;gdsr_sort=rating&amp;gdsr_multi=<?php echo($theme_your_rating_multi_id); ?>&amp;gdsr_order=DESC"><?php echo gp_sort_user_score_highest; ?></option>
		<?php } else { ?>
			<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;gdsr_sort=rating&amp;gdsr_order=DESC"><?php echo gp_sort_user_score_highest; ?></option>	
		<?php } ?>

		<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;orderby=date&amp;order=DESC"><?php echo gp_sort_by_date_newest; ?></option>
		
		<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;orderby=date&amp;order=ASC"><?php echo gp_sort_by_date_oldest; ?></option>
		
		<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;orderby=title&amp;order=ASC"><?php echo gp_sort_by_title_az; ?></option>
		
		<option value="<?php bloginfo('url'); ?>/?s=<?php echo esc_html($s); ?>&amp;orderby=title&amp;order=DESC"><?php echo gp_sort_by_title_za; ?></option>	
		
		</select>
	</form>
	
	<div class="clear"></div>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); $post_type = get_post_type($post); ?>
	
		<?php require('post-loop.php'); ?>
	
	<?php endwhile; ?>
	
		<?php gp_pagination(); ?>
	
	<?php else : ?>	
	
		<h4><?php echo gp_search_error; ?></h4>
	
		<div class="divider"></div>
		
		<h3><?php echo gp_search_site; ?></h3>
		<?php get_search_form(); ?>	
	
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>