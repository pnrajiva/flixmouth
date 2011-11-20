<?php

/*************************** Latest Members Widget ***************************/

add_action( 'widgets_init', 'latest_members_widgets' );

function latest_members_widgets() {
	register_widget( 'Latest_Members' );
}

class Latest_Members extends WP_Widget {
	function Latest_Members() {
		$widget_ops = array( 'classname' => 'latest_members', 'description' => 'Displays the avatars of the latest registered users.' );
		$this->WP_Widget( 'latest-members-widget', 'GP Latest Members', $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$avatars = $instance['avatars'];
		
		// Begin Widget
		echo $before_widget;
		
		if ($title) echo $before_title . $title . $after_title; ?>
		
		<div class="latest-members-widget">
			<?php global $wpdb;
			$szSort = "user_registered";
			$aUsersID = $wpdb->get_col( $wpdb->prepare(
			"SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY ID DESC LIMIT $avatars", $szSort ));
			foreach ( $aUsersID as $iUserID ) :
			$user = get_userdata( $iUserID );
			echo '<a href="'.get_bloginfo(url).'/?author='.$iUserID.'">'.get_avatar($iUserID, 35,$default=get_template_directory_uri().'/images/gravatar.gif').'</a>';
			endforeach; ?>
		</div>
	
		<?php
		
		echo $after_widget;
		// End Widget
		
	}

	function update( $new_instance, $old_instance ) {	
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['avatars'] = strip_tags( $new_instance['avatars'] );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => 'Latest Members', 'avatars' => 20);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'avatars' ); ?>">Number Of Avatars To Display:</label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'avatars' ); ?>" name="<?php echo $this->get_field_name( 'avatars' ); ?>" value="<?php echo $instance['avatars']; ?>" />
		</p>
		
		<?php
	}

}

?>