<?php
/*
Template Name: Blog
*/
get_header(); ?>

<div id="main-content" class="main-content-other">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php if($content = $post->post_content) { ?>
			<?php the_content(); ?>
			<div class="divider"></div>
		<?php } ?>	
	
	<?php endwhile; endif; ?>
	
	<?php
	
	$blog_post_ID = $post->ID;

	if (get_query_var('paged')) {
	$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
	} else {
	$paged = 1;
	}
	
	query_posts('cat='.get_post_meta($post->ID, 'ghostpool_blog_cats', true).'&paged='.$paged.'&posts_per_page='.get_post_meta($post->ID, 'ghostpool_blog_posts_per_page', true)); global $more; $more = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<!--Begin Post Content-->
		<div class="blog-post">
		
			<!--Begin Post Title-->
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<!--End Post Title-->
		
			<!--Begin Post Meta Details-->
			<div class="post-meta"><?php echo gp_by; ?> <?php the_author(); ?> <?php echo gp_on; ?> <?php the_time('d F Y'); ?> <?php echo gp_in; ?> <?php the_category(', '); ?> <?php echo gp_with; ?> <?php comments_popup_link(gp_no_comments, gp_one_comment, gp_more_comments, 'comments-link', ''); ?></div>
			<!--End Post Meta Details-->
			
			<!--Begin Post Image-->
			<?php
			
			$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
			
			if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
			
				<div class="blog-image">
		
					<a href="<?php the_permalink(); ?>">
		
					<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
					
						<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=238&amp;w=638&amp;zc=1<?php } ?>" alt="" class="image" />
									
					<?php } else { ?>
					
						<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
							
							<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=238&amp;w=630&amp;zc=1<?php } ?>" alt="" class="image" />
							
						<?php }} ?>	
					
					<?php } ?>
					
					</a>
			
				</div>
			
			<?php } ?>
			<!--End Post-Image-->
		
			<!--Begin Post Text-->
			<div class="post-text">
				<?php if(get_post_meta($blog_post_ID, 'ghostpool_blog_text_display', true) == "Excerpt") { ?>
					<p><?php echo excerpt(110); ?> <a href="<?php the_permalink(); ?>" class="read-on"><?php echo gp_read_on; ?></a></p>
				<?php } else { ?>
					<?php the_content(gp_read_on); ?>
				<?php } ?>
			</div>	
			<!--End Post Text-->
		
		</div>
		<!--End Post Content-->
		
		<div class="clear"></div>
		
	<?php endwhile; ?>
	
		<?php gp_pagination(); ?>
	
	<?php endif; wp_reset_query(); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>