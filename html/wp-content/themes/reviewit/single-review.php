<?php get_header(); ?>

<!--Begin Main Content-->
<?php if($theme_review_page_layout == "Layout 1") { ?><div id="main-content" class="main-content-other"><?php } ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); $parent_post_id = $post->ID; ?>
	<?php require_once('review-container.php'); ?>
	
	<?php endwhile; endif; ?>
	
	<?php if($theme_review_page_layout == "Layout 2") { ?><div id="main-content" class="main-content-other"><?php } ?>


	<!--Begin Tab Panels-->
	<div id="panels">
	
		<div class="panel" title="<?php if($theme_review_text_position == "Within Review Tabs") { echo gp_review_tab; } else { echo gp_comments_tab; } ?>">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<?php if($theme_review_text_position == "Within Review Tabs") { ?>
			
				<?php the_content(); ?>
				
				<?php if($theme_review_meta == "1") {} else { ?><?php } ?>
			
			<?php } ?>
			
			<?php comments_template(); ?>
		
		<?php endwhile; endif; $j = 2; ?>
		
		</div>
	
		<?php for($i = 1; $i < 11; $i++) { // Begin Loop Tabs ?>
		
		<?php if(get_post_meta($post->ID, 'ghostpool_tab_title_'.$i, true)) { // Begins Tabs ?>
		
			<div class="panel" title="<?php echo(get_post_meta($post->ID, 'ghostpool_tab_title_'.$i, true)); ?>"></a>
			
			<h2 class="page-title"><?php echo(get_post_meta($post->ID, 'ghostpool_tab_title_'.$i, true)); ?></h2>
			
				<?php if(get_post_meta($post->ID, 'ghostpool_tab_type_'.$i, true) == "Page") { query_posts('post_type=any&name='.get_post_meta($post->ID, 'ghostpool_tab_id_'.$i, true)); }
				else { query_posts('post_type=any&tag='.get_post_meta($post->ID, 'ghostpool_tab_id_'.$i, true)); }
				if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<?php if(get_post_meta($parent_post_id, 'ghostpool_tab_type_'.$i, true) == "Page") { // Page ?>
	
					<?php the_content(); ?>	
				
				<?php } elseif(get_post_meta($parent_post_id, 'ghostpool_tab_type_'.$i, true) == "Media") { // Media ?>
	
					<?php $args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1, 'post_mime_type' => 'image', 'orderby' => menu_order, 'order' => ASC, 'post_parent' => $post->ID); $attachments = get_children($args); if ($attachments) { foreach ($attachments as $attachment) { 
					
					// Video Type
					$flv = strpos($attachment->post_content,".flv");
					$mp4 = strpos($attachment->post_content,".mp4");
					$mp3 = strpos($attachment->post_content,".mp3");
					$m4v = strpos($attachment->post_content,".m4v");
					$yt = strpos($attachment->post_content,"youtu");

					?>
						
					<div class="tab-image">	
					
					<a href="<?php if($flv == true OR $mp4 == true OR $mp3 == true OR $m4v == true OR $yt == true) { // FLV Video ?>file=<?php echo $attachment->post_content; ?><?php } elseif($attachment->post_content) { // Non FLV Video ?><?php echo $attachment->post_content; ?><?php } else { // Image ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php } ?>" rel="prettyPhoto[gallery<?php echo($i); ?>]" title="<?php echo $attachment->post_excerpt ?>">
					
						<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_thumb_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=120&amp;w=120&amp;zc=1<?php } ?>" alt="<?php echo $attachment->post_title ?>" />
						
					</a>
					
					</div>
				
					<?php }} ?><div class="clear"></div>
				
				<?php } else { // List of articles ?>
	
					<?php require('post-loop.php'); ?>
				
				<?php } ?>
				
				<?php endwhile; endif; wp_reset_query(); ?>
			</div>
			
		<?php } // End Tabs ?>
	
		<?php } // End Loop Tabs ?>
	
	</div>
	<!--End Tab Panels-->

</div>
<!--End Main Content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>