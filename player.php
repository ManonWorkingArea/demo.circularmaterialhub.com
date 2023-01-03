<?php
session_start();
$sid = session_id();

$path = "https://fti-central.s3.ap-southeast-1.amazonaws.com/1598241104607398953/16007286211920931651/160072865677929058.mp4";

$hash = md5($path.$sid); //You need to use proper encryption. This is not secure at all.

$_SESSION[$hash] = $path;


$path = "http://45.76.176.153/video/16007286351891678812.m3u8";

?>

<html>
<head></head>
<body>

    <video width="320" height="240" controls>
        <source src="https://45.76.176.153/video/16007286351891678812_320p.m3u8" type="video/mp4">
    </video>

</body>
</html>
