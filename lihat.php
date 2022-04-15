<?php
$nama_file = base64_decode($_GET['file']); 
$ext = explode('.', $nama_file);
if ($ext[1] == 'pdf') {
	$content = 'application/pdf';
}elseif ($ext[1] == 'jpg' || $ext[1] == 'jpeg' || $ext[1] == 'png') {
	$content = 'image/jpeg';
}else{
	$content = "application/octet-stream";
}
header("Content-type: $content"); 
$nama_file = base64_decode($_GET['file']); 

$document_contents = file_get_contents("upload/$nama_file");

echo $document_contents;
die();
?>

