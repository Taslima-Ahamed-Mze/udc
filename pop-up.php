<?php

// file name
$filename = $_FILES['file']['name'];
//Variable

$id = $_POST['id'];
$facult = $_POST['facult'];
$depart = $_POST['depart'];
$niveau = $_POST['niv'];

// $file = rename($filename,)
// Location
$location = 'cours/'.$facult.'/'.$depart.'/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

$posi = strpos($filename,'.');
$name = substr($filename,0,$posi);
$file = addslashes($name.'_'.$niveau.'.'.$file_extension);
$location = 'cours/'.$facult.'/'.$depart.'/'.$file;

// Valid image extensions
$image_ext = array("jpg","png","pdf",'docx','doc');

$response = 0;
if(in_array($file_extension,$image_ext)){
  // Upload file
  if(move_uploaded_file(addslashes($_FILES['file']['tmp_name']),$location)){
	require_once('connex.php');
	mysqli_query($link,"INSERT INTO cours (id_enseignement,depot,date,statut) VALUES ($id,'".$file."',now(),1)")or die('erreur');
	$response = 1;

  }
}else{
  $response = 2;
}

echo $response;
?>