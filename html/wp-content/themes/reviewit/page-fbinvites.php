<?php
/**
 * Template Name: Page - Facebook Invites
 *
 * Page to invite friends on Facebook to your website
 *
 * Written by: Tim Nicholson on 1/15/2010
 * Contact Info: tim@xtremelysocial.com, http://xtremelysocial.com
 *
 * Version: 1.0 2010-01-15
 */
?>

<?php if(is_page()) get_header(); ?>
<?php if(is_page()) echo '<div id="content" class="column">'; ?>

<br/>
<?php

global $current_user;
get_currentuserinfo();
$cur_user = wp_get_current_user();
$cur_user_id = $cur_user->ID;

$register_redir_temp = $_SESSION['register_redir'];
if($register_redir_temp == 1){
?>
<h2 align="CENTER">Welcome to Flixmouth</h2>
<h3 align="CENTER">Start building your flixmouth network</h3>
<?php } else {?>
<h2 align="CENTER">Build your flixmouth network</h2>
<?php } ?>
<br/>
<p>Invite your friends on facebook to join flixmouth. Lets talk movies!!</p>


<?php
if ( is_user_logged_in() ) {


?>
<form action="<?php echo get_option('siteurl'); ?>/fb_invite-post.php" method="post">
	<p>Click below to send your friend invite as a facebook private message (Recommended)</p>
        <div class="Invitebutton1">
        <p><input type="submit" onclick="sendRequestToRecipients1(); return false;" value="Invite Friends on Facebook - Send a private message " /></p>
        </div>
        
        <br/>

        <p>Click below to post your friend invite on your facebook news feed</p>
        <div class="Invitebutton1">
        <p><input name="submit" type="submit" id="submit" value="Invite Friends on Facebook - Post on your wall" /></p>
        </div>
        <input type="hidden" id="xblerID" name="xbler" value="<?php echo $cur_user_id; ?>" />
        <label style="color: red" id="myLabel"></label>
        <br/>
        <?php
       $register_redir_temp = $_SESSION['register_redir'];
        if($register_redir_temp == 1){
        ?>
        <br/>
<a href="<?php bloginfo('url'); ?>/members/<?php echo $current_user->user_login; ?>/activity/" ><?php _e("Continue")?></a>
        <?php }?>
</form>
<br/>
<?php
} else {?>
    <p>You must be logged in to Invite Friends!!</p>
     <?php jfb_output_facebook_btn(); ?>
<?php } ?>
<script src="http://connect.facebook.net/en_US/all.js"></script>
    <div id="fb-root"></div>
    <script>
      FB.init({appId: '293620923982816', xfbml: true, cookie: true});
      function sendRequestToRecipients1() {
        FB.api('/me/friends', function(response) {
        var user_id = document.getElementById('xblerID').value;
        var invite_link = 'http://www.flixmouth.com/JoinFlixmouth.php?join_flix_id=';
        var numFriends = response.data.length;
        var to_list = '';
        if (numFriends > 0) {
            for (var i=0; i<numFriends-1; i++) {
                
                if(to_list=="" ){
                    to_list = response.data[i].id+',';
                }
                else{
                    to_list = to_list+response.data[i].id+',';
                }
                
            }
            to_list = to_list+response.data[i].id
        }
        FB.ui(
        {
          method: 'send',
          name: 'Friend Request',
          description: 'Has sent you a friend request on flixmouth.\n\
Flixmouth is a simple site to share movie ratings and reviews with friends.\n\
Click on this link to accept the friend request:                                     '+invite_link+user_id,
          picture: "http://www.flixmouth.com/wp-content/uploads/flixmouth_fb.jpg",
          link: invite_link+user_id,
          to: to_list
             },
     function(response) {
    if (response) {
      alert('Message was Sent');
      document.getElementById("myLabel").innerHTML = 'Message was Sent';
    } else {
      alert('Something went wrong. Please Try Again');
      document.getElementById("myLabel").innerHTML = 'Something went wrong. Please Try Again.';
    }
  }
     );
       
        });
      }
      function sendRequestToRecipients() {
        var user_id = document.getElementById('xblerID').value;
        var invite_link = 'http://www.flixmouth.com/JoinFlixmouth.php?join_flix_id=';
        FB.ui({
          method: 'send',
          name: 'Friend Request',
          description: 'Has sent you a friend request on flixmouth.\n\
Flixmouth is a simple site to share movie ratings and reviews with friends.\n\
Click on this link to accept the friend request:                                     '+invite_link+user_id,
          picture: "http://www.flixmouth.com/wp-content/uploads/flixmouth_fb.jpg",
          link: invite_link+user_id
             });
      }
     </script>



<?php if(is_page()) echo '</div>'; ?>

<?php if(is_page()) get_sidebar(); ?>

<?php if(is_page()) get_footer(); ?>
