<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
header('Content-Type: text/html; charset=utf-8');
$folder = 'pics/';
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}
$name = $_POST['name'];
$filenametest = $_FILES['image']['tmp_name'];
imagepng(imagecreatefromstring($filenametest));
$temp = explode(".", $_FILES["image"]["name"]);
$fileName = $_POST['name'] . '.' . end($temp); // The file name
$fileTmpLoc = $_FILES["image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["image"]["type"]; // The type of file it is
$fileSize = $_FILES["image"]["size"]; // File size in bytes
list($width, $height, $type, $attr) = getimagesize($filenametest);
$fileErrorMsg = $_FILES["image"]["error"]; // 0 for false... and 1 for true
$fileEXISTS = "empty/" . $fileName;
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom);
if (!$fileTmpLoc) { // if file not chosen
	unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	header("Location: /?reason=nofile");
	exit();
} else if (!preg_match("/.(png)$/i", $fileName) ) {
	unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	header("Location: /?reason=type&name=".$_POST['name']);
	exit();
} else if(empty($_POST)) {
	unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	header("Location: /?reason=noname&name=".$_POST['name']);
	exit();
} else if($fileSize > 1048576) { // if file size is larger than 1 Megabytes
	unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	header("Location: /?reason=large&name=".$_POST['name']);
	exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "<b><center><br><br><br>ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, $folder.$fileName);
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "<b><center><br><br><br>ERROR: File not uploaded. Try again.";
    exit();
}
unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Universal Image Resizing Function --------
include_once("size.php");
$target_file = "pics/$fileName";
$resized_file = "pics/$fileName";
$wmax = 96;
$hmax = 96;
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
header("Location: /?reason=done&name=".htmlentities($_POST['name']));
?>