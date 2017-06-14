<?php 

class User{ 
public $datas = null;
public $kategori = null;
public function __construct(){
    $this->datas = new Basic();
    $this->kategori = new Berita();
}

function get_info_user($id_mem=""){
	$sql = $this->datas->random("select * from memberbaru where id_mem ='". $id_mem."' " , 'true' );
	return json_encode($sql);
}

function getidmember(){
	$data = $this->datas->random("select max(id_mem) as max from memberbaru" , 'true');
	return $data;
}


function SignUp(){
	$password = md5($_POST['password']);
if(!empty($_POST['username'])){
	$query = $this->datas->random("SELECT * FROM memberbaru WHERE user_name = '".$_POST['username']."' AND password_user = '".$password."' ", 'true');
	if(!$query){
		return $this->registermember();
		echo "<script> alert('Silahkan Login'); </script>";
	}
	else{
		echo "<script> alert('Mohon Maaf User Sudah Terdaftar'); </script>";
		return 0;
		}
	}
}

function registermember(){	
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$company =  $_POST['company'];
	$password =  md5($_POST['password']);
	$phonenumber =$_POST['phonenumber'];
	$address =$_POST['address'];
	$country = $_POST['negara'];
	$status = 0;
	$tipe_mem = isset($_POST['radios-member'])  ? $_POST['radios-member'] : 0;
	
	if($tipe_mem == 0){
		echo '<script> alert("Please choose packge !!");</script>';
		return 0;
	}
	$query ="INSERT INTO memberbaru (user_name, full_name, email, company, password_user, phone_number, addres, tipe_mem, negara, status) VALUES ('".$username."','".$fullname."','".$email."','".$company."','".$password."','".$phonenumber."', '".$address."', '".$tipe_mem."', '".$country."', '".$status."') ";
	$query =$this->datas->random($query);

	if($query){
	$this->pilihan($tipe_mem);
	return 1;
	}	
	return 0;
}

function pilihan($tipe_mem){
	$today = date("Y-m-d H:i:s");
	$kod = date("YmdHi"); 
	$data = $this->getidmember();
	$id_mem = $data[0]['max'];
	
	$_SESSION['register']['id'] = $id_mem ;
	$_SESSION['loggedin_time'] = time(); 

	if($tipe_mem != 2){
		$this->registerpaketuser_custom();
		$datatotal =$this->gettotalamountcustom($id_mem);
		$total = $datatotal[0]['total_amount'];
		$nomor = "Custom-".$id_mem.$kod;
		$this->registerpembayaran($nomor, $id_mem, $tipe_mem, $today,$total);
		}
	else{
		$this->registerpaketuser_full();
		$datatotal = $this->gettotalamountfull();
		$total = $datatotal[0]['total'];
		$nomor = "Full-".$id_mem.$kod;
		$this->registerpembayaran($nomor, $id_mem, $tipe_mem, $today,$total);
		}

		$datapay = $this->getdatapayment($id_mem);
		$bantuan = new Bantuan();
		$datasendemail['_EMAIL'] =  $datapay[0]['email'];
		$datasendemail['_FULL_NAME'] =  $datapay[0]['full_name'];
		$datasendemail['_LINK'] =  $bantuan->baseUrl('?registration=1&&step=2&&id_register='.$id_mem);
		$datasendemail['_NOMOR'] = $nomor;
		$datasendemail['_TIPEPAKET'] = $tipe_mem == 2 ? 'Full Package' : 'Custom Package' ;
		$datasendemail['_TOTAL'] = $total;

		$string = $this->get_template_file();
		$find       = array_keys($datasendemail);
		$replace    = array_values($datasendemail);
		$new_string = str_ireplace($find, $replace, $string);

		$bantuan->send_mail($datapay[0]['email'], $new_string);
		
}



function updatemember($id_mem){
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$company =  $_POST['company'];
	$password =  md5($_POST['password']);
	$phonenumber =$_POST['phonenumber'];
	$address =$_POST['address'];
	$country = $_POST['negara'];
	$status = 0;
	$tipe_mem = isset($_POST['radios-member'])  ? $_POST['radios-member'] : 0;
	
	if($tipe_mem == 0){
		echo '<script> alert("Please choose packge !!");</script>';
		return 0;
	}
	$query =$this->datas->random("update memberbaru set user_name = '$username', full_name= '$fullname', email = '$email', company = '$company', password_user = '$password',phone_number= '$phonenumber', addres=  '$address',tipe_mem = '$tipe_mem', negara = '$country', status = '$status' where id_mem =" .$id_mem, 'true');
	
	if($query){
	//updatepilihan($tipe_mem);
	return 1;
	}	
	return 0;
}


public function registerpaketuser_custom(){
	$Cust_Cat = isset($_POST['p_category']) ? $_POST['p_category'] : array() ;
	//print_r($Cust_Cat);
	if(count($Cust_Cat) >= 1 && is_array($Cust_Cat)){

	$data = $this->getidmember();
	$id_mem = $data[0]['max'];
	foreach ($Cust_Cat as $key => $value) {
		$text =  isset($value['text']) && $value['text'] == 1 ? 1 : 0 ;
		$foto =  isset($value['foto']) && $value['foto'] == 1 ? 1 : 0 ;
		$video =  isset($value['video']) && $value['video'] == 1 ? 1 : 0 ;
		$infografis =  isset($value['infografis']) && $value['infografis'] == 1 ? 1 : 0 ;
		$query =$this->datas->random("INSERT INTO paket_user(id_mem, id_category, text, foto, video, infografis) VALUES ('$id_mem','$key','$text','$foto','$video','$infografis')");
		}
	}
}

function registerpaketuser_full(){
	//$Cust_Cat = isset($_POST['p_category']) ? $_POST['p_category'] : array() ;
	$data_kat = $this->kategori->kategori();
	$data_kat = json_decode($data_kat);
	print_r($data_kat);
	if(count($data_kat) >= 1 && is_array($data_kat)){
	$data = $this->getidmember();
	$id_mem = $data[0]['max'];
	foreach ($data_kat as $key => $value) {
		$id_category = $value->ID_CATEGORY;
		$text =  1 ;
		$foto =  1;
		$video =  1;
		$infografis = 1;
		$query =$this->datas->random("INSERT INTO paket_user(id_mem, id_category, text, foto, video, infografis) VALUES ('$id_mem','$id_category','$text','$foto','$video','$infografis')");
		}
	}
}



//================================ Fungsi Untuk Menyimpan data pembayaran =========================//
function registerpembayaran($nomor,$id_mem,$tipe_mem,$today,$total){

	$query =$this->datas->random("INSERT INTO memberpembayaran(no_trans, id_mem, tipe_mem, trans_date, payment_date, total_amount) VALUES ('$nomor','$id_mem','$tipe_mem', now(), 'Unpay' ,'$total')");
}

function gettotalamountcustom($id_mem=""){
			$total = $this->datas->random("SELECT SUM(a.packge_price) AS total_amount FROM masterkatagori a,paket_user b WHERE a.ID_CATEGORY = b.id_category and b.id_mem = " .$id_mem , 'true');
			return $total;
}
function gettotalamountfull(){
			$total = $this->datas->random("SELECT SUM(packge_price) AS total FROM masterkatagori WHERE ID_CATEGORY IN
			(SELECT DISTINCT b.ID_CATEGORY FROM news_09_2016 a INNER JOIN masterkatagori b ON a.ID_CATEGORY=b.ID_CATEGORY WHERE b.STATUS_ACTIVE = 1 ORDER BY ID_CATEGORY)", 'true');
			return $total;	
}

function getdatapayment($id_mem){
	$data = $this->datas->random("SELECT * FROM memberbaru a , memberpembayaran b WHERE a.id_mem = b.id_mem  and a.id_mem ='". $id_mem."'" , 'true');
	return @$data;
}

function tipemem($id_mem){
	$tipemem = $this->datas->random("SELECT tipe_mem FROM memberbaru WHERE id_mem ='".$id_mem."' ", 'true' );
	return @$tipemem;
}

function checkcustom($id_mem, $id_cate){
	$usercustom = $this->datas->random("SELECT * FROM memberbaru a, paket_user b WHERE a.id_mem = b.id_mem AND b.id_category = '".$id_cate."' and  a.id_mem =" .$id_mem ." " , 'true' );
	if(count($usercustom) >= 1 && is_array($usercustom)){
		return $usercustom;
	}
	else{
		return 0;
	}
}

public function get_data_paket($id_mem){
	$data= $this->data->random("select * from member");
}

function get_template_file(){
ob_start();
echo file_get_contents('./tes.php');
$html = ob_get_contents();
ob_clean();
return $html;
}

}

 $user = new User();
 
 if(isset($_POST['submit'])){
	if($_POST['submit'] == 'registrasi'){ 
	$sigup = $user->SignUp();
	if($sigup == 1){
		echo "<script> alert('Your Registration is Completed ...'); </script>";
		//header('location:'.$bantuan->baseUrl('?registration=1&&step=2'));
	}
	}
	elseif ($_POST['submit'] == 'payment') {
	header('location:'.baseUrl('?registration=1&&step=3'));
	}

	elseif ($_POST['submit'] == 'update'){
		$id_mem = $_POST['id_mem'];
		updatemember($id_mem);
		echo "<script> alert('Update Registration is Completed ...'); </script>";
		header('location:'.baseUrl('?registration=1&&step=2'));
	}

}
 ?>