<?php

/*************************** Review Categories Widget ***************************/

class Review_Categories extends WP_Widget {

    function Review_Categories() {
        $widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of review categories" ) );
        $this->WP_Widget('review_categories', __('GP Review Categories'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title']);
        $c = $instance['count'] ? '1' : '0';
        $h = $instance['hierarchical'] ? '1' : '0';
        $d = $instance['dropdown'] ? '1' : '0';

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;

			$cat_args = array('taxonomy' => 'review_categories', 'orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

        if ( $d ) {

			if($c == "1") {
        
        		if(!function_exists('get_terms_dropdown')) {
				function get_terms_dropdown($taxonomies, $cat_args){
					$myterms = get_terms($taxonomies, $cat_args);
					$output = "<select id='review-cat' name='review-cat' class='selection'><option value='-1'>Select Category</option>";
				
					foreach($myterms as $term){
						$term_taxonomy = $term->taxonomy;
						$term_slug = $term->slug;
						$term_name = $term->name;
						$term_count = " (".$term->count.")";
						$output .="<option value='".$term_slug."'>".$term_name.$term_count."</option>";
					}
					$output .= "</select>";
					return $output;
				}
				}
			
			} else {
			
				if(!function_exists('get_terms_dropdown')) {
				function get_terms_dropdown($taxonomies, $cat_args){
					$myterms = get_terms($taxonomies, $cat_args);
					$output = "<select id='review-cat' name='review-cat'><option value='-1'>Select Category</option>";
				
					foreach($myterms as $term){
						$term_taxonomy = $term->taxonomy;
						$term_slug = $term->slug;
						$term_name = $term->name;
						$output .="<option value='".$term_slug."'>".$term_name."</option>";
					}
					$output .= "</select>";
					return $output;
				}
				}

			}
			
			$taxonomies = array('review_categories');
			
			echo get_terms_dropdown($taxonomies, $cat_args);
			
			?>

			<script type='text/javascript'>
			/* <![CDATA[ */
				var dropdown = document.getElementById("review-cat");
				function onCatChange() {
					if ( dropdown.options[dropdown.selectedIndex].value != '-1' ) {
						location.href = "<?php echo home_url(); ?>/?review_categories="+dropdown.options[dropdown.selectedIndex].value;
					}
				}
				dropdown.onchange = onCatChange;
			/* ]]> */
			</script>

		<?php } else { ?>
		
			<ul>
				<?php
				$cat_args['title_li'] = '';
				wp_list_categories(apply_filters('widget_categories_args', $cat_args));
				?>
			</ul>
			
		<?php
		
        }

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = $new_instance['count'] ? 1 : 0;
        $instance['hierarchical'] = $new_instance['hierarchical'] ? 1 : 0;
        $instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

        return $instance;
    }

    function form( $instance ) {
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr( $instance['title'] );
        $count = isset($instance['count']) ? (bool) $instance['count'] :false;
        $hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
        $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
        <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Show as dropdown' ); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
        <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
        
<?php

    }

}

add_action('widgets_init', create_function('', "register_widget('Review_Categories');"));

?>