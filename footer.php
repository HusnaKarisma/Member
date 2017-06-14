</div>
</div>
<footer>
	<div class="container">
  <div class="row foot1">
      <div class="container">
      <div class="swiper-container s">
        <div class="swiper-wrapper">
        <?php 
        $kate = $kategori->kategori();
        $kate = json_decode($kate); 
        foreach ($kate as $key => $val) {
        ?>
        <div class="swiper-slide"><a href="<?php echo $bantuan->baseUrl('?kategori='.$val->ID_CATEGORY)?>"><?php echo $val->CATEGORY_NAME ?></a></div>
        <?php 
        }
        ?>
      </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-prev s kiri"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
        <div class="swiper-next s kanan"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
      </div>
    </div>

	<div class="row foot2">
	<div class="col-md-4 col-xs-4 col-lg-4"><div class="logofooter"><img src="assets/img/logowhite.png"></div></div>
	<div class="col-md-8 col-xs-8 col-lg-8">
		  <b class="kanan" style="color:#fff; padding-top:30px;">Copyright <a style="color:#fff; " href="http://www.antaranews.com/">ANTARA</a>  All Rights Reserved</b>
	</div>
	</div>
	</div>
</footer>
<section> 
        <div class="bottom_logo">
  <ul>
    <li><a href="http://www.antaranews.com" title="ANTARA News">
    <img alt="www.antaranews.com" src="bottom/logo_antara_news_small.gif" width="110" height="18"></a></li>
    <li><a target="_blank" title="ANTARA Foto" href="http://www.antarafoto.com/"><img alt="Antara Foto" src="bottom/logo_antara_photo.gif" width="123" height="20"></a></li>
    <li><img alt="Gohitzz" src="bottom/gohitzz.gif" width="67" height="30"></li>
    <li><img alt="IMQ" src="bottom/logo_imq.gif" width="35" height="31"></li>
    <li><a target="_blank" title="Asianet" href="http://www.asianetnews.net/"><img alt="Asianet" src="bottom/logo_asianet.gif" width="36" height="24"></a></li>
    <li><a target="_blank" title="OANA" href="http://www.oananews.org/"><img alt="OANA" src="bottom/logo_oana.gif" width="83" height="30"></a></li>
  </ul>
</div>
</section>
		<a href="#top" class="backtopbutton" style="display: block;"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Daftar Baca</h4>
      </div>
      <div class="modal-body">
   			<div id="rilNewsList"><ul class="list-group">
			</ul></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primarys delBtn01">Hapus</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="login" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="#" method="Post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
  </div>
        <center>
        <a href="?lupapassword=1" class="regis"><b style="color:red;">Lupa Password ?</b> </a> 
        <br> <br>
      <img style="width:100%;max-width:300px;" src="assets/img/lgmem.png">
      <br><br>
      Sign-in problems?<br>
      Contact <strong>webmaster@antara.co.id</strong><br><br>
       <br>Trial Access?<br>
      
      Contact <strong>sales@antara.co.id</strong>
      <br>
      </center>

      </div>
      <div class="modal-footer">
      <!--<dl><dt>Select :</dt><dd class="firstChild"><a class="track" href="">All</a></dd><dd class="secondChild"><a class="track" href="">None</a></dd></dl>-->
              
        <button type="submit" class="btn btn-primarys login">Login</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>
<script language="JavaScript" type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/js/bootstrap-toggle.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/js/jquery.nicescroll.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/jquery.bootstrap.wizard.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/jquery.bootstrap.wizard.min.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/prettify.js"></script>
<script language="JavaScript" type="text/javascript" src="assets/js/main.js"></script>
<script>
    var appendNumber = 4;
    var prependNumber = 1;
    var swiper = new Swiper('.swiper-container.s', {
        //pagination: '.swiper-pagination',
        nextButton: '.swiper-next.s',
        prevButton: '.swiper-prev.s',
        slidesPerView: 7,
        //centeredSlides: true,
        //paginationClickable: true,
        spaceBetween: 4,
    });
    
    </script>
</div>