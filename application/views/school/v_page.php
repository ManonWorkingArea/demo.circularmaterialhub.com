<?php

//echo "<pre>";
//print_r($data["School"]);
//echo "</pre>";

$theme = $data["School"]["theme"];
$data["School"]['baseDir'] = "/school/theme/" . $theme . "/";
$data["School"]['baseTitle'] = $GLOBALS["Site"]["title"];

include "school/theme/" . $theme . "/page.php";

echo "<script>var site = 'school/view/{$data["School"]['code']}';</script>";

?>

