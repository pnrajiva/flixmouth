<?php

/*************************** Post Boxes Widget ***************************/

add_action('widgets_init', 'post_boxes_widgets');

function post_boxes_widgets() {
	register_widget('Post_Boxes');
}

class Post_Boxes extends WP_Widget {
	function Post_Boxes() {
		$widget_ops = array('classname' => 'post_boxes', 'description' => 'Display your posts in boxes.');
		$this->WP_Widget( 'post_boxes-widget', 'GP Post Boxes', $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$posts_per_page = $instance['posts_per_page'];
		$pagination = $instance['pagination'];		
		$cat = $instance['cat'];
		$post_sort = $instance['post_sort'];
		$post_order = $instance['post_order'];
		$display = $instance['display'];
		$see_all = $instance['see_all'];
		
		require(ghostpool_inc . 'options.php');
		
		// Begin Widget
		echo $before_widget; ?>

		<?php echo $before_title; ?><?php echo $title; ?><?php if($see_all) { ?><a href="<?php echo($see_all); ?>" class="see-all-boxes"><?php echo gp_see_all; ?> &raquo;</a><?php } ?><?php echo $after_title; ?>
			
		<?php
		
		if($pagination == "enable") { $paged = get_query_var('paged'); } else { $paged = 1; }
		
		query_posts(array('paged' => $paged, 'posts_per_page' => $posts_per_page, 'post_sort' => $post_sort, 'post_order' => $post_order, 'post_status' => 'publish', 'caller_get_posts' => 1, 'post_type' => 'post', 'cat' => $cat)); 
		
		// If Sidebar Displayed
		if($theme_homepage_sidebar == "1") { 
		$style_classes = array('review-first','review-second','review-third', 'review-fourth');
		} else {
		$style_classes = array('review-first','review-second','review-third');
		}
		$style_index = 0;
		
		if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<div class="review-box <?php if($theme_homepage_sidebar == "1") { $k = $style_index%4; } else { $k = $style_index%3; } echo "$style_classes[$k]"; $style_index++; ?>">
			
				<div class="review-display <?php if($display == "extended") { ?>review-box-top-extended<?php } else { ?>review-box-top-compact<?php } ?>">
			
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
			
				</div>
				
				<div class="review-box-bottom"></div>
				
			</div>
				
		<?php endwhile; ?>
		
			<div class="clear"></div>
			
			<?php if($pagination == "enable") { gp_pagination(); } else {} ?>
		
		<?php else : ?>
	
			<?php echo gp_no_post_boxes; ?>
	
		<?php endif; wp_reset_query();
		
		echo $after_widget; 
		// End Widget
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		$instance['posts_per_page'] = $new_instance['posts_per_page'];	
		$instance['pagination'] = $_POST['pagination'];
		$instance['post_sort'] = $_POST['post_sort'];
		$instance['post_order'] = $_POST['post_order'];
		$instance['display'] = $_POST['display'];
		$instance['see_all'] = $new_instance['see_all'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'cat' => '', 'posts_per_page' => 6, 'pagination' => 'disable', 'post_sort' => 'date', 'post_order' => 'desc', 'display' => 'compact', 'see_all' => ''); $instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Categories To Display:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" />
			<br/><small>Enter your category IDs, separating each with a comma (e.g. 23,51,102,65), leave blank to display all categories.</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Number Of Posts:</label>
			<input  type="text" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" size="3" />
		</p>
		<p>
			<label for="display">Display:</label>
			<select id="display" name="display">
				<option value="compact" <?php if ($instance['display'] == 'compact'){ echo 'selected="selected"'; } ?> >Compact</option>			
				<option value="extended" <?php if ($instance['display'] == 'extended'){ echo 'selected="selected"'; } ?> >Extended</option>
			</select>
		</p>
		<p>
			<label for="post_sort">Sort Posts By:</label>
			<select id="post_sort" name="post_sort">
				<option value="date" <?php if ($instance['post_sort'] == 'date'){ echo 'selected="selected"'; } ?> >Date</option>			
				<option value="title" <?php if ($instance['post_sort'] == 'title'){ echo 'selected="selected"'; } ?> >Title</option> 
			</select>
		</p>
		<p>
			<label for="post_order">Post Order:</label>
			<select id="post_order" name="post_order">
				<option value="desc" <?php if ($instance['post_order'] == 'desc'){ echo 'selected="selected"'; } ?> >Descending</option> 			
				<option value="asc" <?php if ($instance['post_order'] == 'asc'){ echo 'selected="selected"'; } ?> >Ascending</option>							
			</select>
		</p>	
		<p>
			<label for="pagination">Display Page Numbers:</label>
			<select id="pagination" name="pagination">	
				<option value="disable" <?php if ($instance['pagination'] == 'disable'){ echo 'selected="selected"'; } ?> >Disable</option>     
				<option value="enable" <?php if ($instance['pagination'] == 'enable'){ echo 'selected="selected"'; } ?> >Enable</option>					
			</select>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'see_all' ); ?>">See All Link</label>
			<input  type="text" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" value="<?php echo $instance['see_all']; ?>" />
		</p>
		
		<input type="hidden" name="widget-options" id="widget-options" value="1" />

		<?php
	
	}
}

?>