<?php

// Get Review Slug
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

// Get Taxonomy
$tax_name = get_taxonomy(get_query_var('taxonomy'));

// Review Stars Styling
if($theme_skin == "Light") {
$stars = 'reviewit_stars_light';
} else {
$stars = 'reviewit_stars_default';
}

//added by prashanth - to get session variable of the selected movie region
$lang_temp = $_SESSION['reglang'];
$lang = 'Hindi';
if($lang_temp == 1)
{
$lang = 'Hindi';
}
else if($lang_temp == 2){
$lang = 'Tamil';
}
else if($lang_temp == 3){
$lang = 'Telugu';
}
else if($lang_temp == 4){
$lang = 'Malayalam';
}
else{
$lang = 'Hindi';
}
// ends prashanth's changes

// Review List Sidebar
if($theme_review_cat_sidebar == "1") { 
$style_classes = array('review-first','review-second','review-third', 'review-fourth');
} else {
$style_classes = array('review-first','review-second','review-third');
}
$style_index = 0;

// Taxonomy Slug
if($tax_name) {
$taxonomy = $tax_name->rewrite['slug'];
$taxonomy_var = $tax_name->query_var;
} else {
$taxonomy = $theme_review_cat_slug;
}

// Review Filter URL
if(is_archive() && get_option("permalink_structure")) {
	$review_url = get_bloginfo('url')."/".$taxonomy."/".$term->slug."/?";
} else { 
	$review_url = get_bloginfo('url')."/?".$taxonomy_var."=".$term->slug."&amp;";
}

?>

<?php if($theme_review_cat_sidebar == "0") { ?><div id="main-content" class="<?php if($theme_review_cat_display == "List") { ?>main-content-other<?php } else { ?>main-content-home<?php } ?>"><?php } ?>
<!-- removed echo $theme_review_plural_name; and '/' by prashanth -->
	<h2 class="page-title"><?php if(is_archive()) {  } ?>
	
	<?php if($tax_name && !$tax_name->hierarchical) { ?> / <?php echo $tax_name->labels->name; ?><?php } ?>

	<?php if($term->name) { ?><?php } ?><?php echo $term->name; ?> </h2>

	<form name="revieworderform">
		<select name="revieworder" id="revieworder" OnChange="location.href=revieworderform.revieworder.options[selectedIndex].value">
		<option selected><?php echo gp_sort_reviews_by; ?>...</option>
		
		<?php if($theme_our_rating_type == "1") { ?>
			<option value="<?php echo $review_url; ?>gdsr_sort=review&amp;gdsr_multi=<?php echo($theme_our_rating_multi_id); ?>&amp;gdsr_order=DESC"><?php echo gp_sort_review_score_highest; ?></option>			
		<?php } else { ?>
			<option value="<?php echo $review_url; ?>gdsr_sort=review&amp;gdsr_order=DESC"><?php echo gp_sort_review_score_highest; ?></option>	
		<?php } ?>
		
		<?php if($theme_your_rating_type == "1") { ?>
			<option value="<?php echo $review_url; ?>gdsr_sort=rating&amp;gdsr_multi=<?php echo($theme_your_rating_multi_id); ?>&amp;gdsr_order=DESC"><?php echo gp_sort_user_score_highest; ?></option>
		<?php } else { ?>
			<option value="<?php echo $review_url; ?>gdsr_sort=rating&amp;gdsr_order=DESC"><?php echo gp_sort_user_score_highest; ?></option>	
		<?php } ?>

		<option value="<?php echo $review_url; ?>orderby=date&amp;order=DESC"><?php echo gp_sort_by_date_newest; ?></option>
		
		<option value="<?php echo $review_url; ?>orderby=date&amp;order=ASC"><?php echo gp_sort_by_date_oldest; ?></option>
		
		<option value="<?php echo $review_url; ?>orderby=title&amp;order=ASC"><?php echo gp_sort_by_title_az; ?></option>
		
		<option value="<?php echo $review_url; ?>orderby=title&amp;order=DESC"><?php echo gp_sort_by_title_za; ?></option>	
		
		</select>
	</form>
	
	<div class="clear"></div>
	
	<?php if($theme_review_cat_display == "List") { // List ?>
		
		<?php 
		//Added by prashanth - to list only selected language movies
		global $wp_query;
		$args = array_merge( $wp_query->query, array( 'paged' => $paged,'tax_query' =>array(
                    array(
                        'taxonomy'=>'review_categories',
                        'field'=>'slug',
                        'terms'=>array($term->slug,$lang),
                        'operator'=>'AND'
                    )
                ) ) );
		query_posts( $args );
		//query_posts($query_string.'&paged='.$paged.'&review_categories='.$lang); 

		if (have_posts()) : ?>
			
		<ol id="review-list">	
		
		<?php while (have_posts()) : the_post(); ?>
			
			<li>
			
				<?php 
				
				$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); $attachments = get_children($args); 
				
				if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
			
				<div class="thumbnail">
		
					<a href="<?php the_permalink(); ?>">
		
					<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
					
						<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=130&amp;w=100&amp;zc=1<?php } ?>" alt="" class="image" />
									
					<?php } else { ?>
					
						<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
							
							<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=130&amp;w=100&amp;zc=1<?php } ?>" alt="" class="image" />
							
						<?php }} ?>	
					
					<?php } ?>
					
					</a>
			
				</div>
			
			<?php } ?>
	
			<div class="review-list-text">
			
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
				<div class="post-meta"> <?php comments_popup_link('No User Reviews', '1 User Review', '% User Reviews', 'comments-link', ''); ?></div>
				
				<p><?php echo excerpt(35); ?></p>
				
				<!--Our Rating-->
				<?php if(get_post_meta($post->ID, 'ghostpool_our_rating', true) == "false") {} else { ?>
					<div class="review-list-ratings">
						<span><?php echo gp_our_rating; ?>:</span>
						<?php if($theme_our_rating_type == "1") { ?>
							<?php if(function_exists('wp_gdsr_multi_review_average')) { wp_gdsr_multi_review_average(get_post_meta($post->ID, 'ghostpool_our_rating_id', true), 0, true); } // Multi Rating Average ?>				
						<?php } else { ?>
							<?php if(function_exists('wp_gdsr_render_review')) { wp_gdsr_render_review(0, 1, $stars, 24); } // Single Rating ?>
						<?php } ?>					
					</div>
				<?php } ?>
				
				<!--Your Rating-->
				<?php if(get_post_meta($post->ID, 'ghostpool_your_rating', true) == "false") {} else { ?>
					<div class="review-list-ratings">
						<span><?php echo gp_your_rating; ?>:</span>
						<?php if($theme_your_rating_type == "1") { ?>
							<?php if(function_exists('wp_gdsr_multi_rating_average')) { wp_gdsr_multi_rating_average(get_post_meta($post->ID, 'ghostpool_your_rating_id', true), 0, 'total', true); } // Multi Rating Average ?>			
						<?php } else { ?>
							<?php if(function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(0, 1, $stars, 24); } // Single Rating ?>
						<?php } ?>	

	
					</div>	
				<?php } ?>

	
				
	
			</div>
			<div class="review-list-wanttosee"><?php if(function_exists(getILikeThis_onlycount)) getILikeThis_onlycount('get'); ?> Want too See</div>
			</li>
			
		<?php endwhile; ?>
		
		</ol>
		
			<?php gp_pagination(); ?>
			
		<?php endif; wp_reset_query(); ?>

	<?php } else { // Boxes ?>

		<?php query_posts($query_string.'&paged='.$paged); if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php require('box-loop.php'); ?>
		
		<?php endwhile; ?>
		
			<?php gp_pagination(); ?>
			
		<?php endif; wp_reset_query(); ?>
		
	<?php } ?>
	
<?php if($theme_review_cat_sidebar == "0") { ?></div><?php } ?>

<?php if($theme_review_cat_sidebar == "0") { get_sidebar(); } ?>