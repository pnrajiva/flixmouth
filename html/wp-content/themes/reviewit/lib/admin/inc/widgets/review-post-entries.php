<?php

/*************************** Review/Post Entries Widget ***************************/

add_action('widgets_init', 'blog_posts_widgets');

function blog_posts_widgets() {
	register_widget('Blog_Posts');
}

class Blog_Posts extends WP_Widget {

	function Blog_Posts() {
		$widget_ops = array('classname' => 'blog_posts', 'description' => 'Display your posts and/or reviews on the homepage in a blog style format.');
		$this->WP_Widget( 'blog_posts-widget', 'GP Review/Post Entries', $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post, $wp_query, $paged;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );		
		$posts_per_page = $instance['posts_per_page'];
		$post_type_menu = $instance['post_type_menu'];
		$cats = $instance['cats'];
		$textdisplay = $instance['textdisplay'];
		$images = $instance['images'];
		$image_size = $instance['image_size'];
		$pagination = $instance['pagination'];		
		$excerpt_length = $instance['excerpt_length'];
		$offset = $instance['offset'];
		
		require(ghostpool_inc . 'options.php');
		
		// Post Type
		if($post_type_menu == 'both') {
		$post_type = array('post', 'review');
		} elseif($post_type_menu == 'reviews') {
		$post_type = 'review';
		} else {
		$post_type = 'post';
		}
		
		// Begin Widget
		echo $before_widget;
		
		echo $before_title . $title . $after_title; ?>
		
		<div class="blog-posts-widget">

		<?php

		if($pagination == "enable") { $paged = get_query_var('paged'); } else { $paged = 1; }
		
		$args=array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'cat' => $cats,
		'offset' => $offset,
		);
		
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query($args);

		global $more; $more = 0;
		
		if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); 		
		$post_type = get_post_type($post); ?>
	
			<!--Begin Post Content-->
			<div class="blog-post">
			
				<!--Begin Post Title-->
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<!--End Post Title-->
				
				<!--Begin Post Meta Details-->
				<div class="post-meta"><?php echo gp_by; ?> <?php the_author(); ?> <?php echo gp_on; ?> <?php the_time('d F Y'); ?> <?php if($post_type == "post") { echo gp_in; } ?> <?php the_category(', '); ?> <?php echo gp_with; ?> <?php comments_popup_link(gp_no_comments, gp_one_comment, gp_more_comments, 'comments-link', ''); ?></div>
				<!--End Post Meta Details-->
				
				<!--Begin Post Image-->
				<?php if($images == "no") {} else { 
				
				$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
								
				?>

					<?php if($image_size == "small") { ?>

						<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
						
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
						
					<?php } elseif($image_size == "large") { ?>
				
						<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
						
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
						
						<div class="clear"></div>
						
					<?php } ?>
						
				<?php } ?>
				<!--End Post-Image-->
			
				<!--Begin Post Text-->
				<div class="excerpt-text">
					
					<?php if($textdisplay == "fullcontent") { ?>
						<?php the_content(gp_read_on); ?>
					<?php } else { ?>
						<p><?php echo excerpt($excerpt_length); ?> <a href="<?php the_permalink(); ?>" class="read-on"><?php gp_read_on; ?></a></p>
					<?php } ?>
			
				</div>
				<!--End Post Text-->
			
			</div>
			<!--End Post Content-->
			
			<div class="clear"></div>
				
		<?php endwhile; ?>		

			<?php if($pagination == "disable") {} else { gp_pagination(); } ?>
				
		<?php else : ?>
		
			<?php echo gp_no_entries; ?>	
		
		<?php endif; $wp_query = null; $wp_query = $temp; ?>
		
		</div>
		
		<?php 
		
		echo $after_widget;
		// End Widget
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_type_menu'] = $_POST['post_type_menu'];
		$instance['posts_per_page'] = $new_instance['posts_per_page'];	
		$instance['cats'] = $new_instance['cats'];
		$instance['textdisplay'] = $_POST['textdisplay'];
		$instance['images'] = $_POST['images'];
		$instance['image_size'] = $_POST['image_size'];		
		$instance['pagination'] = $_POST['pagination'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['offset'] = $new_instance['offset'];		
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => '', 'post_type_menu' => 'posts', 'posts_per_page' => '5', 'cat' => '', 'images' => 'yes', 'image_size' => 'small', 'textdisplay' => 'excerpt', 'pagination' => 'enable', 'excerpt_length' => '110', 'offset' => '0'); $instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="post_type_menu">What To Display:</label>
			<select id="post_type_menu" name="post_type_menu">
				<option value="posts" <?php if ($instance['post_type_menu'] == 'posts'){ echo 'selected="selected"'; } ?> >Posts</option>			
				<option value="reviews" <?php if ($instance['post_type_menu'] == 'reviews'){ echo 'selected="selected"'; } ?> >Reviews</option>  
				<option value="both" <?php if ($instance['post_type_menu'] == 'both'){ echo 'selected="selected"'; } ?> >Both</option>  				
			</select>
		</p>			
		<p>
			<label for="<?php echo $this->get_field_id( 'cats' ); ?>">Categories To Display:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'cats' ); ?>" name="<?php echo $this->get_field_name( 'cats' ); ?>" value="<?php echo $instance['cats']; ?>" />
			<br/><small>Enter your category IDs, separating each with a comma (e.g. 23,51,102,65), leave blank to display all categories. <em>Note: If you selected "Reviews" or "Both" above you cannot use this option.</em></small>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Number Of Posts:</label>
			<input  type="text" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'offset' ); ?>">Offset Posts By:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" value="<?php echo $instance['offset']; ?>" size="3" />
			<br/><small>For example to hide the first five posts enter "5". <em>Note: If you offset posts the page number option below will not work.</em></small>
		</p>		
		<p>
			<label for="textdisplay">Text Display:</label>
			<select id="textdisplay" name="textdisplay">
				<option value="excerpt" <?php if ($instance['textdisplay'] == 'excerpt'){ echo 'selected="selected"'; } ?> >Excerpt</option>			
				<option value="fullcontent" <?php if ($instance['textdisplay'] == 'fullcontent'){ echo 'selected="selected"'; } ?> >Full Content</option>            
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>">Excerpt Length:</label>
			<input  type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>" size="3" />
		</p>		
		<p>
			<label for="images">Display Images:</label>
			<select id="images" name="images">
				<option value="yes" <?php if ($instance['images'] == 'yes'){ echo 'selected="selected"'; } ?> >Yes</option>			
				<option value="no" <?php if ($instance['images'] == 'no'){ echo 'selected="selected"'; } ?> >No</option>            
			</select>
		</p>
		<p>
			<label for="image_size">Image Size:</label>
			<select id="image_size" name="image_size">
				<option value="small" <?php if ($instance['image_size'] == 'small'){ echo 'selected="selected"'; } ?> >Small</option>			
				<option value="large" <?php if ($instance['image_size'] == 'large'){ echo 'selected="selected"'; } ?> >Large</option>            
			</select>
		</p>		
		<p>
			<label for="pagination">Display Page Numbers:</label>
			<select id="pagination" name="pagination">
				<option value="enable" <?php if ($instance['pagination'] == 'enable'){ echo 'selected="selected"'; } ?> >Enable</option>			
				<option value="disable" <?php if ($instance['pagination'] == 'disable'){ echo 'selected="selected"'; } ?> >Disable</option>            
			</select>
		</p>	
		
		<input type="hidden" name="widget-options" id="widget-options" value="1" />

		<?php
	}
}

?>