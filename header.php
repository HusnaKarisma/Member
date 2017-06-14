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


<div class="container boxed" id="sundul">
	<div class="col-md-3 col-xs-12 col-lg-3"> 
			<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <img id="" src="assets/img/log.png"><span style="padding:10px;" class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li>
    				<a href="?multi=Multicontent"> Multi Content </a>
				</li>
				<li>
					<a href="">AFP-ANTARA Top Stories</a>
				</li>
				<li>
					<a href="">AFP-ANTARA Top Pictures </a>
				</li>
				  </ul>
				</div>
				 <div class="date kanan" style="font-weight:bold;">
					 <?php 
					 echo $bantuan->indonesian_date('', 'l, j M  Y'); ?>
				</div>
	</div>
	<div class="col-md-4 col-xs-7 col-lg-4">
		<div class="box">
				<form class="carinews" action="" method="get">
				<input class="carinew" type="text" name="cari" id="subscribe-name" value="" placeholder="Ketikan kata kunci" required="">
				<button class="button_search" type="submit" data-category="Ekonomi" data-action="Search Box" data-label="Search"><span>Cari</span></button>
				</form>
			</div>
	</div>
	<div class="col-md-5 col-xs-5 col-lg-5">
		<div id="info">
		<div style="float:right;" class="kiri bahasa">
			<div style="float:left;">
		          <a  href="?language=ENG"><i class="icon eng"></i></a> 
		          <a href="?language=INA"><i class="icon ina"></i></a> 
          	</div>
          	<div style="float:left;">
		          <span style="margin-left:20px; color:#000">
		          <?php 
		          if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1){
											echo "<strong>Selamat Datang, </strong> ";
											echo $_SESSION['userlogin']['user'];
											echo "&nbsp;"; }  
						else{
							echo '<a id="loginbtn" href="#" aria-expanded="false"> Masuk</a>';
						} ?>
					</span>
					<span>/
						<?php if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1){
											echo '<a href="?logout=1" aria-expanded="false">
											Keluar</a>';
										}  
										else{
											echo '<a id="loginbtn" href="?registration=1" aria-expanded="false">
											Daftar</a>';
										}?>
					</span>
			</div>
			<div style="float:left;">
					<a href="/memberrev2/?registration=1"><span style="margin-top:3px;margin-left:10px;" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
			</div>
    	</div> 
    	</div>
		</div>
    </div>
<div class="container boxed" id="banner">
	<div class="row">
		<div class="col-md-4 col-xs-4 col-lg-4"><a href="../memberrev2"><img id="logohead"  src="assets/img/lgmem.png"></a></div>
		<div class="col-md-6 col-xs-6 col-lg-6 tengah">
			<div class="kanan ads">
			<img src="http://ads.antaranews.com/www/img/3708160e0b73516bbe5ae982dceef403.gif">
			</div>
		</div>
		<div class="col-md-2 col-xs-2 col-lg-2 kanan res">	
			<div class="tengah">
				     	<div class="kanan"><button class="btn btn-primarys" type="button" id="btn02">
					  Daftar Baca  &nbsp;<span class="badge" id="count02">00</span>
					</button></div><br><br>					
			</div>
	</div>
</div>
</div>
<header id="top" class="bs-docs-nav navbar navbar-static-top">
<div class="container menu">
	<div class="swiper-container">
        <div class="swiper-wrapper">
				<?php 
				$kate = $kategori->kategori();
				$kate = json_decode($kate); 
				foreach ($kate as $key => $val) {
				?>
				<div class="swiper-slide"><a href="<?php echo $bantuan->baseUrl('?kategori='.$val->ID_CATEGORY)?>"><span><?php echo $val->CATEGORY_NAME ?></span></a></div>
				<?php 
				}
				?>
			</div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-prev kiri"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
        <div class="swiper-next kanan"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
    </div>

</div>
</header>
<script>
    var appendNumber = 4;
    var prependNumber = 1;
    var swiper = new Swiper('.swiper-container', {
        //pagination: '.swiper-pagination',
        nextButton: '.swiper-next',
        prevButton: '.swiper-prev',
        slidesPerView: 7,
        //centeredSlides: true,
        //paginationClickable: true,
        spaceBetween: 5,
    });
    
    </script>