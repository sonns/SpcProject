<?php
if(is_array($_FILES)) {
	print_r($_POST);
	print_r($_FILES);exit;
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "images/".$_FILES['userImage']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img src="<?php echo $targetPath; ?>" width="100px" height="100px" />
<?php
}
}
}
?>