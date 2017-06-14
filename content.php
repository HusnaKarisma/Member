<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'ajax_more.php',
            data:'ID='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.tutorial_list').append(html);
            }
        }); 
    });

    $.get('?json=1&&get_crousel',function(data){
        jmlData = data.length;
        //variabel untuk menampung tabel yang akan digenerasikan
        buatTabel = "";
        //perulangan untuk menayangkan data dalam tabel
        for(a = 0; a < jmlData; a++){
		 $varactive="";
		 $title= data[a]['title'];
		 $cap = data[a]['caption'];
		 $cap = $cap.substring(0, 200);
            if (a == 0){ $varactive ="active"; 
        	} ;
            buatTabel += "<div class='item primary "+ $varactive+ "'>"
            				 + "<a href='?news_multi= "+ data[a]["no"] +"'><img style='width=100%;' src='foto/preview/" +data[a]['fotoname']+ "' alt='Antara Member 1'>"

							 + "<div class='carousel-caption'><h4>"+ $title+"</h4> <div style='display:none;' class='capstyle'> "+$cap+" .... "
            		+"</div></div></a></div>";
        }
        $(document).find("#jsoncrou")[0].innerHTML += buatTabel;
        $(document).find('#jsoncrou').hover(function(){
		$('.capstyle').slideToggle('medium');
		});
	});

	$.get('?json=1&&get_latest_title',function(data){
        jmlData = data.length;
        
        buatTabel = "";
        for(a = 0; a < jmlData; a++){
            //mencetak baris baru
            buatTabel += "<li><a href=' ?news_multi=" + data[a]["no"]+ "'>"
                        + data[a]["title"]
                +"</a></li>";
        }
        $(document).find(".breaking-block ul.jalan")[0].innerHTML += buatTabel;
	});



	$( ".btn-group.kanan.index" ).hover(
  		function() {
    $( this ).append( $( "<span style='font-size:10px; color:#D93434; margin-top:10px;'> index</span>" ) );
  	}, function() {
    $( this ).find( "span:last" ).remove();
	  }
	);
 
		$( ".btn-group.kanan.index.fade" ).hover(function() {
		  $( this ).fadeOut( 100 );
		  $( this ).fadeIn( 500 );
		});

});
</script>
<div class="container boxed">
	<div class="" id="contentatass">
		<div class="row" id="contentatas">
			<div class="breaking-news isscrolling" rel="0">
					<div class="breaking-title">
						<span class="breaking-icon">&nbsp;</span><b>Berita Terbaru</b>
						<div class="the-corner">
						</div>
					</div>
					<div class="breaking-block">
						<ul class="jalan" style="left: -710px;">
						
						</ul>
					</div>
					<div class="breaking-controls">
						<a href="#" class="breaking-arrow-left">&nbsp;</a><a href="#" class="breaking-arrow-right">&nbsp;</a>
						<div class="clear-float">
						</div>
						<div class="the-corner">
						</div>
					</div>
				</div>
			<div class="col-md-7 col-xs-7 col-lg-7">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div id="jsoncrou"  class="carousel-inner" role="listbox">
							
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="col-md-5 col-xs-5 col-lg-5 tabkategori">
				<div class="col-md-12 col-xs-12 col-lg-12 populer">
					<div class="tabmenu ">
						<h3 class="title-tab">Berita Terpopuler
						
						<div class="btn-group kanan index">
						
							<a href="<?php echo $bantuan->baseurl();?>?multi=Multicontent">
							 <button type="button" class="btn btn-default kategori"> <span class="caret"></span></button></a>
						</div>
						</h3>
					</div>
					<ul class="category-list">
					<?php
					$data = $kategori->popular_news_entry();
					foreach ($data as $key => $val) {
					?>
						<li class="populer"><a href="<?php echo $bantuan->baseurl().'?news_multi='. $val['no'] ?>"><div class='num_fokus'><?php echo $key+1; ?></div><div class='title_nlf'> <h4><b>
						<?php echo $val['title'].' | <span style="color:#6f6f6f">'. $val['view'].' view </span>'; ?>
						</b> </h4></div></a></li>
					
					<?php
				}
				?>
				</ul>
				</div>
			</div>

			</div>
		</div>
<div class="contenbottom boxed">
	<div class="row contenbottom atas">
		<div class="col-md-12 col-xs-12 col-lg-12">
			<div class="isi">
			<div class="col-md-4 col-xs-4 col-lg-4 tabkategori beritabaru">
				<div class="col-md-12 col-xs-12 col-lg-12 subkategori beritabaru">
					<div class="tabmenu ">
						<h3 class="title-tab">Berita Terbaru
						
						<div class="btn-group kanan index">
						
							<a href="<?php echo $bantuan->baseurl();?>?multi=Multicontent"><button type="button" class="btn btn-default kategori"> <span class="caret"></span></button></a>
						</div>
						</h3>
						<div class="listnews">
								<div class="col-md-12 col-xs-12 col-lg-12 latenewsbox ">
									<div class='col-md-12 col-xs-12 col-lg-12 artikeltop'>
										<div class="tutorial_list">
											    <?php
											    $data = $kategori->ambildataberitabaru(language());
											    $rowCount = count($data);
											    
											    if($rowCount > 0){ 
											        foreach($data as $key => $val ){ 
													$dataimg = $kategori->getimg($val['no']);
													$dataimg = json_decode($dataimg);
													$datajumlah = $kategori->getjumlahdata($val['no']);
													$datajumlah = json_decode($datajumlah);
													$datavideo = $kategori->getjumlahvideo($val['no']);
													$datavideo = json_decode($datavideo);
													$datainfo = $kategori->getjumlahinfografis($val['no']);
													$datainfo = json_decode($datainfo);

											        $tutorial_id = $val['no'];
											    ?>
											    	<div class='media' data-iteration='<?php echo $val['no'] ?>' data-newsid='<?php echo $val['no'] ?>'>
											    	<div class='media-left'><a href='#'><img alt='64x64' class='media-object' style="width: 105px; height: 79px;" src="<?php echo $bantuan->baseurl()."foto/preview/".$val['fotoname'] ?>" data-holder-rendered='true'></a> </div>
                        									
                        								 <div class='media-body'>
                        								 <!-- assets/img/photos/image-14.png -->
                        								 <a href="?news_multi=<?php echo $val['no']?>">
                        								 <span class='date'><?php echo $bantuan->indonesian_date($val['tanggal']); ?></span> <br>
                        								 <p class='media-heading'><b><?php echo $val['title'] ?></b></p></a>
                         								</div>

                         								<div class='panel panel-default'>
                         									<div class='panel-body'> 
								 								<?php 

																 if($datajumlah[0]->jumlah >= 1 ){ echo $datajumlah[0]->jumlah; 
																 echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-picture\"></span> "; } 

																 		if($datavideo[0]->jumlahvideo >= 1 ){ 
																 		echo $datavideo[0]->jumlahvideo; 
																 		echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-film\"></span> "; }
																 			 if($datainfo[0]->jumlahinfo >= 1){ 
																 			 	echo $datainfo[0]->jumlahinfo;
																 			 	echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span><span class=\"date\"><?php echo $tanggal  ?>
																		</span> "; } ?>
								 								  <div class='readitpos'><a href='#'><p> <img src='assets/img/ico_read.gif'> Baca Nanti</p></a>
								 								  </div>
						 									</div>
						 								</div>
						 							</div>
																				    <?php } ?>
																				   <div class="show_more_main" id="show_more_main<?php echo $tutorial_id; ?>">
									        <button id="<?php echo $tutorial_id; ?>" title="Load more posts" class="btn btn-primarys show_more" type="button"> Show More </button>

									        <span class="loding" style="display: none;"><span class="loding_txt">Loading ...</span></span>
									    </div>
																				    <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-8 col-xs-8 col-lg-8 tabkategori">
			<div class="row">
				<!--<div class="col-md-12 col-xs-12 col-lg-12 tabkategori">
					<div class="col-md-12 col-xs-12 col-lg-12 subkategori">
						<div class="tabmenu ">
							<h3 class="title-tab">Foto
							
							<div class="btn-group kanan index">
							<span class="indexs" stsyanle="display:none;">index</p>
								<a href="<?php echo $bantuan->baseurl();?>?multi=Multicontent"><button type="button" class="btn btn-default kategori"> <span class="caret"></span></button></a>
							</div>
							</h3>
							<div class="listnews">
								<div class="col-md-3 col-xs-3 col-lg-3 latenewsbox">
									
									</div>
								</div>
							</div>
						</div>
					</div>-->
							<div class="col-md-12 col-xs-12 col-lg-12 tabkategori video">
								<div class="col-md-12 col-xs-12 col-lg-12 subkategori video">
									<div class="tabmenu ">
										<h3 class="title-tab">Video 
										
										<div class="btn-group kanan index">
										
											<a href="<?php echo $bantuan->baseurl();?>?multi=Multicontent"><button type="button" class="btn btn-default kategori"> <span class="caret"></span></button></a>
										</div>
										</h3>
									</div>
										<div class="listnews">
											<div class="col-md-12 col-xs-12 col-lg-12 latenewsbox">
												<?php
												$data = $kategori->getlistvideo();
												foreach ($data as $key => $val) {
												$url = $bantuan->baseurl().'?news_multi='.$val['no'];
												?>
											<div class="col-md-4 col-xs-4 col-lg-4 artikel video" data-newsid="<?php echo $val['no'] ?>" data-iteration="<?php echo $val['no'] ?>">
												<div class="multifoto">
															<img src="<?php echo $bantuan->baseurl()."foto/preview/".$val['fotoname'] ?>" style="width: 100%;">
															<div class="icon_play"></div>
														</div>

												<span class="date"><?php echo $bantuan->indonesian_date($val['tanggal']);  ?> </span>
												<a href='<?php echo $url ?>'>
												<div class="judul" style="text-align:justify">
														<?php echo $bantuan->upercasefirst($val['title']) ?>
												</div>
												</a>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
</div>
			<div class="ads">
				<div style="margin:0 auto;" >
				<center><img style="max-width:80%;" src="http://newopenx.detik.com/images/94cb17324ec2864f7371c73ca6ce3d69.jpg"></center>
				</div>
				<br><br>
			</div>
<div class="row contenbottom boxed bawah no-gutter">
				<div class="col-md-12 col-xs-12 col-lg-12">
					<div class="isi">
				<?php 
					$data = $kategori->kategoriberitaid();
					$data = json_decode($data);

					foreach ($data as $key => $val) { 
					$id_cate =$val->ID_CATEGORY; 
					$link ='?kategori='.$val->ID_CATEGORY; ?>
						<div class="col-md-3 col-xs-3 col-lg-3 tabkategori">
							<div class ="col-md-12 col-xs-12 col-lg-12 subkategori" >
							<div class="tabmenu">
								<h3 class="title-tab"><?php echo  $val->CATEGORY_NAME ?>
								
								<div class="btn-group kanan index">
								
									<a href="<?php echo $link ?> "> <button type="button" class="btn btn-default kategori">
									 <span class="caret"></span>
									</button></a>
								</div>
								</h3>
							</div>
				<?php
					 $datas = $kategori->kategoriisi($id_cate);
					 $datas = json_decode($datas);
					 $i= 0;
					 foreach ($datas as $key => $value) {

					$dataimg = $kategori->getimg($value->no);
					$dataimg = json_decode($dataimg);
					
					$datajumlah = $kategori->getjumlahdata($value->no);
					$datajumlah = json_decode($datajumlah);
					$datavideo = $kategori->getjumlahvideo($value->no);
					$datavideo = json_decode($datavideo);
					$datainfo = $kategori->getjumlahinfografis($value->no);
					$datainfo = json_decode($datainfo);

					  $lead = $value->content;
					  $lead =strip_tags($lead); 
					  $lead = substr($lead,0,150); 
					  
					  $url = $bantuan->baseUrl() . "?news_multi=". $value->no; 
					  		if($i < 1){ ?>
					  			
					  	<div class="col-md-12 col-xs-12 col-lg-12 artikel test" data-newsid="<?php echo $value->no ?>" data-iteration="<?php echo $value->no ?>
								">
								<div class="multifoto">
											<img src="<?php echo $bantuan->baseurl()."foto/preview/".$dataimg[0]->fotoname ?>" style="width: 100%; height:110%;">
										</div>
								
								<span class="date"><?php echo $bantuan->indonesian_date($value->tanggal);  ?></span>
								<a href="<?php echo $url ?>">
								<div class="judul" style="text-align:justify">
										<?php echo $bantuan->upercasefirst($value->title) ?>
									</h3>
								</div>
								</a>
								
								<div class="panel panel-default">
												<div class="panel-body">
										<div class="multireadit">
											<?php 

									 if($datajumlah[0]->jumlah >= 1 ){ echo $datajumlah[0]->jumlah; 
									 echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-picture\"></span> "; } 

									 		if($datavideo[0]->jumlahvideo >= 1 ){ 
									 		echo $datavideo[0]->jumlahvideo; 
									 		echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-film\"></span> "; }
									 			 if($datainfo[0]->jumlahinfo >= 1){ 
									 			 	echo $datainfo[0]->jumlahinfo;
									 			 	echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span><span class=\"date\"><?php echo $tanggal  ?>
											</span> "; } ?>
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
					  		<?php }
					  		else {
					  ?>
					 
					<div class="col-md-12 col-xs-12 col-lg-12 artikel test" data-newsid="<?php echo $value->no ?>" data-iteration="<?php echo $value->no ?>">
								
								<span class="date"><?php echo $bantuan->indonesian_date($value->tanggal);  ?></span>
								 <a href="<?php echo $url ?>">
								<div class="judul" style="text-align:justify">
										<?php echo $bantuan->upercasefirst($value->title) ?>
									</h3>
								</div>
								</a><div class="panel panel-default">
									<div class="multireadit">
											<?php 

									 if($datajumlah[0]->jumlah >= 1 ){ echo $datajumlah[0]->jumlah; 
									 echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-picture\"></span> "; } 

									 		if($datavideo[0]->jumlahvideo >= 1 ){ 
									 		echo $datavideo[0]->jumlahvideo; 
									 		echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-film\"></span> "; }
									 			 if($datainfo[0]->jumlahinfo >= 1){ 
									 			 	echo $datainfo[0]->jumlahinfo;
									 			 	echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span><span class=\"date\"><?php echo $tanggal  ?>
											</span> "; } ?>
											<div class="readitpos">
											<a href="#">
											<p> <img src="assets/img/ico_read.gif"> Baca Nanti </p>
											</a>
										</div>
										</div>
							</div>
								
							</div>
							<?php } 

							$i++; } ?>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="jarak20"></div>
					<div class="jarak20"></div>
				</div>
				<!--<div class="col-md-3 col-xs-12 col-lg-3 sidecategoriroot">
					<?php include 'sidecategori.php';?>
				</div>-->
			</div>
			<div class="ads">
				<div style="margin:0 auto;" >
				<center><img style="max-width:80%;" src="http://ads.antaranews.com/www/img/d389c283e079532516b922efcf084b93.jpg"></center>
				</div>
				<br><br>
			</div>
		</div>
