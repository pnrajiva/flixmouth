<?php
/**
 * Template Name: JoinFlixmouth_template
 *
 * Page to store user id in session  - pre page for connecting firends after a freind request sent to fb
 *
 * Written by: Prashanth Rajivan
 * Contact Info: 
 *
 * Version: 1.0 2010-01-15
 */
?>
<?php
session_start();
$v1 =$_SESSION['join_flix_userid'];
?>
<?php if(is_page()) get_header(); ?>
<?php if(is_page()) echo '<div id="content" class="column">'; ?>
<br/>
<div id="page-wrapper">
<h2>Join Flixmouth!</h2>
<p>Click below to accept your friend's request and to join flixmouth. Its that simple!!</p>
<br/>
<?php jfb_output_facebook_btn(); ?>
<br/>
<br/>
<div class="clear"></div>
</div>
<?php if(is_page()) echo '</div>'; ?>
<?php if(is_page()) get_footer(); ?>