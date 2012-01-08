<?php

/*************************** Recent Comments Widget ***************************/

add_action( 'widgets_init', 'recent_comments_widgets' );

function recent_comments_widgets() {
	register_widget( 'Recent_Comments' );
}

class Recent_Comments extends WP_Widget {
	function Recent_Comments() {
		$widget_ops = array( 'classname' => 'recent_comments', 'description' => 'Displays recent comments with avatars and comment excerpts.' );
		$this->WP_Widget( 'recent-comments', 'GP Recent Comments', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
                
                $lang_temp = $_SESSION['reglang'];
                $lang = 'hindi';
                if($lang_temp == 1)
                {
                    $lang = 'hindi';
                }
                else if($lang_temp == 2){
                    $lang = 'tamil';
                }
                else if($lang_temp == 3){
                    $lang = 'telugu';
                }
                else if($lang_temp == 4){
                    $lang = 'malayalam';
                }
                else{
                    $lang = 'hindi';
                }
		echo $before_widget;
		
		if ($title) echo $before_title . $title . $after_title; ?>

			<div id="recent-comments-widget">
			
				<ul>
					<?php 
					global $wpdb;
                                        //added post_type and review categories in the query - prashanth
					$request = "SELECT * FROM $wpdb->comments";
					$request .= " JOIN $wpdb->posts ON ($wpdb->posts.ID = $wpdb->comments.comment_post_ID)";
                                        $request .= " JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)";
                                        $request .= " JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
                                        $request .= " JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)";
                                        $request .= " WHERE comment_approved = '1' AND post_type='review' AND post_status = 'publish' AND post_password ='' AND $wpdb->term_taxonomy.taxonomy = 'review_categories' AND $wpdb->terms.slug = '$lang'";
					$request .= " ORDER BY comment_date DESC LIMIT $number";
                                       	$comments = $wpdb->get_results($request);
					if ($comments) {
						
						foreach ($comments as $comment) { ob_start(); ?>
						
							<li>
								<?php echo get_avatar($comment,$size='50',$default=get_template_directory_uri().'/images/gravatar.gif'); ?>
								<span class="text">
									<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, 65)); ?>...</a>
									<br/><span><?php echo($comment->comment_author) ?> <?php echo gp_on; ?>
									<?php echo get_the_title($comment->comment_post_ID) ?></span>
								</span>
							</li>
								
						<?php ob_end_flush(); }
						
					} else { ?>
						
						<li><?php echo 'No recent reviews' ?></li>
					
					<?php } ?>
					
				</ul>
				
			</div>

			<?php wp_reset_query();
			
			// End Widget
			echo $after_widget;
	 
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags( $new_instance['number'] );
			return $instance;
		}
	
		function form( $instance ) {
			$defaults = array('title' => 'Recent Comments', 'number' => '5'); $instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Comments:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" size="3" value="<?php echo $instance['number']; ?>" />
			</p>		
			
			<?php
			
		}
	}

?>