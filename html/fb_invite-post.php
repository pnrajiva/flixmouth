<?php
/**
 * Handles Invite Post to Facebook.
 *
 * 
 */

if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );

nocache_headers();

//----start of facebook neews feed code ---
if(class_exists('Facebook')){

}
else{
    require_once('./facebook.php');
}
try{
global $current_user;
get_currentuserinfo();
$cur_user = wp_get_current_user();
$cur_user_id = $cur_user->ID;
$location_post = 'http://www.flixmouth.com/JoinFlixmouth.php?join_flix_id='.$cur_user_id;
$linkname = 'Friend Request';
$mymessage= 'Has sent you a friend request on flixmouth';
$facebook = new Facebook(array('appId'=>'293620923982816', 'secret'=>'8d2cd043acd87fbf7e4d66e669aac92f','cookie'=>true));
$myfriends = $facebook->api('/me/friends','get',array('access_token'=>$facebook->access_token));
echo count($myfriends);
$facebook->api('/me/feed/', 'post', array('access_token'=>$facebook->access_token,'to'=>$myfriends,'message'=>$mymessage, 'link'=>$location_post, 'name'=>$linkname ));
}
catch(FacebookApiException $e){
 echo "error";
}
//--- End of facebook news feed code --
//header("Location: http://www.flixmouth.com/fb-invite/");
//exit;
?>
