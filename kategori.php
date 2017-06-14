<?php
$pag = isset($_GET['page']) && $_GET['page'] != 1  ? true : false; 
?>
<div class="container kategori">
	<div class="row contenbottom boxed">
	<div class="col-md-9 col-xs-12 col-lg-9 ">
		<?php if($pag == false){ ?>
				<?php } ?>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-lg-12 ">
						<div class="tabmenu">
							<h3 class="title-tab"><?php 
							$data = $kategori->gekategorinameby($page);
							$data = json_decode($data);
							echo $data[0]->CATEGORY_NAME; 
							?> </h3>
							<div class="col-md-12 col-xs-12 col-lg-12 area ">
							<?php
							$data = $kategori->getnewsbykategoriid($page);
							$data = json_decode($data);
							
							 foreach ($data->result as $key => $value) {
							 	$dataimg = $kategori->getimg($value[$key]->no);
							 	$dataimg = json_decode($dataimg);
							 	
							 	$lead = $value[$key]->content;
								$lead	=$bantuan->filterA($lead);
								$lead = substr($lead,0,300);

								$tanggal = $bantuan->indonesian_date($value[$key]->tanggal);
								$newsid = $value[$key]->no;
								
								$datajumlah = $kategori->getjumlahdata($value[$key]->no);
								$datajumlah = json_decode($datajumlah);

								$datavideo = $kategori->getjumlahvideo($value[$key]->no);
								$datavideo = json_decode($datavideo);

								$datainfo = $kategori->getjumlahinfografis($value[$key]->no);
							 	$datainfo = json_decode($datainfo);
							 	?>
										<div class="col-md-12 col-xs-12 col-lg-12 artikel items-<?=$key;?> kategori"  data-newsid= '<?php echo $newsid; ?>'>
												<div class="dataimgkategori">
												 	<img class="latenews" src=" <?php echo $bantuan->baseurl('foto/thumbs/'.$dataimg[0]->fotoname) ?>">
												 </div>
												 <div class="judulkategori" > <a href=" <?php echo $bantuan->baseUrl() . "?news_multi=". $value[$key]->no; ?> "><h4 class=""><?php echo $bantuan->upercasefirst($value[$key]->title); ?></h4></a></div>
											 <div class="tulisankategori"><?php echo $lead; ?>
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
									  						  echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span>  <span class=\"date\"> <?php echo $tanggal  ?> </span>   ";
									  						}
									  						?>


								  				<span class="date"> <?php echo $tanggal;  ?> </span>
												 <div class="readitpos">
															<a href="#"><p><img src="assets/img/ico_read.gif"> Baca Nanti </p></a>
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
					  	$total=$data->count;
					  	//print_r($total);
					  	$total_pages = ceil($total/$per_page);
						echo paginate($bantuan->baseurl("?kategori=".$page."&&"),$c_page, $total_pages, 5);
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