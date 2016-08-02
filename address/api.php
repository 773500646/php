<?php
	require_once "autoload.php";
	$param=$_POST;
	$phoneVal=isset($_POST['value'])?$_POST['value']:null;
	$info=app\QueryPhone::query($phoneVal);
	$data=array();
	if($info){
		$data=$info;
		$data['code']=200;
	}else{
		$data['msg']='号码不正确';
		$data['code']=400;
	}
	echo json_encode($data);
	
?>