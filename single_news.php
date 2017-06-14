<?php 
	$id_mem=@$_SESSION['userlogin']['id'];
	$tipe = $user->tipemem($id_mem);
	$tipe = @$tipe[0]['tipe_mem'];

	$artikel = $kategori->get_article_by_id($news_id);
	
	$artikel = json_decode($artikel);
	$tes =  @$kategori->getimgsingle($news_id);

	$kode = $artikel[0]->ID_CATEGORY;
	$tanggal = $artikel[0]->DATE;
	$tanggal = $bantuan->indonesian_date($tanggal);
	
?>
<div class="container artikelnews">
	<div class="row contenbottom boxed">
	<div class="col-md-9 col-xs-12 col-lg-9 ">
		<div class="isi_artikel">
			<div class="col-md-12 col-xs-12 col-lg-12 area">
				<div class="tabmenu">
					<div class="artikelspesifik" data-newsid="<?php echo $artikel->ID_NEWS; ?> ">
						<div class="panel panel-default">
							<div class="panel-body">
								<span aria-hidden="true" class="glyphicon glyphicon-picture"></span>&nbsp;<span aria-hidden="true" class="glyphicon glyphicon-film"></span>&nbsp;<span aria-hidden="true" class="glyphicon glyphicon-book"></span> &nbsp;<span class="date"><?php echo $tanggal ?>
								</span>
								<div class="readitpos">
									<a href="">
									<p><img src="assets/img/ico_read.gif"> Baca Nanti </p>
									</a>
								</div>
							</div>
						</div>
						<br>
						<br>
						<div class="judulartikel">
							<h3><?php echo $artikel[0]->TITLE;?>
							</h3>
						</div>
						<div class="tanggal">
								<?php echo $tanggal ;?>
						</div>
						<div class="foto1">
							<img src="<?php echo $tes[0]['fotoname']; ?>">
							<div class="captionartikel">
							</div>
						</div>
						<div class="tulisanartikel">
							<p>
								<?php
								if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1 and $tipe == 2){
									$artikel = $artikel[0]->BODY;
									echo $bantuan->convert_chars_to_entities($artikel);
									
								} 
								elseif(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1 and $tipe == 1) {
								 		$checkcode = $user->checkcustom($id_mem,$kode);
								 		
								 		if($checkcode >= 1 ){
								 			$artikel = $artikel[0]->BODY;
											echo $bantuan->convert_chars_to_entities($artikel);
											
								 		}
								 		else{
								 				echo substr( $artikel[0]->BODY , 0, 200);
												echo "<br><br><div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to subscribe. We offer a broad range of subscription options depending on your needs. Learn more.</div>";		
								 		}

								 } 
								else{
									echo substr( $artikel[0]->BODY , 0, 200);
									echo "<br><br><div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to subscribe. We offer a broad range of subscription options depending on your needs. Learn more.</div>";
								}
								?>
							</p>
						</div>
						<br>
						<br>
						<div class="panel panel-default">
							<div class="panel-body">
								<span aria-hidden="true" class="glyphicon glyphicon-picture"></span>&nbsp;<span aria-hidden="true" class="glyphicon glyphicon-film"></span> &nbsp;<span aria-hidden="true" class="glyphicon glyphicon-book"></span>&nbsp;<span class="date"><?php echo $tanggal  ?>
								</span>
								<div class="readitpos">
									<a href="#">
									<p>
										<img src="assets/img/ico_read.gif"> Baca Nanti
									</p>
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