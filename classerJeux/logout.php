<?php
include('config.php');
$session_id='';
$_SESSION['id']=''; 
if(empty($session_uid) && empty($_SESSION['id'])){
	$url=BASE_URL.'index.php';
	header("Location: $url");
//echo "<script>window.location='$url'</script>";
}
?>