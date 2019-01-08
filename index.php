<!DOCTYPE html>
<html>
<head>
<link href="/ygoupload.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Anton|Roboto+Slab|Roboto+Slab:Bold" rel="stylesheet">
<title>YGO Image Upload</title>
<?php
$page = $_GET['reason'];
$name = html_entity_decode ($_GET['name']);
$date = date('Y-m-d');
$folder = 'pics/'.$name.'.png';
?>
</head>
<body>
<div id="Container">

<center>
<div id="Main">
<center><?php
if($page == 'large'){
	echo '<p id="error">The Image file was over 1MB<br><input class="input2" readonly></p>';
}
elseif($page == 'nofile'){
	echo '<p id="error">No File Selected!<br><input class="input2" readonly></p>';
}
elseif($page == 'noname'){
	echo '<p id="error">No Nickname Entered!<br><input class="input2" readonly></p>';
}
elseif($page == 'size'){
	echo '<p id="error">The Image file must be 96px x 96px<br><input class="input2" readonly></p>';
}
elseif($page == 'type'){
	echo '<p id="error">The Image file must be in PNG format<br><input class="input2" readonly></p>';
}
elseif($page == 'done'){
	echo '<p id="done">'.$name.'<br>Your Image Has Been Uploaded!<br>';
	echo '<font style="font-size:12pt;">Your image will be added to the updater after it has been checked by Akipuff.</font>';	
if(file_exists($folder)) {
	echo '<br><br><img src="pics/'.$name.'.png"></p>';
	}
else { echo '</p>';
}
die();
}
else{}
?><br>
<span id="head">YGOPro2 User Image</span><br><br>
Here you can submit your face icon for the YGOPro2 client.<br>
The icon will be reviewed by Akipuff and added to YGOPro2 if it isn't breaking rules.<br>
Remember that your answers to this form can be changed after you answer.</center>
<form action="add.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<p>Your YGOPro2 Nickname:
<br><input type="text" class="input" name="name" value="<?php if(isset($name)){echo $name;} ?>"  placeholder="Enter Here..." required>
</p>
<p>Your Face Icon:
<br><span id="face">Requirements:
<br>- No real life photos of yourself or other people.
<br>- No nudity.
<br>- No offensive images.
<br>- Dimensions: 96px x 96px
<br>- PNG Only
<br>- Max Size: 1MB
<br></span>
<input type="file" accept="image/png,image/x-png" class="input" name="image" required>
</p>
<p>
<table>
<tr>
<td>
<input type="checkbox" style="width:50px;" class="input" required>
</td>
<td>
By filling out this form, I agree that the picture I have chosen is not against the rules and I take responsibility for what I upload.
</td>
</tr>
</table>
</p>
<p>
<table>
<tr>
<td>
<input type="checkbox" style="width:50px;" class="input" required>
</td>
<td>
By filling out this form, I acknowledge that this feature requires my username to remain the same as the one associated with my picture.
</td>
</tr>
</table>
</p>
<p style="text-align:center;">
<input type="submit" name="submit" value="Submit" id="input2">
</p>
</form>
<br><br><br>
</div>
</center>
</div>
</body>
</html>