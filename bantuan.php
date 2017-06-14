<?php
class Bantuan{
	public function indonesian_date ($timestamp = '', $date_format = 'l, j M  Y H:i '/*, $suffix = 'WIB'*/) {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} ";
    return $date;
}
function remove_accent($str)
{
  $a = array('Ã‚Â','Â Â Â Â Â Â Â Â', 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â', 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â', 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â','Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â', 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â ' , 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â' ,'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â ' ,'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â'  ,'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â ','Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â'  , 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â', 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â' ,'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â '  ,  'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â'  , 'Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â Ã‚Â ');
    $tes =str_replace($a ,'', $str);

    return $tes;
}
function upercasefirst($input){
	$input = ucwords(strtolower($input));
	return $input;
}
function post_slug($str)
{
  return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
  array('', '-', ''), remove_accent($str)));
} 

function replacedot($string){
$string = preg_replace("/\r\n/", "<br><br>", $string);
return $string;
}

function send_mail($to){
	//$mail = new PHPMailer();
	global $mail;
	    
    $mail->IsHTML(true);
    $mail->From     = "angga.wiguna@antara.co.id"; // email pengirim
    $mail->FromName = "Register Member"; // nama pengirim
    $mail->AddAddress($to); // penerima
    $mail->Subject   =  'Member Antaranews';

    $mail->Body = "tes";
    if(!@$mail->Send())
    {
      echo "Message was not sent<br/ >";
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
      echo "Message has been sent";
    }
}
function baseUrl($link=''){
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

return $root.$link;
}

public function filterA($data){
            $filter = stripslashes(strip_tags($data,ENT_QUOTES));
            $filter = strip_tags($filter);
            return $filter;
        }


function get_ip_address() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}
public static function convert_chars_to_entities( $str ) 
{ 
    $str = str_replace( 'À', '&#192;', $str ); 
    $str = str_replace( 'Á', '&#193;', $str ); 
    $str = str_replace( 'Â', '&#194;', $str ); 
    $str = str_replace( 'Ã', '&#195;', $str ); 
    $str = str_replace( 'Ä', '&#196;', $str ); 
    $str = str_replace( 'Å', '&#197;', $str ); 
    $str = str_replace( 'Æ', '&#198;', $str ); 
    $str = str_replace( 'Ç', '&#199;', $str ); 
    $str = str_replace( 'È', '&#200;', $str ); 
    $str = str_replace( 'É', '&#201;', $str ); 
    $str = str_replace( 'Ê', '&#202;', $str ); 
    $str = str_replace( 'Ë', '&#203;', $str ); 
    $str = str_replace( 'Ì', '&#204;', $str ); 
    $str = str_replace( 'Í', '&#205;', $str ); 
    $str = str_replace( 'Î', '&#206;', $str ); 
    $str = str_replace( 'Ï', '&#207;', $str ); 
    $str = str_replace( 'Ð', '&#208;', $str ); 
    $str = str_replace( 'Ñ', '&#209;', $str ); 
    $str = str_replace( 'Ò', '&#210;', $str ); 
    $str = str_replace( 'Ó', '&#211;', $str ); 
    $str = str_replace( 'Ô', '&#212;', $str ); 
    $str = str_replace( 'Õ', '&#213;', $str ); 
    $str = str_replace( 'Ö', '&#214;', $str ); 
    $str = str_replace( '×', '&#215;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris 
    $str = str_replace( 'Ø', '&#216;', $str ); 
    $str = str_replace( 'Ù', '&#217;', $str ); 
    $str = str_replace( 'Ú', '&#218;', $str ); 
    $str = str_replace( 'Û', '&#219;', $str ); 
    $str = str_replace( 'Ü', '&#220;', $str ); 
    $str = str_replace( 'Ý', '&#221;', $str ); 
    $str = str_replace( 'Þ', '&#222;', $str ); 
    $str = str_replace( 'ß', '&#223;', $str ); 
    $str = str_replace( 'à', '&#224;', $str ); 
    $str = str_replace( 'á', '&#225;', $str ); 
    $str = str_replace( 'â', '&#226;', $str ); 
    $str = str_replace( 'ã', '&#227;', $str ); 
    $str = str_replace( 'ä', '&#228;', $str ); 
    $str = str_replace( 'å', '&#229;', $str ); 
    $str = str_replace( 'æ', '&#230;', $str ); 
    $str = str_replace( 'ç', '&#231;', $str ); 
    $str = str_replace( 'è', '&#232;', $str ); 
    $str = str_replace( 'é', '&#233;', $str ); 
    $str = str_replace( 'ê', '&#234;', $str ); 
    $str = str_replace( 'ë', '&#235;', $str ); 
    $str = str_replace( 'ì', '&#236;', $str ); 
    $str = str_replace( 'í', '&#237;', $str ); 
    $str = str_replace( 'î', '&#238;', $str ); 
    $str = str_replace( 'ï', '&#239;', $str ); 
    $str = str_replace( 'ð', '&#240;', $str ); 
    $str = str_replace( 'ñ', '&#241;', $str ); 
    $str = str_replace( 'ò', '&#242;', $str ); 
    $str = str_replace( 'ó', '&#243;', $str ); 
    $str = str_replace( 'ô', '&#244;', $str ); 
    $str = str_replace( 'õ', '&#245;', $str ); 
    $str = str_replace( 'ö', '&#246;', $str ); 
    $str = str_replace( '÷', '&#247;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris 
    $str = str_replace( 'ø', '&#248;', $str ); 
    $str = str_replace( 'ù', '&#249;', $str ); 
    $str = str_replace( 'ú', '&#250;', $str ); 
    $str = str_replace( 'û', '&#251;', $str ); 
    $str = str_replace( 'ü', '&#252;', $str ); 
    $str = str_replace( 'ý', '&#253;', $str ); 
    $str = str_replace( 'þ', '&#254;', $str ); 
    $str = str_replace( 'ÿ', '&#255;', $str ); 
    
    return $str; 
} 


}
$bantuan = new Bantuan();
?>