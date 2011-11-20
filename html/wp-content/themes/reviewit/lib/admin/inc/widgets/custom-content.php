<?php

/*************************** Custom Content Widget ***************************/

add_action( 'widgets_init', 'custom_content_widgets' );

function custom_content_widgets() {
	register_widget( 'Custom_Content' );
}

class Custom_Content extends WP_Widget {
	function Custom_Content() {
		$widget_ops = array( 'classname' => 'custom_content', 'description' => 'Display custom content such as Google ads, flash and javascript.' );
		$control_ops = array('width' => 300);
		$this->WP_Widget( 'custom_content-widget', 'GP Custom Content', $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$content = $instance['content'];
		
		// Begin Widget
		echo $before_widget;
		
		echo $before_title . $title . $after_title; ?>
		
		<div class="textwidget">
			<?php echo do_shortcode($content); ?>
		</div>
		
		<?php
		
		echo $after_widget;
		// End Widget
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['content'] = ( $new_instance['content'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'content' => ''); $instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>">Content:</label>
			<textarea style="width: 300px; height: 250px;" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo $instance['content']; ?></textarea>
		</p>

		<?php
	}

}

?>