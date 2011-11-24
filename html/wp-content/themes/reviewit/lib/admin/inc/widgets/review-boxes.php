<?php

/*************************** Review Boxes Widget ***************************/

add_action('widgets_init', 'review_boxes_widgets');

function review_boxes_widgets() {
	register_widget('Review_Boxes');
}

class Review_Boxes extends WP_Widget {

	function Review_Boxes() {
		$widget_ops = array('classname' => 'review_boxes', 'description' => 'Display your reviews in boxes.');
		$this->WP_Widget( 'review_boxes-widget', 'GP Review Boxes', $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post, $wp_query, $paged;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$posts_per_page = $instance['posts_per_page'];
		$cat = $instance['cat'];
		$rating_type = $instance['rating_type'];		
		$gd_sort = $instance['gd_sort'];
		$gd_order = $instance['gd_order'];
		$display = $instance['display'];	
		$pagination = $instance['pagination'];		
		$see_all = $instance['see_all'];
                //added by prashanth - to get session variable of the selected movie region
                $lang_temp = $_SESSION['reglang'];
                $lang = 'Hindi';
                $lang_id = 90;
                if($lang_temp == 1)
                {
                    $lang = 'Hindi';
                    $lang_id = 90;
                }
                else if($lang_temp == 2){
                    $lang = 'Tamil';
                    $lang_id = 91;
                }
                else if($lang_temp == 3){
                    $lang = 'Telugu';
                    $lang_id = 107;
                }
                else if($lang_temp == 4){
                    $lang = 'Malayalam';
                    $lang_id = 92;
                }
                else{
                    $lang = 'Hindi';
                    $lang_id = 90;
                }
                if($cat == 'Coming Soon')
                    $cat_id=77;
                else {
                    $cat_id=89;
                }
                $mus_display = 'no';
                $mytaxonomy = 'review';
                $mytax_terms = get_terms($mytaxonomy);
                // ends prashanth's changes
		require(ghostpool_inc . 'options.php');
		
		// Begin Width
		echo $before_widget; ?>
	
		<?php echo $before_title; ?><?php echo $title; ?><?php if($see_all) { ?><a href="<?php echo($see_all); ?>" class="see-all-boxes"><?php echo gp_see_all; ?> &raquo;</a><?php } ?><?php echo $after_title; ?>
			
		<?php
		  
		if($pagination == "enable") { $paged = get_query_var('paged'); } else { $paged = 1; }
		
		$args=array(
		'post_type' => 'review',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'gdsr_sort' => $gd_sort,
		'gdsr_order' => $gd_order,
		//'gdsr_multi' => $gd_multi_id,
		//'review_categories' => $cat
                'tax_query' =>array(
                    array(
                        'taxonomy'=>'review_categories',
                        'field'=>'slug',
                        'terms'=>array($cat,$lang),
                        'operator'=>'AND'
                    )
                )
		);
		
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query($args);

		// If Sidebar Displayed
		if($theme_homepage_sidebar == "1") { 
		$style_classes = array('review-first','review-second','review-third', 'review-fourth');
		} else {
		$style_classes = array('review-first','review-second','review-third', 'review-fourth');
		}
		$style_index = 0;
		
		// Rating Type
		//if($rating_type == "review") { $gd_multi_id = get_post_meta($post->ID, 'ghostpool_our_rating_id', true); } elseif($rating_type == "rating") { $gd_multi_id = get_post_meta($post->ID, 'ghostpool_your_rating_id', true); } else { $gd_multi_id = 0; }
		
		if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();?>
                       <!--Start PR - 10/29/11 - Language select -->
                         <?php
                         //$mus_display = 'no';
                        //$terms = wp_get_post_terms($post->ID,'review_categories');
                        //foreach ($terms as $term) {
                          //        if( $term->name == $lang)
                            //      {
                              //             $mus_display = 'yes';
                                //  }
                        //}
                        ?> <!--end PR - 10/29/11 - Language select-->
                        <?php //if($mus_display == "yes") { ?> <!--  PR - 10/29/11 - Language select -->
			<div class="review-box <?php if($theme_homepage_sidebar == "1") { $k = $style_index%4; } else { $k = $style_index%3; } echo "$style_classes[$k]"; $style_index++; ?>">
			
				<div class="review-display <?php if($display == "extended") { ?>review-box-top-extended<?php } else { ?>review-box-top-compact<?php } ?>">
				
					<?php
	
					$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID, 'numberposts' => 1, 'orderby' => menu_order, 'order' => ASC); 
					
					if(get_post_meta($post->ID, 'ghostpool_thumbnail', true) OR $attachments = get_children($args)) { ?>
				
						<a href="<?php the_permalink(); ?>">
			
						<?php if(get_post_meta($post->ID, 'ghostpool_thumbnail', true)) { ?>
						
							<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_thumbnail', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=180&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
										
						<?php     } else { ?>
						
							<?php if ($attachments) { foreach ($attachments as $attachment) { ?>
								
								<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo wp_get_attachment_url($attachment->ID); ?><?php if($theme_timthumb == "0") { ?>&amp;h=120&amp;w=212&amp;zc=1<?php } ?>" alt="" class="image" />
								
							<?php }} ?>
						
						<?php } ?>
						
						</a>
					
					<?php   } ?>
                                        

					<div class="review-box-text"><a href="<?php the_permalink(); ?>"><?php echo review_box_title(get_the_title());?></a>
					<p><?php echo excerpt(18); ?></p></div>
                                       
                                        <?php if($title == "In Theatres") { ?>
                                        <?php if($rating_type == "disable") {} elseif($rating_type == "review") { ?>

						<!--Our Rating-->
						<div class="review-box-stars">
						<?php if($theme_our_rating_type == "1") { ?>
							<?php if(function_exists('wp_gdsr_multi_review_average')) { wp_gdsr_multi_review_average(get_post_meta($post->ID, 'ghostpool_our_rating_id', true), 0, true); } // Multi Rating Average ?>
						<?php } else { ?>
							<?php if(function_exists('wp_gdsr_render_review')) { wp_gdsr_render_review(0, 0, 'reviewit_stars_default', 24); } // Single Rating ?>
						<?php } ?>
						</div>

					<?php } else { ?>

						<!--Your Rating-->
						<div class="review-box-stars">
						<?php if($theme_your_rating_type == "1") { ?>
							<?php if(function_exists('wp_gdsr_multi_rating_average')) { wp_gdsr_multi_rating_average(get_post_meta($post->ID, 'ghostpool_your_rating_id', true), 0, 'total', true); } // Multi Rating Average ?>
						<?php } else { ?>
							<?php if(function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(0, 1, 'reviewit_stars_default', 24); } // Single Rating ?>
						<?php } ?>
						</div>

					<?php } ?>
                                                <?php } else { ?>
                                                    <div id="review-page-want-to-see"><?php if(function_exists(getILikeThis_onlycount)) getILikeThis_onlycount('get'); ?>
	Want too See
	</div>
                                                <?php } ?>
                                                 

				</div>
				
				<div class="review-box-bottom"></div>
				
			</div>
				<?php// } ?> <!-- PR - 10/29/11 - closing tag for if of mus display-->
		<?php endwhile; ?>
		
			<div class="clear"></div>
			
			<?php if($pagination == "enable") { gp_pagination(); } else {} ?>
		
		<?php else : ?>
	
			<?php echo 'No Movies in this category for now'; ?>
	
		<?php endif; $wp_query = null; $wp_query = $temp;
		
		echo $after_widget;
		// End Widget
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = $_POST['cat'];
		$instance['posts_per_page'] = $new_instance['posts_per_page'];	
		$instance['pagination'] = $_POST['pagination'];			
		$instance['rating_type'] = $_POST['rating_type'];		
		$instance['gd_sort'] = $_POST['gd_sort'];
		$instance['gd_order'] = $_POST['gd_order'];
		$instance['display'] = $_POST['display'];	
		$instance['see_all'] = $new_instance['see_all'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'cat' => '', 'posts_per_page' => '6', 'pagination' => 'disable', 'rating_type' => 'review', 'gd_sort' => 'review', 'gd_order' => 'desc', 'display' => 'compact', 'see_all' => ''); $instance = wp_parse_args( (array) $instance, $defaults ); ?>

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
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Reviews Per Page:</label>
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