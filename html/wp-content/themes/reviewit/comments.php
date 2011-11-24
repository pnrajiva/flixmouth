<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if(post_password_required()) { ?>

	<?php
		return;
	}

?>



<?php
//added by prashanth - to get the slug from the url
$slug = basename(get_permalink());
/*************************** Comment Template ***************************/

require(ghostpool_inc . 'options.php');

// More Than One User Comment Per Review
if(get_post_meta($post->ID, 'ghostpool_review_comments', true)) {
	$comment_number = "1";
} else {
	$comment_number = "999999999";
}

global $current_user;
$args = array('post_id' => $post->ID, 'user_id' => $current_user->ID);
$usercomment = get_comments($args);

function comment_template($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
global $post;

// Review Stars Styling
if($theme_skin == "Light") {
$stars = 'reviewit_stars_light';
} else {
$stars = 'reviewit_stars_default';
}


?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment-container">

		<div class="comment-avatar">
			<?php echo get_avatar($comment,$size='60',$default=get_template_directory_uri().'/images/gravatar.gif'); ?>
		</div>

		<div class="comment-arrow"></div>

		<div class="comment-body">

			<div class="comment-author">

				<?php printf(__('%s'), comment_author_link($comment->comment_ID)) ?> <?php echo gp_says; ?>

				<?php if(is_singular('review')) { ?>

					<div class="comment-rating">
						<?php if($theme_your_rating_type == "1") { ?>
							<?php if(defined("STARRATING_INSTALLED")) { wp_gdsr_comment_integrate_multi_result(get_comment_ID(), 2, 0, $stars, 20); }?>
						<?php } else { ?>
							<?php if(defined("STARRATING_INSTALLED")) { wp_gdsr_comment_integrate_standard_result(get_comment_ID(), $stars, 20); } ?>
						<?php } ?>
					</div>
				<?php } ?>

			</div>

			<div class="comment-date">
				<?php comment_time('d F y'); ?>, <?php comment_time('g:ia'); ?>
			</div>

			<div class="comment-text">
				<?php if (defined("STARRATING_INSTALLED")) : ?>
				<div style="float: right">
					<?php  wp_gdsr_comment_integrate_multi_result(get_comment_ID(), 4, 0, "crystal", 16); ?>
				</div>
				<?php  comment_text(); endif; ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<div class="moderation">
					<?php echo gp_moderation; ?>
				</div>
				<?php endif; ?>

				<?php if(function_exists('wp_gdsr_render_comment_thumbs')) { wp_gdsr_render_comment_thumbs(0, 0, 'reviewit_thumbs', 20); } ?>

				<span>
					<?php comment_reply_link(array_merge($args, array('reply_text' => gp_reply, 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?> <?php edit_comment_link(gp_edit,'',''); ?>

				</span>
			</div>

		</div>

	</div>


<?php } ?>

<!-- Moved the comment form here -->

<?php if(count($usercomment) >= $comment_number) {} else {

	if('open' == $post->comment_status) { ?>

		<!--Begin Comment Form-->
		<div id="commentform">

			<!--Begin Respond-->
			<div id="respond">

				<?php if (has_term('In Theatres', 'review_categories') ) {?>
					<h4><?php comment_form_title('Add Your Rating'); ?></h4>

				<?php } elseif ( has_term('Coming Soon', 'review_categories')  ) {?>

					<h4><?php comment_form_title('Prerelease Comment'); ?></h4>
				<?php } else { ?>
						<h4><?php comment_form_title('Comment'); ?></h4>
				<?php } ?>


				<?php if(get_option('comment_registration') && !$user_ID) { ?>

					<p><?php echo gp_login_to_comment ?></p>

				<?php } else { ?>

					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

					<?php if ($user_ID) { ?>

						<p><?php echo gp_logged_in_as ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> <a href="<?php echo wp_logout_url(get_permalink()); ?>">(<?php echo gp_logout ?>)</a></p>

					<?php } else { ?>

						<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /> <label for="author"><?php echo gp_name ?> <span class="required"><?php if ($req) echo "*"; ?></span></label></p>

						<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /> <label for="email"><?php echo gp_email ?> <span class="required"><?php if ($req) echo "*"; ?></span></label></p>

						<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /> <label for="url"><?php echo gp_website ?></label></p>

					<?php } ?>

					<?php if(is_singular('review')) { if(get_post_meta($post->ID, 'ghostpool_your_rating_comment', true)) { ?>

						<div class="rating">

							<?php if($theme_your_rating_type == "1") { ?>
								<div class="clear"></div>
								<?php if(defined('STARRATING_INSTALLED')) { wp_gdsr_comment_integrate_multi_rating(get_post_meta($post->ID, 'ghostpool_your_rating_id', true), 0, 0, $stars, 20); } ?>
							<?php } else { ?>
								<?php if(defined('STARRATING_INSTALLED')) { wp_gdsr_comment_integrate_standard_rating(0, $stars, 20); } ?>
							<?php } ?>
						</div>

						<div class="clear"></div>

					<?php }} ?>

					<p><textarea name="comment" id="comment" cols="5" rows="7" tabindex="4"></textarea></p>

					<input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo gp_submit ?>" />
					<?php comment_id_fields(); ?>

					<?php do_action('comment_form', $post->ID); ?>


					</form>

				<?php } ?>

			</div>
			<!--End Respond-->

		</div>
		<!--End Comment Form-->

	<?php }} ?>

<!-- End of Move -->

<!--Begin Friends Comments-->
<!--Start of friends review list-->
<!--This is to get the reviews from the current logged in user friends-->
<div id="comments">
<?php if (has_term('In Theatres', 'review_categories') ) {?>
            <div id="comments-title"><h3>Friend's Reviews</h3></div>
    <?php } elseif ( has_term('Coming Soon', 'review_categories')  ) {?>
            <div id="comments-title"><h3>Friend's Comments</h3></div>
    <?php } else { }
$frndcomment_count = 0;
global $wp_query;
//$mycomments = get_comments('post_id='.$post->ID);
$mycomments = $wp_query->comments;
if ($mycomments) {
    if(is_user_logged_in()) {
        
        $comment_array = array();
        global $current_user;
        get_currentuserinfo();
        $myfids=friends_get_friend_user_ids($current_user->ID);
        if ( empty( $myfids ) ) { ?>
            <ul>
            <li><?php echo 'Add friends to flixmouth network to view their reviews';  ?></li>
            </ul>
        <?php } else {
                $args_frnd = array('walker' => null, 'max_depth' => '', 'style' => 'ul', 'callback' => null, 'end-callback' => null, 'type' => 'all',
                'page' => '', 'per_page' => '', 'avatar_size' => 32, 'reverse_top_level' => null, 'reverse_children' => '');
                if ( get_option('thread_comments') )
                        $args_frnd['max_depth'] = get_option('thread_comments_depth');
                 else
                        $args_frnd['max_depth'] = -1;
                foreach ($mycomments as $mycomment) {
                       if(in_array($mycomment->user_id,$myfids)){
                       $frndcomment_count = $frndcomment_count + 1;
                       array_push($comment_array,$mycomment);
                           ?>
                              
                                    <?php //comment_template($mycomment,$args_frnd,1); ?>
                              
                            <?php  } // end of if(in array)
                }//end of foreach
                if($frndcomment_count >0) {
                ?>
                   <ol id="commentlist">
			<?php wp_list_comments('callback=comment_template&reverse_top_level=true',$comment_array); ?>
		</ol>
      <?php  }}//end of else

    }//end of if user logged in

}
if($frndcomment_count == 0) {
    if (has_term('In Theatres', 'review_categories') ) {?>
			<ul>
                        <li><?php echo 'Be the first among your friends to review this movie!!';  ?></li>
                        </ul>
    <?php } elseif ( has_term('Coming Soon', 'review_categories')  ) {?>
			<ul>
                        <li><?php echo 'Be the first among your friends to review this movie!!';  ?></li>
                        </ul>
    <?php } elseif ( $slug == movie-forum ) {?>
			
            <?php } else { ?>
			
            <?php } ?>
	
        <?php } ?>

</div>
<!--End Friends Comments-->




<!--Begin Comments-->
<?php if('open' == $post->comment_status OR have_comments()) {

// Review Stars Styling
if($theme_skin == "Light") {
$stars = 'reviewit_stars_light';
} else {
$stars = 'reviewit_stars_default';
}

?>
	<div class="clear"></div>
	<div id="comments">
<?php } ?>


	<?php if(have_comments()) { // If there are comments ?>
        
		<?php if (has_term('In Theatres', 'review_categories') ) {?>
			<div id="comments-title"><h3><?php comments_number('No reviews Yet..', 'One Review', '% User Reviews'); ?></h3></div>

				<?php } elseif ( has_term('Coming Soon', 'review_categories')  ) {?>

			<div id="comments-title"><h3><?php comments_number('No Comments Yet1..', 'One Comment', '% User Comments'); ?></h3></div>
				<?php } else { ?>
			<div id="comments-title"><h3><?php comments_number('No Comments Yet2..', 'One Comment', '% User Comments'); ?></h3></div>
				<?php } ?>

		<ol id="commentlist">
			<?php wp_list_comments('callback=comment_template&reverse_top_level=true'); ?>
		</ol>

		<?php $total_pages = get_comment_pages_count(); if($total_pages > 1) { ?>
			<div class="wp-pagenavi"><?php paginate_comments_links(); ?></div>
		<?php } ?>

		<?php if('open' == $post->comment_status) { // If comments are open, but there are no comments yet ?>

		<?php } else { // If comments are closed ?>

			<?php if(is_single()) { ?><?php } ?>

		<?php } ?>

	<?php } else { // If there are no comments yet ?>
	<?php if (has_term('In Theatres', 'review_categories') ) {?>
			<h3><?php comments_number('No reviews Yet..', 'One Review', '% User Reviews'); ?></h3>
	<?php } elseif ( has_term('Coming Soon', 'review_categories')  ) {?>
			<h3><?php comments_number('No Comments Yet ..', 'One Comment', '% User Comments'); ?></h3>
	<?php } elseif ( $slug == movie-forum ) {?>
			<h3><?php comments_number('', '', ''); ?></h3>
	<?php } else { ?>
			<h3><?php comments_number('', '', ''); ?></h3>
	<?php } ?>


	<?php } ?>

<?php if('open' == $post->comment_status OR have_comments()) { ?>

	</div>
<?php } ?>
<!--End Comments-->
