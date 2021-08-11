<?php
session_start();
session_name('imagem');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	require_once('classes/upload.class.php');
	
	
	if($_FILES['imagem']){	
		$handle = new upload($_FILES['imagem']);
		$handle->image_convert         = 'jpg';
		$handle->image_resize         = true;
		$handle->image_ratio_y        = true;
		$handle->image_x              = ($_FILES['imagem']['size']>1024)?1024:$_FILES['imagem']['size'];
		$arquivo = $handle->Process();
		
		 if ($handle->processed) {
			$handle->image_resize         = true;
			$handle->image_ratio_y        = true;
			$handle->image_x = 100;
			$thumb = $handle->Process();
			$nome = $handle->file_dst_name;

       } else {
           echo 'error : ' . $handle->error;
       }
		
		$id = $_POST['id'];
		
		$_SESSION['img'][$id] = new stdClass;	
		$_SESSION['img'][$id]->img =  $arquivo;
		$_SESSION['img'][$id]->nome = $handle->file_src_name;
		$_SESSION['img'][$id]->mime = $handle->file_src_mime;
		$_SESSION['img'][$id]->thumb = $thumb;
		$_SESSION['img'][$id]->src = 'data:'.$handle->file_src_mime.';base64,' . base64_encode($arquivo);

		
		//@header('Content-type:'.$handle->file_src_mime);

		//header("location: index.php");
	}
	/*	$handle->image_resize          = true;
		$handle->image_ratio_y         = true;
		$handle->image_x               = 400;
		$handle->image_precrop         = array();
	*/	
	
	
}
/*if(isset($_POST['imgNome'])){
	if(isset($_SESSION['img'])){

		$targ_w = $_POST['w'];
		$targ_h = $_POST['h'];
		$jpeg_quality = 90;
		
		$base64   = base64_encode($_SESSION['img']->redimencionado); 

		$src = "data:image/jpeg;base64,". $base64;
		$img_r = imagecreatefromjpeg($src);
		$dst_r = imagecreatetruecolor( $targ_w, $targ_h );
		
		$_SESSION['img']->thumb = $src;

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],
		$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	
		header('Content-type: image/jpeg');
		imagejpeg($dst_r,null,$jpeg_quality);
		exit;
	}
}
*/// exibe a imagem

if(isset($_GET['img'])){
	if(isset($_SESSION['img'])){
		header('Content-type: image/jpeg');
		echo  $_SESSION['img'][ $_GET['img'] ]->thumb;
		exit;
	}
}

if($_GET['limpa'] == true){
	unset($_SESSION['img']);
}
/*  $base64   = base64_encode($_SESSION['img']['karate-monkey-big-1000x1328.jpg']); 

echo '<img src="data:image/jpeg;base64,' . $base64.'">';

*/