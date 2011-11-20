<?php

//*************************** Dividers ***************************//

function ghostpool_divider($atts, $content = null) {
	return '<div class="divider"></div>';
}
add_shortcode("divider", "ghostpool_divider");

function ghostpool_top($atts, $content = null) {
	return '<div class="divider top"><a href="#top">'.gp_back_to_top.'</a></div>';
}
add_shortcode("top", "ghostpool_top");

function ghostpool_clear($atts, $content = null) {
	return '<div class="divider clear"></div>';
}
add_shortcode("clear", "ghostpool_clear");

?>