<div class="container kategori">
	<div class="row contenbottom boxed">
	<div class="col-md-9 col-xs-12 col-lg-9">
				<div class="row">
					<div class="col-md-12 col-xs-12 col-lg-12">
						<div class="tabmenu">
							<h3 class="title-tab"> Search : <?php echo $cari; ?> </h3>
							<div class="col-md-12 col-xs-12 col-lg-12 area">
							<?php
							$dataaray = $kategori->searching($cari);
							$dataaray = json_decode($dataaray);
							if ($dataaray->count !=0) {
							  foreach ($dataaray->result as $key => $value) {
							 	$lead = $value->content;
								$lead	=strip_tags($lead);
								$lead = substr($lead,0,150);
								$tanggal = $value->tanggal;
								$newsid = $value->no;
								$url = $bantuan->baseurl('foto/thumbs/'.$value->fotoname);
								$tanggal = date("M j, g:i a", strtotime($tanggal));
								?>
										<div class="col-md-12 col-xs-12 col-lg-12 artikel items-<?=$key;?> kategori"  data-newsid= '<?php echo $newsid; ?>'>
												<div class="dataimgkategori">
												 	<img class="latenews" src="<?php echo $url; ?>">
												 </div>
												 <div class="judulkategori" > <a href=" <?php echo $bantuan->baseUrl() . "?news_multi=". $value->no; ?> "><h4 class=""><?php echo $value->title; ?></h4></a></div>
											 <div class="tulisankategori"><?php echo $lead; ?>
											 	  <div class="panel panel-default">
								  				<div class="panel-body"><span aria-hidden="true" class="glyphicon glyphicon-picture"></span> <span aria-hidden="true" class="glyphicon glyphicon-film"> </span> <span aria-hidden="true" class="glyphicon glyphicon-book"></span>  &nbsp;<span class="date"> <?php echo $tanggal;  ?> </span>
												 <div class="readitpos">
														<a href="#"><p><img src="assets/img/ico_read.gif"> Baca Nanti </p></a>
												</div>
											</div>
											</div>
											 </div>											
										</div>
										<?php } ?>
					<div class="pagination-custom">
					<nav aria-label="Page navigation">
					  <ul class="pagination">
					  <?php
					  	$c_page = isset($_GET['page']) ? $_GET['page'] : 0;
					  	$per_page = 10; //berapa banyak blok
					  	$total_pages = ceil($dataaray->count/$per_page);
						echo paginate($bantuan->baseurl("?kategori=".$page."&&"),$c_page, $total_pages, 5);
						?>
					  </ul>
					</nav>
				</div>
					<?php 
					}
					else{
						echo "<div style='padding:10px;'> <center>Data not found </center></div>";
					}
					?>
				</div>
				</div>
				</div>
			</div>
			</div>
<div class="col-md-3 col-xs-12 col-lg-3 sidecategoriroot">
			<?php include 'sidecategori.php'; ?>		
	</div>
	</div>
</div>