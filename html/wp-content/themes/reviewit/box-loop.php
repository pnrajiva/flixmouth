<div class="review-box <?php if((is_category() && $theme_gen_cat_sidebar == "1") OR (is_tax('review_categories') && $theme_review_cat_sidebar == "1")) { $k = $style_index%4; } else { $k = $style_index%3; } echo "$style_classes[$k]"; $style_index++; ?>">

	<div class="review-display <?php if((is_category() && $theme_gen_cat_display == "Extended Boxes") OR (is_tax('review_categories') && $theme_review_cat_display == "Extended Boxes")) { ?>review-box-top-extended<?php } else { ?>review-box-top-compact<?php } ?>">
	
		<?php
	
		$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
		
		if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
	
		<a href="<?php the_permalink(); ?>">
		
			<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
			
				<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=120&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
							
			<?php } else { ?>
			
				<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
					
					<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=120&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
					
				<?php }} ?>	
			
			<?php } ?>
		
		</a>

		<?php } ?>

		<div class="review-box-text"><a href="<?php the_permalink(); ?>"><?php echo review_box_title(get_the_title());?></a>
		<p><?php echo excerpt(18); ?></p></div>

<?php if(is_tax('review_categories')) { ?>
		
			<div class="review-box-stars">
			<?php if($theme_our_rating_multi_id) { ?>
				<?php if(function_exists('wp_gdsr_multi_review_average')) { wp_gdsr_multi_review_average($theme_our_rating_multi_id, 0, true); } // Multi Rating Average ?>				
			
			<?php } ?>	
			</div>			
		
		<?php } ?>
	</div>
	
	<div class="review-box-bottom"></div>
	
</div>