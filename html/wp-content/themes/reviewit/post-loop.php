<div class="post">

	<?php
	
	$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
	
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
	
	<div class="excerpt-text">
	
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<!--Begin Post Meta Details-->
		<div class="post-meta"><?php echo gp_by; ?> <?php the_author(); ?> <?php echo gp_on; ?> <?php the_time('d F Y'); ?> <?php if($post_type == "post") { echo gp_in; } ?> <?php the_category(', '); ?> <?php if($post_type == "page") {} else { echo gp_with; } ?> <?php comments_popup_link('No User Reviews', '1 User Review', '% User Reviews', 'comments-link', ''); ?></div>
		<!--End Post Meta Details-->

		<p><?php echo excerpt(35); ?></p>	

		<?php if($post_type == "review" && is_search()) { ?>
			
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

		<?php } ?>				

	</div>

</div>

<div class="clear"></div>