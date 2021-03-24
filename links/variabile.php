<?php
@$mesaj = "";
@$text="";
@$validare=1;
@$validareURLcautare=1;
@$validareURL=1;
@$action=$_GET['action'];
@$arrExpData = array();
@$expArr = array();
@$exportArr = array();
@$headerArr = array();
@$index = 0;	
if($action=='statistici' || $action=='cautare'){
	$latime=9;
}	else $latime=3;
?>