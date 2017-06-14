<?php 
	$id_mem=@$_SESSION['userlogin']['id'];
	$tipe = $user->tipemem($id_mem);
	$tipe = @$tipe[0]['tipe_mem'];


	$artikel = $kategori->get_articlemulti_by_id($news_multi) ;
	$artikel = json_decode($artikel);

	$kode = $artikel[0]->cate;

	$tanggal = $artikel[0]->tanggal;
	$tanggal = date("M j, g:i a", strtotime($tanggal));

	$image_list = $kategori->getimg($_GET['news_multi']); 
	$image_list = json_decode($image_list);

	$var = $bantuan->baseUrl() . "?news_multi=". $_GET['news_multi']; 
	$dataimg = $kategori->getimg($_GET['news_multi']);
	$dataimg = json_decode($dataimg);

	$datajumlah = $kategori->getjumlahdata($_GET['news_multi']);
	$datajumlah = json_decode($datajumlah);         

	$datavideo = $kategori->getjumlahvideo($_GET['news_multi']);
	$datavideo = json_decode($datavideo);

	$datainfo = $kategori->getjumlahinfografis($_GET['news_multi']);
	$datainfo = json_decode($datainfo);
	$video_list = $kategori->getvideo($_GET['news_multi']);
	$video_list = json_decode($video_list);
	$infografis_list = $kategori->getinfo($_GET['news_multi']);
	$infografis_list = json_decode($infografis_list);
	//print_r($bantuan->get_ip_address());
	$popular = $kategori->popular_news($_GET['news_multi']);

?>
<div class="container artikelnews">
	<div class="row contenbottom boxed">
	<div class="col-md-9 col-xs-12 col-lg-9 ">
		<div class="isi_artikel">
			<div class="col-md-12 col-xs-12 col-lg-12 area">
				<div class="tabmenu">
					<div class="artikelspesifik" data-newsid="multi<?php echo $artikel[0]->no;?>">
						<div class="panel panel-default">
							<div class="panel-body">
								<?php 
									 						if($datajumlah[0]->jumlah >= 1 ){
									 						echo $datajumlah[0]->jumlah;
									 						echo  " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-picture\"></span> ";
									 						}
									  						if($datavideo[0]->jumlahvideo >= 1 ){ 
									  						  echo $datavideo[0]->jumlahvideo;
									  						  echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-film\"> </span> ";
									  						}
									  						 if($datainfo[0]->jumlahinfo >= 1){
									  						  echo $datainfo[0]->jumlahinfo;
									  						  echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span>  <span class=\"date\"> <?php echo $tanggal  ?> </span> ";
									  						}
									  						?>
								<div class="readitpos">
									<a href="#">
									<p>
										<img src="assets/img/ico_read.gif"> Baca Nanti
									</p>
									</a>
								</div>
							</div>
						</div>
						<br>
						<br>
						
						<div class="judulartikel">
							<h3><?php echo  $bantuan->upercasefirst($artikel[0]->title); ?>
							</h3>
						</div>
						<div class="tanggal">
								<?php echo $tanggal ;?>
						</div>
						<div class="foto1">
							<img src="">
							<div class="captionartikel">
							</div>
						</div>
						<div class="tulisanartikel">
							<p>
								<?php

									$i=0;
								 if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1 and $tipe == 2){
								 	?>
								 	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner" role="listbox">
								 	<?php
									foreach($image_list as $key=>$val){
									$img = $val->fotoname;
									$varactive="";
									$cap = $val->caption;
									$cap = substr($cap,0, 200);
									if ($key == 0){
										$varactive ="active";
									}
									?>

									<div class="item <?php echo $varactive; ?>">
									<img src="<?php echo $bantuan->baseUrl() . "foto/preview/". $img; ?>" style="width:100%;">
							
									<div class="carousel-caption ">
										 <?php echo $cap;  ?> .... 
									</div>
									</div>
									

									<?php $i++; } 
									?>
									</div>

									<?php if($i > 1){ ?>
									<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
									</a>
									<?php } ?>
									</div>
									<?php
									$text = $artikel[0]->content;
									echo $text;
									?>
									<br><br>
									<?php
									foreach($image_list as $key=>$val){
									$foto = $val->fotoname;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "foto/". $foto; ?>">Download Foto </a> 
									<?php } 
									?>
									<br><br>
									<?php

									foreach($video_list as $key=>$val){
									$video = $val[0]->video;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "video/". $video; ?>">Download Video </a> 
									<?php }

									?>
									<br><br>
									<?php

									foreach($infografis_list as $key=>$val){
									$info = $val[0]->infografis;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "foto/". $info; ?>">Download Infografis </a> 
									<?php } 
								}
								elseif(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1 and $tipe == 1) {

										$checkcode = $user->checkcustom($id_mem,$kode);
								 		if($checkcode >= 1 ){
								 			//print_r($checkcode);
								 			?>
								 			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner" role="listbox">
								 	<?php
								 	if($checkcode[0]['foto'] ==1){
									foreach($image_list as $key=>$val){
									$img = $val->fotoname;
									$varactive="";
									$cap = $val->caption;
									$cap = substr($cap,0, 200);
									if ($key == 0){
										$varactive ="active";
									}
									?>

									<div class="item <?php echo $varactive; ?>">
									<img src="<?php echo $bantuan->baseUrl() . "foto/preview/". $img; ?>" style="width:100%;">
							
									<div class="carousel-caption ">
										 <?php echo $cap;  ?> .... 
									</div>
									</div>
									

									<?php $i++; } 
									}
									else{
										echo '<div class="alert alert-danger">
											  <strong>Maaf!</strong> Anda tidak berlangganan paket custom Foto</div>';
									} 
									?>
									</div>
									<?php if($i > 1){ ?>
									<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
									</a>
									<?php } ?>
									</div>
									<?php
									if($checkcode[0]['text'] ==1){
								 			$artikel = $artikel[0]->content;
								 			
											echo $bantuan->convert_chars_to_entities($artikel);
									}
									else{
										echo '<div class="alert alert-danger">
											  <strong>Maaf!</strong> Anda tidak berlangganan paket custom Text</div><br>';
									}
									?>
									<br><br>
									<h3 class="title-tab">Download  Paket File</h3>
									<br>
									<?php
									if($checkcode[0]['foto'] ==1){
									foreach($image_list as $key=>$val){
									$foto = $val->fotoname;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "foto/". $foto; ?>">Download Foto </a> 
									
									<?php
									}
									?>
									<br><br>
									<?php
									}
									else{
										echo '<div class="alert alert-danger">
											  <strong>Maaf!</strong> Anda tidak berlangganan paket custom Foto</div><br>';
									} 
									?>
									<?php
									if($checkcode[0]['video'] ==1){
									foreach($video_list as $key=>$val){
									$video = $val[0]->video;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "video/". $video; ?>">Download Video </a> 
									
									<?php
									}
									?>
									<br><br>
									<?php
									}
									else{
										echo '
										<div class="alert alert-danger">
											  <strong>Maaf!</strong> Anda tidak berlangganan paket custom video</div><br>';
									}
									?>
									
									<?php
									if($checkcode[0]['infografis'] ==1){
									foreach($infografis_list as $key=>$val){
									$info = $val[0]->infografis;
									?>
									<a class="btn btn-default" href="<?php echo $bantuan->baseUrl() . "foto/". $info; ?>">Download Infografis </a> 
									?>
									<?php
									}
									?>
									<br>
									<?php
									}
									else{

										echo '<div class="alert alert-danger">
											  <strong>Maaf!</strong> Anda tidak berlangganan paket custom Infografis</div><br>';
									}
								 	}
								 		else{
								 				$img = $artikel[0]->fotoname; ?>
									<div class="img"><img  src="<?php echo $bantuan->baseUrl() . "foto/thumbs/". $img; ?>" ></div><br>

										<?php
								 				echo substr( $artikel[0]->content , 0, 200);
												echo "<br><br><div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to subscribe. We offer a broad range of subscription options depending on your needs. Learn more.</div>";		
								 		}


								}  
								else{
									foreach([$artikel] as $key=>$val){
									$img = $val[0]->fotoname;
									?>

									<div class="img"><img  src="<?php echo $bantuan->baseUrl() . "foto/thumbs/". $img; ?>" ></div><br>
									<?php } 

									echo substr( $artikel[0]->content , 0, 200);
									echo "<br><br><div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to subscribe. We offer a broad range of subscription options depending on your needs. Learn more.</div>";
								}
								?>
							</p>
						</div>
						<br>
						<br>
						<div class="panel panel-default">
							<div class="panel-body">
													<?php 
									 						if($datajumlah[0]->jumlah >= 1 ){
									 						echo $datajumlah[0]->jumlah;
									 						echo  " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-picture\"></span> ";
									 						}
									  						if($datavideo[0]->jumlahvideo >= 1 ){ 
									  						  echo $datavideo[0]->jumlahvideo;
									  						  echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-film\"> </span> ";
									  						}
									  						 if($datainfo[0]->jumlahinfo >= 1){
									  						  echo $datainfo[0]->jumlahinfo;
									  						  echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span>  <span class=\"date\"> <?php echo $tanggal  ?> </span> ";
									  						}
									  						?>
								<div class="readitpos">
									<a href="#">
									<p> <img src="assets/img/ico_read.gif"> Baca Nanti </p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-xs-12 col-lg-3 latenewsbox ">
		<?php include 'sidecategori.php'; ?>
	</div>
</div>
</div>