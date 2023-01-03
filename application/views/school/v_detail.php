<?php

$theme = $data["School"]["theme"];
$data["School"]['baseDir'] = "/school/theme/" . $theme . "/";
$data["School"]['baseTitle'] = $GLOBALS["Site"]["title"];

include "school/theme/" . $theme . "/index.php";
echo "<script>var site = 'school/view/{$data["School"]['code']}';</script>";

?>

