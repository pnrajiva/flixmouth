<script>
jQuery(window).load(function() {
	jQuery('#slider').nivoSlider({
		effect:'<?php if($theme_slider_effect == "Slice Down") { ?>sliceDown<?php } elseif($theme_slider_effect == "Slice Down Left") { ?>sliceDownLeft<?php } elseif($theme_slider_effect == "Slice Up") { ?>sliceUp<?php } elseif($theme_slider_effect == "Slice Up Left") { ?>sliceUpLeft<?php } elseif($theme_slider_effect == "Slice Up Down") { ?>sliceUpDown<?php } elseif($theme_slider_effect == "Slice Up Down Left") { ?>sliceUpDownLeft<?php } elseif($theme_slider_effect == "Fold") { ?>fold<?php } elseif($theme_slider_effect == "Fade") { ?>fade<?php } else { ?>random<?php } ?>',
		slices: <?php echo($theme_slider_slices); ?>,
		animSpeed: <?php echo($theme_slider_animation_speed); ?>,
		pauseTime: <?php echo($theme_slider_transition_speed); ?>,
		startSlide: 0,
		directionNav: false,
		directionNavHide: false,
		keyboardNav: false,
		pauseOnHover: true,
		controlNavThumbs: true,
		controlNavThumbsFromRel: false,
                controlNavThumbsSearch: '.jpg',
                controlNavThumbsReplace: '.jpg',
		manualAdvance: <?php if($theme_slider_auto_rotation == "0") { ?>false<?php } else { ?>true<?php } ?>,
		captionOpacity: 0
	});
});

jQuery(function () {
	jQuery('#slider, .pause').click(function(){
	jQuery('#slider').data('nivo:vars').stop = true;
});
});
</script>

<!--Begin Slider-->
<div id="slider-top"></div>
<div id="slider">

	<?php 
        //added by prashanth - to get session variable of the selected movie region
$lang_temp = $_SESSION['reglang'];
$lang = 'Hindi';
if($lang_temp == 1)
{
$lang = 'Hindi';
}
else if($lang_temp == 2){
$lang = 'Tamil';
}
else if($lang_temp == 3){
$lang = 'Telugu';
}
else if($lang_temp == 4){
$lang = 'Malayalam';
}
else{
$lang = 'Hindi';
}
// ends prashanth's changes
        //Added by prashanth - to list only selected language movies
	//query_posts('post_type=slide&caller_get_posts=1&posts_per_page=4&slide_categories='.$theme_slider_cat.'&slide_categories='.$lang);
        query_posts('post_type=slide&caller_get_posts=1&posts_per_page=4&slide_categories='.$lang);
        if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php if(get_post_meta($post->ID, 'ghostpool_slide_video', true)) { ?>

			<?php require('video-file.php'); ?>

		<?php } else { ?>

			<div class="slide">

				<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?><?php if(get_post_meta($post->ID, 'ghostpool_slide_read_on', true)) { ?><a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>" class="read-on-link"><?php echo gp_read_on; ?></a><?php } ?><?php } ?>

				<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?><a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>"><?php } ?>

					<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_slide_image', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=344&amp;w=630&amp;zc=<?php if(get_post_meta($post->ID, 'ghostpool_slide_zoom', true)) { ?>0<?php } else { ?>1<?php } ?><?php } ?>" title="<div class='slider-thumb-caption'><strong><?php the_title(); ?></strong><p><?php the_excerpt(); ?></p></div>" alt="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_slide_image', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=65&amp;w=80&amp;zc=<?php if(get_post_meta($post->ID, 'ghostpool_slide_zoom', true)) { ?>0<?php } else { ?>1<?php } ?><?php } ?>" />

				<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?></a><?php } ?>

			</div>

		<?php } ?>

	<?php endwhile; ?>
	<?php endif; wp_reset_query(); ?>


</div>
<!--End Slider-->