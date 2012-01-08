<?php
/*
Plugin Name: Simple Image Widget
Description: Using this widget you can easily place an image and link in the sidebar. It supports multiple instances, so you can use it multiple times in multiple sidebars. 
Version: 2.1
Author: Chris Vickio
Author URI: http://vickio.net
*/
?>
<?php
/*	Copyright 2011	Chris Vickio	(email : chris@vickio.net)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA	 02110-1301	 USA
*/
?>
<?php

// Inspired by the built-in WP_Widget_Text class
class WP_Widget_Simple_Image extends WP_Widget {

  // Set up the widget classname and description
	function WP_Widget_Simple_Image() {
		$widget_ops = array('classname' => 'widget_simpleimage', 'description' => __('Display an image'));
		$control_ops = array();
		$this->WP_Widget('simpleimage', __('Simple Image'), $widget_ops, $control_ops);
	}

  // Display the widget on the web site
	function widget( $args, $instance ) {
		extract($args);

    // Optionally generate the link code
  	if ($instance['link']) {
  		if ($instance['new_window'])
  			$before_image = "<a href=\"".$instance['link']."\" target=\"_blank\">";
  		else
  			$before_image = "<a href=\"".$instance['link']."\">";

  		$after_image = "</a>";
  	}		
	if ( is_user_logged_in() ) {} else{
  	echo $before_widget; ?>

  	<div class="simpleimage">
  	  <?php echo $before_image; ?>
            <h2>What is Flixmouth?</h2>
  		<img src="<?php echo $instance['image']; ?>" alt="<?php echo $instance['alt']; ?>" title="<?php echo $instance['img_title']; ?>" />

  		<?php echo $after_image; ?>
  	</div>
  	<?php echo $after_widget;
        }
	}

  // Save the settings for this instance
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['alt'] = strip_tags($new_instance['alt']);
		$instance['img_title'] = strip_tags($new_instance['img_title']);
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['new_window'] = isset($new_instance['new_window']);
		return $instance;
	}

  // Display the widget form in the admin interface
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'alt' => '', 'img_title' => '', 'link' => '', 'new_window' => false ) );

    // Generate a title based on the image URL
		if ($instance['image'])
  		$title = preg_replace('/\?.*/', "", basename($instance['image']));

?>
    <?php // Hidden title field for the admin interface to display ?>
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="hidden" value="<?php echo $title; ?>" />

		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>">
				<?php _e('Image URL (required):'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $instance['image']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('alt'); ?>">
				<?php _e('Alternate Text:'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" type="text" value="<?php echo $instance['alt']; ?>" />
				<br />
				<small><?php _e( 'Shown if the image cannot be displayed' ); ?></small>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('img_title'); ?>">
				<?php _e('Title:'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('img_title'); ?>" name="<?php echo $this->get_field_name('img_title'); ?>" type="text" value="<?php echo $instance['img_title']; ?>" />
				<br />
				<small><?php _e( 'Shown when the mouse cursor is held over the image' ); ?></small>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>">
				<?php _e('Link URL:'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $instance['link']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('new_window'); ?>">
				<input id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" type="checkbox" <?php if ($instance['new_window']) echo 'checked="checked"'; ?> />
				<?php _e('Open link in new window'); ?>
			</label>
		</p>
<?php
	}
}

// Init function for registering the widget
function widget_simpleimage_init() {
  register_widget('WP_Widget_Simple_Image');
}
add_action('init', 'widget_simpleimage_init', 1);

?>
