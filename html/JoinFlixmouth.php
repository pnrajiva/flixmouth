<?php
require('./wp-blog-header.php');
$requested_user_id = $_GET['join_flix_id'];
if(is_user_logged_in()){
    global $current_user;
    get_currentuserinfo();
    $user = wp_get_current_user();
    $potential_friend_id = $user->ID;
    if ( !is_numeric( $requested_user_id ) || !isset( $requested_user_id ) ){
        header("Location: http://www.flixmouth.com");
    } else {
        if ( !is_numeric( $potential_friend_id ) || !isset( $potential_friend_id ) ){
            header("Location: http://www.flixmouth.com");
        } else {
            if($potential_friend_id){
                if ( $potential_friend_id == $requested_user_id ){
                    echo "same users request";
                    }
                    else{
                        $friendship_status = BP_Friends_Friendship::check_is_friend( $requested_user_id, $potential_friend_id );
                        if ( 'not_friends' == $friendship_status ) {
                            if ( !friends_add_friend( $requested_user_id, $potential_friend_id ) ) {
                                bp_core_add_message( __( 'Friendship could not be requested.', 'buddypress' ), 'error' );
                                echo "error in adding a request";
                                } else {
                                        bp_core_add_message( __( 'Friendship requested', 'buddypress' ) );
                                        echo "succesful in adding a request";
                                        }
                                        } else if ( 'is_friend' == $friendship_status ) {
                                           echo "already friends";
                                        }
                        }
            }
            header("Location: http://www.flixmouth.com/members/$current_user->user_login/friends/");
    }}}else{
session_start();
$_SESSION['join_flix_userid'] = $requested_user_id;
header("Location: http://www.flixmouth.com/joinflixmouth/");
}
?>
