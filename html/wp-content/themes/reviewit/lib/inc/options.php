<?php

// Get all the options from the database
global $options, $shortname;
$get_option = get_option($shortname);
foreach ($options as $value) {
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}

?>