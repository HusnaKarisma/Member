<?php
if(isset($_GET['json']) && $_GET['json']==1){
ob_clean();
ob_start();
header('Content-Type: application/json');
$seconds_to_cache = 1;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");

if(isset($_GET['get_kategori']))
{
	echo $kategori->kategori();
}
elseif(isset($_GET['get_crousel'])){
	echo $kategori->getimg();
}
elseif(isset($_GET['get_latest_title'])){
	echo $kategori->ambildataberitabarutitle();
}
elseif(isset($_GET['get_latest_news'])){
	echo $kategori->ambildataberitabaru(language());
}
elseif($_GET['tes']){
	echo $kategori->ambildata();
}
exit();
}