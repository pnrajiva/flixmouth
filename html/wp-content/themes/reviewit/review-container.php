<?php

if($theme_skin == "Light") {$stars = 'reviewit_stars_light';} else {$stars = 'reviewit_stars_default';}

?>
<div id="review-container">

	<!--Begin Review Left Panel-->
	<div id="review-page-image">

		<!--Begin Review Image-->	
		<?php
		
		$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
		
		if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
	
			<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
			
				<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=150&amp;zc=1<?php } ?>" alt="" class="image preload" />
							
			<?php } else { echo "so its going in loop";?>
			
				<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
					
					<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=150&amp;zc=1<?php } ?>" alt="" class="image preload" />
					
				<?php }} ?>	
			
			<?php } ?>
		
		<?php } ?>
		<!--End Review Image-->
		
		<!--Begin Our Rating-->
		<?php if(get_post_meta($post->ID, 'ghostpool_our_rating', true) == "false") {} else { ?>
		<div id="review-page-our-rating">
		
			<strong><?php echo gp_our_rating; ?></strong>
			<?php if($theme_our_rating_type == "1") { ?>
				<?php if(function_exists('wp_gdsr_show_multi_review')) { wp_gdsr_show_multi_review(get_post_meta($post->ID, 'ghostpool_our_rating_id', true), 0, 0, $stars, $stars_size=20); } // Multi Rating ?>
				<?php if(function_exists('wp_gdsr_multi_review_average')) { wp_gdsr_multi_review_average(get_post_meta($post->ID, 'ghostpool_our_rating_id', true), 0, true); } // Average Of Multi Rating ?>	
			<?php } else { ?>
				<?php if(function_exists('wp_gdsr_render_review')) { wp_gdsr_render_review(0, 0, $stars, 24); } // Single Rating ?>
			<?php } ?>
			
		</div>
		<?php } ?>
		<!--End Our Rating-->
		
		<!--Begin Your Rating-->
		<?php if(get_post_meta($post->ID, 'ghostpool_your_rating', true) == "false") {} else { ?>
		<div id="review-page-user-rating">
		
			<strong><?php echo gp_your_rating; ?></strong>
			<?php if($theme_your_rating_type == "1") { ?>
				<?php if(function_exists('wp_gdsr_render_multi')) { wp_gdsr_render_multi(get_post_meta($post->ID, 'ghostpool_your_rating_id', true), 0, false, 0, $stars, 20, $stars, $stars, 20, $stars, true); } // Multi Rating ?>			
			<?php } else { ?>
				<?php if(get_post_meta($post->ID, 'ghostpool_your_rating_comment', true)) { if(defined('STARRATING_INSTALLED')) { wp_gdsr_render_article(0, 1, $stars, 20); } } else { if(defined('STARRATING_INSTALLED')) { wp_gdsr_render_article(0, 0, $stars, 20); } } // Single Rating ?>
			<?php } ?>
			
		</div>
		<?php } ?>
		<!--End User Rating-->

	<div id="review-page-want-to-see"><?php if(function_exists(getILikeThis)) getILikeThis('get'); ?>
	Want too See
	</div>
	
	<div id="review-page-fb">
Recommend this movie
<p></p>
<div class="fb-like" data-href="<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-action="recommend"></div> </div>	
	</div>
	<!--End Review Left Panel-->

	<!--Begin Review Stats-->	
	<div id="review-stats"<?php if($theme_review_page_layout == "Layout 2") { ?> class="review-stats-full"<?php } ?>>
	
		<h2 class="page-title"><?php the_title(); ?></h2>
		
		<ul id="review-tags-list">
			<?php if($theme_review_tag_1 == "0") { echo(get_the_term_list($post->ID, 'release_date', '<li><strong>'.$theme_review_tag_1_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_2 == "0") { echo(get_the_term_list($post->ID, 'genre', '<li><strong>'.$theme_review_tag_2_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_3 == "0") { echo(get_the_term_list($post->ID, 'rating', '<li><strong>'.$theme_review_tag_3_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_4 == "0") { echo(get_the_term_list($post->ID, 'director', '<li><strong>'.$theme_review_tag_4_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_5 == "0") { echo(get_the_term_list($post->ID, 'producer', '<li><strong>'.$theme_review_tag_5_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_6 == "0") { echo(get_the_term_list($post->ID, 'screenwriter', '<li><strong>'.$theme_review_tag_6_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_7 == "0") { echo(get_the_term_list($post->ID, 'studio', '<li><strong>'.$theme_review_tag_7_singular_name.':</strong> ', ', ', '</li>')); } ?>
			<?php if($theme_review_tag_8 == "0") { echo(get_the_term_list($post->ID, 'starring', '<li><strong>'.$theme_review_tag_8_singular_name.':</strong> ', ', ', '</li>')); } ?>	
			<?php if($theme_review_tag_9 == "1") { echo(get_the_term_list($post->ID, $theme_review_tag_9_slug, '<li><strong>'.$theme_review_tag_9_singular_name.':</strong> ', ', ', '</li>')); } ?>	
			<?php if($theme_review_tag_10 == "1") { echo(get_the_term_list($post->ID, $theme_review_tag_10_slug, '<li><strong>'.$theme_review_tag_10_singular_name.':</strong> ', ', ', '</li>')); } ?>			
		</ul>
		
		<?php if($theme_review_text_position == "Below Review Tags") { ?>
			
			<?php the_content(); ?>
			
			<?php if($theme_review_meta == "1") {} else { ?><div class="review-meta"><?php echo gp_reviewed_by; ?> <?php the_author(); ?> <?php echo gp_on; ?> <?php the_time('d F Y'); ?></div><?php } ?>
		
		<?php } ?>
		
	</div>
	<!--End Review Stats-->
	
	<!--Begin Field Box-->
	<?php if(get_post_meta($post->ID, 'ghostpool_tab_title_1', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_2', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_3', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_4', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_5', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_6', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_7', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_8', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_9', true) OR get_post_meta($post->ID, 'ghostpool_tab_title_10', true)) { ?>
	<div id="tabs-box">
		<ul></ul>	
	</div>
	<?php } ?>
	<!--End Field Box-->
	
</div>