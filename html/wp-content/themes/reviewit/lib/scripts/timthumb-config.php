<?php

define ('FILE_CACHE_DIRECTORY', '');

// If ALLOW_EXTERNAL is true and ALLOW_ALL_EXTERNAL_SITES is false, then external images will only be fetched from these domains and their subdomains. 
$ALLOWED_SITES = array (

);

// Maximum image width
define ('MAX_WIDTH', 1500);

// Maximum image height
define ('MAX_HEIGHT', 1500);

//Image to serve if any 404 occurs 
define ('NOT_FOUND_IMAGE', '');
//Image to serve if any 404 occurs 

//Image to serve if an error occurs instead of showing error message 
define ('ERROR_IMAGE', '');

?>