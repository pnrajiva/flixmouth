<?php

/*************************** You May Like Widget ***************************/

add_action( 'widgets_init', 'yml_widgets' );

function yml_widgets() {
	register_widget( 'YML' );
}

class YML extends WP_Widget {
	function YML() {
		$widget_ops = array( 'classname' => 'yml', 'description' => 'Displays other reviews that have any of the same "Genre" tags.' );
		$this->WP_Widget( 'yml-widget', 'GP You May Like', $widget_ops);
	}

	function widget( $args, $instance ) {	
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$items = $instance['items'];
		
		require(ghostpool_inc . 'options.php');
		
		global $wp_query;
		$post_id = $GLOBALS['post']->ID; 
		$genre = get_the_term_list($post_id, 'genre','',',','');
		if(function_exists('edit_term_link')) {} else {
		$first_genre = explode(",", $genre);
		$genre = $first_genre[0];
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
		$tempQuery = $wp_query;
		$newQuery=array('post__not_in' => array($post_id), 'genre' => $genre, 'posts_per_page' => $items, 'post_type' => 'review', 'orderby' => rand, 'caller_get_posts' => 1, 'nopaging' => 0, 'tax_query' => array(
		array(
			'taxonomy' => 'review_categories',
			'field' => 'slug',
			'terms' => $lang
		)
	)); query_posts($newQuery); if (have_posts()) :
		
		// Begin Width
		echo $before_widget;
		
		if($title) echo $before_title . $title . $after_title;
		
		while (have_posts()) : the_post(); $post_id = $GLOBALS['post']->ID; ?>
		
			<div class="review-box">
			
				<div class="review-display <?php if($display == "extended") { ?>review-box-top-extended<?php } else { ?>review-box-top-compact1<?php } ?>">
				
								
					<?php
	
					$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post_id, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
					
					if(get_post_meta($post_id, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
				
						<a href="<?php the_permalink(); ?>">
			
						<?php if(get_post_meta($post_id, 'ghostpool_thumbnail', true)) { ?>
						
							<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post_id, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
										
						<?php } else { ?>
						
							<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
								
								<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=120&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
								
							<?php }} ?>	
						
						<?php } ?>
						
						</a>
				
					<?php } ?>

					<div class="review-box-text"><a href="<?php the_permalink(); ?>"><?php echo review_box_title(get_the_title());?></a>
					</div>
			
				</div>
				
				<div class="review-box-bottom"></div>
				
			</div>
		
		<?php endwhile;
		
		echo $after_widget; endif; wp_reset_query();
		// End Widget
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = strip_tags( $new_instance['items'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', items => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'items' ); ?>">Number Of Items To Display:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" size="3" value="<?php echo $instance['items']; ?>" />
		</p>
		
		<?php
	}
}

?>