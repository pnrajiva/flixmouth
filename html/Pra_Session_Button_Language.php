<?php
/*
Plugin Name: Session Button Languange
Plugin URI: 
Description: This plugin allows to store session variable for different buttons
Version: 1.0.0
Author: Prashanth Rajivan
Author URI: 

Copyright 2011  Prashanth Rajivan

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/
$v1 = $_GET['langoption'];
session_start();
//if(isset($_SESSION['reglang']))
    $_SESSION['reglang'] = $v1;
//else
//    $_SESSION['reglang'] = 1;

echo "views = ". $_SESSION['reglang'];
echo '<br /><a href="http://flixmouth.com?' . SID . '">return</a>';
header("Location: http://flixmouth.com");
?>