<?php

//*************************** Toggle Box ***************************//

function ghostpool_toggle_content($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<h4 class="toggle"><a href="#">' .$title. '</a></h4>';
	$out .= '<div class="toggle-box" style="display: none;"><p>';
	$out .= do_shortcode($content);
	$out .= '</p></div>';

   return $out;
}
add_shortcode('toggle', 'ghostpool_toggle_content');

?>