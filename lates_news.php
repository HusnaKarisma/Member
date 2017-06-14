<?php
$pag = isset($_GET['page']) && $_GET['page'] != 1  ? true : false; 
?>
<div class="container kategori">
	<div class="row contenbottom boxed">
	<div class="col-md-9 col-xs-12 col-lg-9  ">
		<?php if($pag == false){ ?>
				<?php } ?>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-lg-12 area">
						<div class="tabmenu">
							<h3 class="title-tab">Berita Terbaru</h3>
							<div class="col-md-12 col-xs-12 col-lg-12">
							<?php
							$data = $kategori->ambilberitabarukate();
							$data = json_decode($data);
							 foreach ($data->results as $key => $value) {
							 	$lead = $value[$key]->BODY;
								$lead	=strip_tags($lead);
								$lead = substr($lead,0,150);
								$tanggal = $value[$key]->DATE;
								$newsid = $value[$key]->ID_NEWS;
								$tanggal = date("M j, g:i a", strtotime($tanggal));
							 	?>
										<div class="col-md-12 col-xs-12 col-lg-12 artikel items-<?=$key;?> kategori"  data-newsid= '<?php echo $newsid; ?>'>
												<div class="dataimgkategori">
												 	<img class="latenews" src="assets/img/photos/image-14.png">
												 </div>
												 <div class="judulkategori" > <a href=" <?php echo $bantuan->baseUrl() . "?news_id=". $value[$key]->ID_NEWS ?> "><h4 class=""><?php echo $bantuan->upercasefirst($value[$key]->TITLE); ?></h4></a></div>
											 <div class="tulisankategori"><?php echo $lead; ?>
											 	  <div class="panel panel-default">
								  				<div class="panel-body"><span aria-hidden="true" class="glyphicon glyphicon-picture"></span> <span aria-hidden="true" class="glyphicon glyphicon-film"> </span> <span aria-hidden="true" class="glyphicon glyphicon-book"></span>  &nbsp;<span class="date"> <?php echo $tanggal;  ?> </span>
												 <div class="readitpos">
															<a href="#"><p><img src="assets/img/ico_read.gif"> Read it later </p></a>
												</div>
											</div>
											</div>
											 </div>											
										</div>
										<?php } ?>
								</div>
						</div>
					<div class="pagination-custom">
					<nav aria-label="Page navigation">
					  <ul class="pagination">
					  <?php
					  	$c_page = isset($_GET['page']) ? $_GET['page'] : 0;
					  	$per_page = 15; //berapa banyak blok
					  	$total = $data->count;
					  	//print_r($total);
					  	$total_pages = ceil($total/$per_page);
						echo paginate($bantuan->baseurl("?lates_news=latesnews=".$page."&&"),$c_page, $total_pages, 5);
						?>
					  </ul>
					</nav>
				</div>
				</div>
			</div>
	</div>
	<div class="col-md-3 col-xs-12 col-lg-3 sidecategoriroot ">
			<?php include 'sidecategori.php'; ?>		
	</div>
</div>
</div>