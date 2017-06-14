<?php
$language = language();
require_once('lang/'.$language.'.php');
require("lang/languages.php");
	setcookie("language", $language);
	
	if (!isset($_COOKIE['language'])) 
	{
         "$language";
    }

function language()
{    
    //
    $default_language = 'INA';
    //        
    if(!empty($_GET['language']))
    {
        return $_GET['language'];
    }
    elseif(!empty($_COOKIE['language'])){
        return $_COOKIE['language'];	
    }	
    return $default_language; 
}
?>