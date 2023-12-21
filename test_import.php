<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 include_once('includes/class.Db_client.php');
$obj	=	new Db_client();
$cms_brkstories	=	$obj->getDataByIdImport("fkmaw_content",10) ;
//10 - breaking stories 
//16 -latest science 
//17 -latest presentations 
//echo "<pre/>";print_r($cms_brkstories);
foreach($cms_brkstories as $k=> $val){
	$title	=	$val['title'];
	$content	=	$val['introtext'];
	$menu_id	=14;

	//14 menu id from our table for breaking stories 
	//15 menu id latest science 
	//16 menu id for latest presentations
	$created	= $val['created'];
	$modified = $val['modified'];
	 $params =	['title' =>	$title,'content' => $content,'url'=>'','external_url'=>'','order'=>'','menu_id' => $menu_id,'menu__-'=> '','isSystem'=>'','isDeleted'=>'','created_at' =>$created,'updated_at'=>$modified,'__v'=>''];
	// print_r($params);exit;
      //  $result =   $obj->insertInto("cms", $params) ;
	   $result =   $obj->insertDataImport($params);
		 var_dump($result);
}

?>