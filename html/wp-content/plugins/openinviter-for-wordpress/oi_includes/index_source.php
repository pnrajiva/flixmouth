<?php
/*
 * Created on Sep 9, 2008
 *
 * Owner: George
 */
include("../xvf.php");
$cOption='demo';

echo template_begin();
echo ptitle("OpenInviter Example - Source Code",'dark');
echo "<div width='955' style='overflow:auto;border:1px dashed;'>";
echo highlight_file('index.php',true);
echo "</div><br><center><a href='/demo/'>back to example</a></center>";
echo template_end();
?>
