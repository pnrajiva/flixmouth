<div class="play-button">

	<?php if(get_post_meta($post->ID, 'ghostpool_slide_url', true)) { ?><?php if(get_post_meta($post->ID, 'ghostpool_slide_read_on', true)) { ?><a href="<?php echo get_post_meta($post->ID, 'ghostpool_slide_url', true); ?>" class="read-on-link"><?php echo gp_read_on; ?></a><?php } ?><?php } ?>
				
	<a id="video-<?php the_ID(); ?>" class="pause">
		
		<img src="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_slide_image', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=344&amp;w=630&amp;zc=<?php if(get_post_meta($post->ID, 'ghostpool_slide_zoom', true)) { ?>0<?php } else { ?>1<?php } ?><?php } ?>" title="<div class='slider-thumb-caption'><strong><?php the_title(); ?></strong><p><?php the_excerpt(); ?></p></div>" alt="<?php if($theme_timthumb == "0") { ?><?php bloginfo('template_directory'); ?>/lib/scripts/timthumb.php?src=<?php } ?><?php echo get_post_meta($post->ID, 'ghostpool_slide_image', true); ?><?php if($theme_timthumb == "0") { ?>&amp;h=65&amp;w=65&amp;zc=<?php if(get_post_meta($post->ID, 'ghostpool_slide_zoom', true)) { ?>0<?php } else { ?>1<?php } ?><?php } ?>" />
		
</a>
		
	<script>
	jQuery(document).ready(function(){
		jQuery("#video-<?php the_ID(); ?>").click(function(){
			var flashvars = {
				"file": "<?php echo(get_post_meta($post->ID, 'ghostpool_slide_video', true)) ?>",
				"image": "",			
				"icons": "true",
				"autostart": "true",
				"stretching": "fill",
				"smoothing": "true",
				"bufferlength": "1",
				"screencolor": "black",
				"controlbar": "none",
				"id": "player_<?php the_ID(); ?>",
				"skin": "<?php bloginfo('template_directory'); ?>/lib/scripts/mediaplayer/fs39/fs39.xml"
			};
			
			var params = {
				"allowfullscreen": "true",
				"allowscriptaccess": "always",
				"bgcolor": "#000000",
				"wmode": "opaque"
			};
			
			var attributes = {
				"id": "player_<?php the_ID(); ?>",
				"name": "player_<?php the_ID(); ?>"
			};
			
			swfobject.embedSWF("<?php bloginfo('stylesheet_directory'); ?>/lib/scripts/mediaplayer/player.swf", "video-<?php the_ID(); ?>", "630", "344", "9", "false", flashvars, params, attributes);
			return false;
	   });
	});
	</script>

</div>