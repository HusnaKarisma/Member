<script type="text/javascript">
	$(document).ready(function(){
	$.get('?json=1&&get_kategori',function(data){
        //menghitung jumlah data
        jmlData = data.length;
        //variabel untuk menampung tabel yang akan digenerasikan
        buatTabel = "";
        
        //perulangan untuk menayangkan data dalam tabel
        for(a = 0; a < jmlData; a++){
            //mencetak baris baru
            buatTabel += "<li><a href=' ?kategori=" + data[a]["ID_CATEGORY"]+ "'>"
            
                        + "<div class='num_fokus'>" + (a+1) + "</div>"
                        //mencetak nama instansi
                        + "<div class='title_nlf'> <h4><b>" + data[a]["CATEGORY_NAME"] + "</b></h4></div>"
                        //mencetak jumlah laporan "belum"
            //tutup baris baru
                + "</a></li>";
        }
        //mencetak tabel
  
        $(document).find("ul.category-list")[0].innerHTML += buatTabel;

	});
});
</script>
				<div class="side_isi">
					<div class="col-md-12 col-xs-12 col-lg-12 sidekategori">
						<div class="tabmenu">
							<h3 class="title-tab">List Category</h3>
							<div class="list-box kategori">
									<ul class='category-list'>
									</ul>

									<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="side_isi">
					<div class="col-md-12 col-xs-12 col-lg-12 sidekategori">
						<div class="tabmenu">
							<h3 class="title-tab">Antara Foto</h3>
							<div class="list-box">
							<?php 
							$i=0;
								 if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1){
								 	?>
							<div id="carousel-example-generic" class="carousel slide sidefoto" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
									<?php 
								$data = $kategori->getimg();
								$data = json_decode($data);
								foreach ($data as $key => $val) {
									$var = $bantuan->baseUrl() . "?news_multi=". $val->no;
									$es = $val->fotoname;
									//echo $es;
								$varactive="";
								if ($key == 0){
								$varactive ="active";
								}
								?>
								<div class="item customslide <?php echo $varactive; ?>"  style="width:100%;">
									<a href="<?php echo $var ?>"><center><img src="<?php echo $bantuan->baseUrl() ."foto/thumbs/" . $es ?>"></center></a>
								</div>
								<?php }?>
												</div>
											</div>
									<?php } 
										else {
											echo "<div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to <a href='?registration=1'>Registration</a>. We offer a broad range of subscription options depending on your needs. Learn more.</div>"; 
										}
									?>
									<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="side_isi">
					<div class="col-md-12 col-xs-12 col-lg-12 sidekategori">
						<div class="tabmenu">
							<h3 class="title-tab">Antara TV</h3>
							<div class="list-box">
							<?php 
							$i=0;
								 if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1){
								 	?>
							<div>
								<?php 
								$data =$kategori->getvideo();
								$data = json_decode($data);
								foreach ($data as $key => $val) {
								$var = $bantuan->baseUrl() . "?news_multi=". $val[$key]->no;
								?>
								<video style="width:100%;" controls src="<?php echo "video/". $val[$key]->video; ?>"></video>
								<a href="<?php echo $var ?>"><div class="judul"><h4><?php echo $val[$key]->judul; ?></h4></div></a>
							
								<?php }?>
							</div>
							<?php } 
								else {
											echo "<div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to <a href='?registration=1'>Registration</a>. We offer a broad range of subscription options depending on your needs. Learn more.</div>";
										}
							?>
						</div>
					</div>
				</div>
				</div>
				<div class="side_isi">
					<div class="col-md-12 col-xs-12 col-lg-12 sidekategori">
							<div class="tabmenu">
							<h3 class="title-tab">Latest Infografis </h3>
							<div class="list-box infografis" style="width:100%;">
							<?php 
							$i=0;
								 if(isset($_SESSION['userlogin']) and count($_SESSION['userlogin']) >= 1){
								 	?>
							<div class="infografis">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
								<?php $data = $kategori->getinfo();
								
								$data = json_decode($data); 
								//print_r($data);
								foreach ($data as $key => $val) {
								$var = $bantuan->baseUrl() . "?news_multi=". $val[$key]->no;
								$varactive="";
								if ($key == 0){
								$varactive ="active";
								}
								?>
								<div class="item info  <?php echo $varactive; ?>"  style="width:100%;">
									<a href="<?php echo $var ?>"><img style="width:100%;" src="<?php echo $bantuan->baseUrl() ."infografis/".$val[$key]->infografis; ?>"></a>
								</div>
								<?php }?>
							</div>
							<?php } 
								else {
											echo "<div class='innerbox'>To have fuller access to the Member Antaranews website, it is necessary to <a href='?registration=1'>Registration</a>. We offer a broad range of subscription options depending on your needs. Learn more.</div>";
										}
							?>
					</div>
			</div>
							<div class="clear"></div>
							</div>
						</div>	
						</div>
				</div>

