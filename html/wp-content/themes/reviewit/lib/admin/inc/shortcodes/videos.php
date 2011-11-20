<?php

//*************************** Videos ***************************//

function ghostpool_video($atts, $content = null) {
    extract(shortcode_atts(array(
		'name' => '#',
        'url' => '#',
        'image' => '',
        'width' => '470',
        'height' => '320',
        'controlbar' => 'bottom',
        'autostart' => 'false',
        'icons' => 'true',
        'stretching' => 'fill',
        'align' => 'alignnone',
        'skin' => get_template_directory_uri().'/lib/scripts/mediaplayer/fs39/fs39.xml',
        'html5_1' => '',
        'html5_2' => '',
        'priority' => 'flash'
    ), $atts));
		
	require(ghostpool_inc . 'options.php');
	
	// Remove spaces from video name
	$video_name = preg_replace('/[^a-zA-Z0-9]/', '', $name);

	// Video Type	
	$vimeo = strpos($url,"vimeo.com");
	
	// Hide HTML5 Video Icons
	if($icons == "false") { $html5_icons = "hide-icons"; }

	// Detect MSIE
	$MSIE = (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') !== FALSE);
		
	ob_start(); ?>

	<div class="sc-video <?php echo $align; ?> <?php echo $html5_icons; ?>">
						
		<?php if($vimeo == false) { ?>

			<?php if((strpos($url,"youtube.com") OR strpos($url,"youtu.be")) && $priority == "flash") { ?>
			
				<div id="video-<?php echo $video_name; ?>"></div>
			
			<?php } else { ?>
									
				<video id="video-<?php echo $video_name; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" controls="controls">
				
				<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false OR strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) { ?>
					<source src="<?php echo $html5_1; ?>" type="video/mp4" />
					<source src="<?php echo $html5_1; ?>" type="video/webm" />
				<?php } else { ?>			
					<source src="<?php echo $html5_2; ?>" type="video/ogg" />
				<?php } ?>
				
				</video>
				
			<?php } ?>	
			
			<script>
				jwplayer("video-<?php echo $video_name; ?>").setup({
					<?php if($MSIE OR $priority == "flash") { ?>file: "<?php echo $url; ?>",<?php } ?>
					<?php if($image) { ?>
					<?php if($theme_timthumb == '0') { ?>					
						image: "<?php echo get_template_directory_uri(); ?>/lib/scripts/timthumb.php?src=<?php echo $image; ?>&h=<?php echo $height; ?>&w=<?php echo $width; ?>&zc=1",
					<?php } else { ?>
						image: "<?php echo $image; ?>",
					<?php }} ?>
					icons: "<?php echo $icons; ?>",
					autostart: "<?php echo $autostart; ?>",
					stretching: "<?php echo $stretching; ?>",
					controlbar: "<?php echo $controlbar; ?>",
					skin: "<?php echo $skin; ?>",
					screencolor: "white",
					height: <?php echo $height; ?>,
					width: <?php echo $width; ?>,
					flashplayer: "<?php echo get_template_directory_uri(); ?>/lib/scripts/mediaplayer/player.swf"
				});
			</script>
		
		<?php } else { ?>
									
			<?php if($autostart == "false") {
			$autostart = "0";
			} elseif($autostart == "true") {
			$autostart = "1";
			}
	
			// Vimeo Clip ID
			if(preg_match('/www.vimeo/',$url)) {							
				$vimeoid = trim($url,'http://www.vimeo.com/');
			} else {							
				$vimeoid = trim($url,'http://vimeo.com/');
			}				
	
			?>
			
			<iframe src="http://player.vimeo.com/video/<?php echo $vimeoid; ?>?byline=0&amp;portrait=0&amp;autoplay=<?php echo $autostart; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0"></iframe>
		
	<?php } ?>

	</div>

<?php 

$output_string = ob_get_contents();
ob_end_clean(); 

return $output_string;

}

add_shortcode('video', 'ghostpool_video');

?>