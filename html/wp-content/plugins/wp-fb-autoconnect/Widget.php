<?php


/**
  * Sidebar LoginLogout widget with Facebook Connect button
  **/
class Widget_LoginLogout extends WP_Widget
{
    //////////////////////////////////////////////////////
    //Init the Widget
    function Widget_LoginLogout()
    { 
        $this->WP_Widget( false, "WP-FB AutoConnect Basic", array( 'description' => 'A sidebar Login/Logout form with Facebook Connect button' ) );
    }
     
    //////////////////////////////////////////////////////
    //Output the widget's content.
    function widget( $args, $instance )
    {
        //Get args and output the title
        extract( $args );
        echo $before_widget;
        $title = apply_filters('widget_title', $instance['title']);
        if( is_user_logged_in() ):
             $userdata1 = wp_get_current_user();
            $title = 'Welcome'.'  '.$userdata1->display_name.'!';
            endif;
        if( $title ) echo $before_title . $title . $after_title;
        
        //If logged in, show "Welcome, User!"
        if( is_user_logged_in() ):
        ?>
            <div style='text-align:center'>
              <?php 
                $userdata = wp_get_current_user();
                echo __('Welcome') . ', ' . $userdata->display_name;
                global $current_user; get_currentuserinfo(); 
              ?>!<br /><br />
              <big>
                <a href="<?php bloginfo('url'); ?>/members/<?php echo $current_user->user_login; ?>/activity/"><?php _e("My Wall")?></a> | <a href=" <?php echo wp_logout_url( $_SERVER['REQUEST_URI'] )?>"><?php _e("Logout")?></a>
              </big>
            </div>
        <?php
        //Otherwise, show the login form (with Facebook Connect button)
        else:
        ?>
 <div style='text-align:center'>
     <?php if ( is_home() ) { ?>
     <h4>Flixmouth is a new social networking site for indian movie enthusiasts</h4>
     <p>Flixmouth helps you share movie reviews with your friends</p>
     <a href="<?php bloginfo('url'); ?>/about/what-is-flixmouth/">What is Flixmouth</a> <span>|</span>
            <?php
            global $opt_jfb_hide_button;
            if( !get_option($opt_jfb_hide_button) )
            {
                jfb_output_facebook_btn();
                //jfb_output_facebook_init(); This is output in wp_footer as of 1.5.4
                //jfb_output_facebook_callback(); This is output in wp_footer as of 1.9.0
            }
            ?>
     <?php } else { ?>
        <p>Flixmouth helps you share movie reviews with your friends</p>
        <a href="<?php bloginfo('url'); ?>/about/what-is-flixmouth/">What is Flixmouth</a> <span>|</span>
            <?php
            global $opt_jfb_hide_button;
            if( !get_option($opt_jfb_hide_button) )
            {
                jfb_output_facebook_btn();
                //jfb_output_facebook_init(); This is output in wp_footer as of 1.5.4
                //jfb_output_facebook_callback(); This is output in wp_footer as of 1.9.0
            }
            ?>
     <?php } ?>
     </div>
        <?php
        endif;
        echo $after_widget;
    }
    
    
    //////////////////////////////////////////////////////
    //Update the widget settings
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    ////////////////////////////////////////////////////
    //Display the widget settings on the widgets admin panel
    function form( $instance )
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <?php
    }
}


//Register the widget
add_action( 'widgets_init', 'register_jfbLogin' );
function register_jfbLogin() { register_widget( 'Widget_LoginLogout' ); }

?>