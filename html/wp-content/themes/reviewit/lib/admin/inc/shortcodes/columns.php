<?php

//*************************** Columns ***************************//

function ghostpool_columns($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'height' => ''
	), $atts));
	
	if($code=="one") {
	$class = "one last";	
	} elseif($code=="two") {
	$class = "two first";	
	} elseif($code=="two_last") {
	$class = "two last";	
	} elseif($code=="three") {
	$class = "three first";	
	} elseif($code=="three_middle") {
	$class = "three middle";
	} elseif($code=="three_last") {
	$class = "three last";	
	} elseif($code=="four") {
	$class = "four first";	
	} elseif($code=="four_middle") {
	$class = "four middle";	
	} elseif($code=="four_last") {
	$class = "four last";	
	} elseif($code=="onethird") {
	$class = "onethird first";
	} elseif($code=="onethird_last") {
	$class = "onethird last";	
	} elseif($code=="twothirds") {
	$class = "twothirds first";	
	} elseif($code=="twothirds_last") {
	$class = "twothirds last";
	} elseif($code=="onefourth") {
	$class = "onefourth first";	
	} elseif($code=="onefourth_last") {
	$class = "onefourth last";
	} elseif($code=="threefourths") {
	$class = "threefourths";		
	} elseif($code=="threefourths_last") {
	$class = "threefourths last";		
	}
	
    if(esc_attr($type) == "blank") {
	$col_type = "blank";
	} elseif(esc_attr($type) == "joint") {
	$col_type = "joint";
	} elseif(esc_attr($type) == "separate") {
	$col_type = "separate";
	}
	
	if(esc_attr($height) !='') {
	$height = 'style="height:'.esc_attr($height).'px"';
	}
	
	$clear = strpos($class,"last");

	if($clear === false) {
		return '<div class="columns '.$class.'"><div '.$height.'>'.do_shortcode($content).'</div></div>';
	} else {
		return '<div class="columns '.$class.'"><div '.$height.'>'.do_shortcode($content).'</div></div><div class="clear"></div>';
	}
}

add_shortcode("one", "ghostpool_columns");
add_shortcode("two", "ghostpool_columns");
add_shortcode("two_last", "ghostpool_columns");
add_shortcode("three", "ghostpool_columns");
add_shortcode("three_middle", "ghostpool_columns");
add_shortcode("three_last", "ghostpool_columns");
add_shortcode("four", "ghostpool_columns");
add_shortcode("four_middle", "ghostpool_columns");
add_shortcode("four_last", "ghostpool_columns");
add_shortcode("onethird", "ghostpool_columns");
add_shortcode("onethird_last", "ghostpool_columns");
add_shortcode("twothirds", "ghostpool_columns");
add_shortcode("twothirds_last", "ghostpool_columns");
add_shortcode("onefourth", "ghostpool_columns");
add_shortcode("onefourth_last", "ghostpool_columns");
add_shortcode("threefourths", "ghostpool_columns");
add_shortcode("threefourths_last", "ghostpool_columns");

?>