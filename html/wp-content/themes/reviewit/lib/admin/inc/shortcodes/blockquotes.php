<?php

//*************************** Blockquotes ***************************//

function ghostpool_bq_left($atts, $content = null) {
	return '<div class="blockquote-left">'.do_shortcode($content).'</div>';
}
add_shortcode("bq_left", "ghostpool_bq_left");


function ghostpool_bq_right($atts, $content = null) {
	return '<div class="blockquote-right">'.do_shortcode($content).'</div>';
}
add_shortcode("bq_right", "ghostpool_bq_right");

?>