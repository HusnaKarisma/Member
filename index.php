<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
<link href="assets/bootstrap-toggle.min.css" rel="stylesheet">
<link href="assets/prettify.css" rel="stylesheet">
<link rel="stylesheet" href="dist/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="assets/custom.css">
<link rel="stylesheet" type="text/css" href="assets/Alert/sweetalert.css">
<script language="JavaScript" type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
<script language="JavaScript" src="dist/js/swiper.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/Alert/sweetalert.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/Alert/sweetalert-dev.js"></script>
<?php
	session_start();
	include_once 'lib/mail/mail.php';
	include_once 'lib/Mobile_Detect.php';
	include_once 'ajax_more.php';
	
	include_once 'class.user.php';
	include_once 'lib/fungsi_paging.php';
	include_once 'json_format.php';
	
	$page = isset($_GET['kategori']) ? $_GET['kategori'] : "";
	$lates_news = isset($_GET['lates_news']) ? $_GET['lates_news'] : "";
	$multi = isset($_GET['multi']) ? $_GET['multi'] : "";
	$news_id = isset($_GET['news_id']) ? $_GET['news_id'] : "";
	$news_multi = isset($_GET['news_multi']) ? $_GET['news_multi'] : "";
	$regis = isset($_GET['registration']) ? $_GET['registration'] : "";
	$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
	$lupapassword = isset($_GET['lupapassword']) ? $_GET['lupapassword'] : "";

	if($page != ""){/*print_r(getnewsbykategoriid($page));*/}

if($mobile->isMobile() == 1){
	header("Location: Mobile/id/beranda.php");
	die();
}
else{
?>
<!DOCTYPE html>
<html>
<head>
<title> Member-Antaranews</title>
</head>
<body>
		<?php  
		
		include 'header.php'; ?>
		<?php 
		if($page != ""){
			include 'kategori.php';
		}
		elseif($lates_news != ""){
			include "lates_news.php";
		}
		elseif($multi != ""){
			include "kategorimulti.php";
		}
		elseif($news_id != ""){
			include "single_news.php";
		}
		elseif($news_multi != ""){
			include "single_news_multi.php";
		}
		elseif($cari != ""){
			include "cari_news.php";	
		}
		elseif($lupapassword != ""){
			include "lupapassword.php";
		}
		elseif($regis != ""){
			include "registration.php";
		}
		else{
			include 'content.php';
		}
		?>
		<?php include 'footer.php'; ?>
</body>
</html>
<?php 
}
?>

