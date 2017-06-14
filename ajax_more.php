<?php
require("lang.php");
include 'lib/Setting.php';
include 'bantuan.php';
include 'lib/inc.koneksidb.php';
include_once '/lib/Mobile_Detect.php';

if(isset($_POST["ID"]) && !empty($_POST["ID"])){

$data_array = $query->random("SELECT * FROM pon_09_2016 a, masterkatagori b, detail_09_2016 c where a.cate = b.ID_CATEGORY and a.no = c.no and newsid like 'd%' and a.no < ".$_POST['ID']." and b.LANGUAGE = '".language()."' group by a.no ORDER BY a.no DESC ", 'true');

$allRows = count($data_array);
$showLimit = 10;
//get rows query
$data = $query->random("SELECT a.cate, a.title, a.tanggal, a.content, a.no, c.fotoname FROM pon_09_2016 a, masterkatagori b, detail_09_2016 c where a.cate = b.ID_CATEGORY and a.no = c.no and newsid like 'd%' and b.LANGUAGE = '".language()."' and  a.no < ".$_POST['ID']." group by a.no ORDER BY tanggal DESC limit 10 ", 'true');

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
                                                    
        $tutorial_id = $val["no"]; 
        if($mobile->isMobile() == 1){ 
            ?>
            <div class='media' data-iteration='<?php echo $val['no'] ?>' data-newsid='<?php echo $val['no'] ?>'>
                            <div class='media-left pull-left'><a href='#'><img alt='64x64' class='media-object' style="width: 135px; height: 87px; overflow-y: hidden;" src="<?php echo "../../foto/preview/".$val['fotoname'] ?>" data-holder-rendered='true'></a> </div>
                                          
                                         <div class='media-body'>
                                         <!-- assets/img/photos/image-14.png -->
                                         <a href="?news_multi=<?php echo $val['no']?>">
                                         <a class="btn red" id="media"><?php echo $bantuan->indonesian_date($val['tanggal']); ?></a> <br>
                                         <p class='w-list-news'><?php echo $val['title'] ?>
                                          <?php 

                                 if($datajumlah[0]->jumlah >= 1 ){ 
                                  echo "<a class=\"btn red\" style=\"margin-right:-3px\"; id=\"media\">".$datajumlah[0]->jumlah; 
                                 echo " <i class=\"fa fa-file-photo-o\" aria-hidden=\"true\"></i></a>"; } 

                                    if($datavideo[0]->jumlahvideo >= 1 ){ 
                                    echo "<a class=\"btn red\" id=\"media\"> ".$datavideo[0]->jumlahvideo; 
                                    echo " <i class=\"fa fa-file-movie-o\" aria-hidden=\"true\"></i></a>"; }
                                    
                                    if($datainfo[0]->jumlahinfo >= 1){ 
                                        echo "<a class=\"btn red\" id=\"media\"> ".$datainfo[0]->jumlahinfo;
                                        echo "<i class=\"fa fa-newspaper-o\" aria-hidden=\"true\"></i>"; } ?>
                                         </p></a>
                                          
                                        </div>
                          </div>
            <?php
        }
        else{
        ?>

        <div class='media' data-iteration='<?php echo $val['no'] ?>' data-newsid='<?php echo $val['no'] ?>'>
                                                    <div class='media-left'><a href='#'><img alt='64x64' class='media-object' style="width: 105px; height: 79px;" src="<?php echo $bantuan->baseurl()."foto/preview/".$val['fotoname'] ?>" data-holder-rendered='true'></a> </div>
                        
                                                         <div class='media-body'>
                                                         
                                                         <a href="?news_multi=<?php echo $val['no']?>">
                                                         <span class='date'>
                                                         <?php
                                                          echo $bantuan->indonesian_date($val['tanggal']) ?>
                                                         </span> 
                                                         <br>
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
                                                                                echo " x <span aria-hidden=\"true\" class=\"glyphicon glyphicon-book\"></span><span class=\"date\"><?php echo   ?>
                                                                        </span> "; } ?>
                                                                  
                                                                  
                                                                  <div class='readitpos'><a href='#'><p> <img src='assets/img/ico_read.gif'> Baca Nanti</p></a>
                                                                  </div>
                                                            </div>
                                                        </div>

                                                        </div>
<?php } 
    }
?>
<?php if($allRows > $showLimit){ ?>
    <div class="show_more_main" id="show_more_main<?php echo $tutorial_id; ?>">
        <button id="<?php echo $tutorial_id; ?>" title="Load more posts" class="btn <?php if($mobile->isMobile() == 1){ echo 'red'; } else { echo 'btn-primarys'; } ?>  show_more" type="button"> Show More </button>
        <script>
        var tampungberita = [];

                $('.latenewsbox').find('.artikeltop').find('.tutorial_list').each(function(){
        
    $(this).find('.readitpos>a p').click(function(e){
        e.preventDefault();
        var $rootcontent = $(this).closest('.media');
        var id = $rootcontent.data('newsid');
                var title = $rootcontent.find('p.media-heading').text();
                //console.log(title);
                var dates = $rootcontent.find('span.date').text();
                var link = $rootcontent.find('.media-body a').attr('href');
                var date = dates.substring(0, 13); 

                    var id = $rootcontent.data('newsid');
                    var existing_id = false;

                    var single_data_news = {"id":id,"title":title, "date" :date, "link" :link };
            
                        $.each(tampungberita,function(){
                            //console.log(this.id);
                    if(this.id == id){
                        existing_id = true;
                        }
                            //console.log(existing_id);
                        });
                    
                    if(existing_id == false){
                        swal("Done!", "Berita berhasil ditambahkan dalam daftar baca.", "success");
                    tampungberita.push(single_data_news);
                    }
                    else{
                        swal("Error!", "Berita sudah ada!", "error");
                    }
                
                AddToList();

                saveToStorage('news',JSON.stringify(tampungberita));
                //console.log(tampungberita);
    })

});

                function AddToList(){
        var $html = 'No Data';
            if(tampungberita.length >= 1){
                $html = '<div id="rilNewsList"> <ul class="hasChild hasE">';
                    $.each(tampungberita,function(){
                        $html += '<li><input type="checkbox" name="" value="' + this.id + '" class="checkbox"><a href="' + this.link +'">' + this.title +  '</a><span class="date">'+ this.date + '</span></li><br>';
                        $html += ''
                    });
            $html += '</ul> </div>'
            }
        $(document).find('#myModal').find('.modal-body').html($html);
        $(document).find('#count02').text(("0" + tampungberita.length).slice(-2));
}
    if(typeof getNewsFromStorage('news') == 'object' && getNewsFromStorage('news') != null){
        //console.log(getNewsFromStorage('news') );
        tampungberita = getNewsFromStorage('news');
    }

    AddToList();

    function saveToStorage(key,value){
        if(typeof value == 'object'){
            try{
                value = JSON.stringify(value);
            }catch(e){
                throw('Not String');
            }
        }
        localStorage.setItem(key,value);
    }

    function getNewsFromStorage(key){
        var $data = localStorage.getItem(key);
        if(typeof $data != 'object'){
            $data = JSON.parse($data);
        }
        return $data;
    }
    function delete_list($id){
        var tampung_new_data = []; 
        if(typeof tampungberita == 'object'){
            $.each(tampungberita,function(){
                if(this.id != undefined && this.id != $id ){
                    tampung_new_data.push(this);
                }
            });
            tampungberita = tampung_new_data;
            AddToList();
            saveToStorage('news',JSON.stringify(tampungberita));

        }
    }


function selectlist($rootObject){
    $($rootObject).parent().find('.modal-content').find('.modal-footer').find('.firstChild>a').off('click').click(function(e){
        e.preventDefault();
        $(this).closest('.modal-content').find('#rilNewsList>ul').find('li').each(function(){
            $(this).find('input[type=checkbox]').prop("checked", true);
        });
    });
}

function unselectlist($rootObject){
    $($rootObject).parent().find('.modal-content').find('.modal-footer').find('.secondChild>a').off('click').click(function(e){
        e.preventDefault();
        $(this).closest('.modal-content').find('#rilNewsList>ul').find('li').each(function(){
            $(this).find('input[type=checkbox]').removeAttr('checked');
        });
    });
}

        </script>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading….</span></span>
    </div>
<?php } ?>  
<?php 
    } 
}
?>
