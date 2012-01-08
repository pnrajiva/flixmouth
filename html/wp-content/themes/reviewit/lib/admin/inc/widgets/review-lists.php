<?php

/*************************** Review Lists Widget ***************************/

add_action('widgets_init', 'review_lists_widgets');

function review_lists_widgets() {
	register_widget('Review_Lists');
}

class Review_Lists extends WP_Widget {
	function Review_Lists() {
		$widget_ops = array('classname' => 'review_lists', 'description' => 'Display your reviews in lists.');
		$this->WP_Widget( 'review_lists-widget', 'GP Review Lists', $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );		
		$posts_per_page = $instance['posts_per_page'];
		$cat = $instance['cat'];
		$rating_type = $instance['rating_type'];		
		$gd_sort = $instance['gd_sort'];
		$gd_order = $instance['gd_order'];
		$display = $instance['display'];
		$see_all = $instance['see_all'];
		
		require(ghostpool_inc . 'options.php');
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
                $mus_display = 'no';
                $mytaxonomy = 'review';
                $mytax_terms = get_terms($mytaxonomy);
                // ends prashanth's changes
		// Begin Widget
		echo $before_widget;
		
		echo $before_title . $title . $after_title;
			
		query_posts(array(
		'posts_per_page' => $posts_per_page,
		'gdsr_sort' => $gd_sort, 'gdsr_order' => $gd_order,
		//'gdsr_multi' => $gd_multi_id,
		'nopaging' => 0,
		'post_status' => 'publish',
		'post_type' => 'review',
		//'review_categories' => $cat
                'tax_query' =>array(
                    array(
                        'taxonomy'=>'review_categories',
                        'field'=>'slug',
                        'terms'=>array($cat,$lang),
                        'operator'=>'AND'
                    )
                )
		)); 

		// Review Stars
		if($theme_skin == "Light") {$stars = 'reviewit_stars_light';} else {$stars = 'reviewit_stars_default';}

		// Rating Type
		//if($rating_type == "review") { $gd_multi_id = get_post_meta($post->ID, 'ghostpool_our_rating_id', true); } elseif($rating_type == "rating") { $gd_multi_id = get_post_meta($post->ID, 'ghostpool_your_rating_id', true); } else { $gd_multi_id = 0; }
		?>
<br>
<br>


		<?php if (have_posts()) : ?>
			
			<ul class="review-list-widget">
			
			<?php while (have_posts()) : the_post(); ?>	
                                 <!-- Start PR - 10/29/11 - Language select -->
                                <?php
                                   /* $mus_display = 'no';
                                    $terms = wp_get_post_terms($post->ID,'review_categories');
                                    foreach ($terms as $term) {
                                      
                                        if( $term->name == $lang)
                                        {
                                            $mus_display = 'yes';
                                        }
                                    }*/
                                ?> <!--end PR - 10/29/11 - Language select-->
                                 <?php //if($mus_display == "yes") {?>  <!--PR - 10/29/11 - Language select-->
				<li>
				
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<!-- commented by prashanth-->
					<?php //echo(get_the_term_list($post->ID, 'genre', '<br/><span> ', ', ', '</span>')); ?>
					
					<div class="review-list-widget-stars">
                                                <?php if($cat == "In Theatres") { ?>
						<?php if($rating_type == "disable") {} elseif($rating_type == "review") { ?>
						
							<!--Our Rating-->
							<?php if($theme_our_rating_type == "1") { ?>
								<?php if(function_exists('wp_gdsr_multi_review_average')) { wp_gdsr_multi_review_average(get_post_meta($post->ID, 'ghostpool_our_rating_id', true), 0, true); } // Multi Rating Average ?>				
							<?php } else { ?>
								<?php if(function_exists('wp_gdsr_render_review')) { wp_gdsr_render_review(0, 1, $stars, 24); } // Single Rating ?>
							<?php } ?>
						
						<?php } else { ?>
						
							<!--Your Rating-->
							<?php if($theme_your_rating_type == "1") { ?>
								<?php if(function_exists('wp_gdsr_multi_rating_average')) { wp_gdsr_multi_rating_average(get_post_meta($post->ID, 'ghostpool_your_rating_id', true), 0, 'total', true); } // Multi Rating Average ?>			
							<?php } else { ?>
								<?php if(function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(0, 1, $stars, 24); } // Single Rating ?>
							<?php } ?>			
						
						<?php } ?>
                                                <?php } else { ?>
                                                    <div id="review-page-want-to-see"><?php if(function_exists(getILikeThis)) getILikeThis('get'); ?>
                                                            Want too See
                                                </div>
                                                <?php } ?>
					</div>
				
				</li>
				<?php //} ?> <!--PR - 10/29/11 - closing tag for if of mus display-->
			<?php endwhile; ?>
			
			</ul>
			
			<?php if($see_all) { ?><a href="<?php echo($see_all); ?>" class="see-all-lists"><?php echo gp_see_all; ?> &raquo;</a><?php } ?>
			
		<?php else : ?>
	
			<?php echo gp_no_review_lists; ?>
	
		<?php endif; wp_reset_query(); 
		
		echo $after_widget;
		// End Widget
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = $_POST['cat'];
		$instance['posts_per_page'] = $new_instance['posts_per_page'];	
		$instance['rating_type'] = $_POST['rating_type'];		
		$instance['gd_sort'] = $_POST['gd_sort'];
		$instance['gd_order'] = $_POST['gd_order'];			
		$instance['display'] = $_POST['display'];
		$instance['see_all'] = $new_instance['see_all'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'posts_per_page' => 5, 'rating_type' => 'review_type', 'gd_sort' => 'review', 'gd_order' => 'desc', 'display' => 'compact', 'see_all' => '', 'cat' => ''); $instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Review Category:</label>
			<?php $terms = get_terms('review_categories', 'hide_empty=0'); ?>
			<select id="cat" name="cat">
				<option value=''>All</option><?php foreach ($terms as $term): ?><option value="<?php echo $term->slug; ?>" <?php if ($instance['cat'] ==  $term->slug) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option><?php endforeach; ?>		
			</select>
			<br/><small>Select a <a href="../wp-admin/edit-tags.php?taxonomy=review_categories&post_type=slide">review category</a> to display in your widget.</small>
			<input type="hidden" name="widget-options" id="widget-options" value="1" />
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Number Of Reviews:</label>
			<input  type="text" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" size="3" />
		</p>
		<p>
			<label for="rating_type">Rating Type:</label>
			<select id="rating_type" name="rating_type">
				<option value="review" <?php if ($instance['rating_type'] == 'review'){ echo 'selected="selected"'; } ?> >Review Score (Our Rating)</option>			
				<option value="rating" <?php if ($instance['rating_type'] == 'rating'){ echo 'selected="selected"'; } ?> >User Rating (Your Rating)</option> 			
                <option value="disable" <?php if ($instance['rating_type'] == 'disable'){ echo 'selected="selected"'; } ?> >Disable</option>	                
			</select>
		</p>			
		<p>
			<label for="gd_sort">Sort Reviews By:</label>
			<select id="gd_sort" name="gd_sort">
				<option value="review" <?php if ($instance['gd_sort'] == 'review'){ echo 'selected="selected"'; } ?> >Review Score (Our Rating)</option>			
				<option value="rating" <?php if ($instance['gd_sort'] == 'rating'){ echo 'selected="selected"'; } ?> >User Rating (Your Rating)</option> 			
                <option value="votes" <?php if ($instance['gd_sort'] == 'votes'){ echo 'selected="selected"'; } ?> >Number of Votes</option>
				<option value="date" <?php if ($instance['gd_sort'] == 'date'){ echo 'selected="selected"'; } ?> >Date</option>		                
			</select>
			<br/><small style="color: #ff0000;">Due to a bug in the GD Star Rating plugin you cannot currently sort by multi set ratings.</small>
		</p>
		<p>
			<label for="gd_order">Review Order:</label>
			<select id="gd_order" name="gd_order">
				<option value="desc" <?php if ($instance['gd_order'] == 'desc'){ echo 'selected="selected"'; } ?> >Descending</option> 			
				<option value="asc" <?php if ($instance['gd_order'] == 'asc'){ echo 'selected="selected"'; } ?> >Ascending</option>							
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