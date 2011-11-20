<?php

//*************************** Buttons ***************************//

function ghostpool_button($atts, $content = null) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));

	$out = "<a class=\"post-button\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
    return $out;
}
add_shortcode('button', 'ghostpool_button');

?>