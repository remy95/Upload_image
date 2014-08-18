
<title>Upload d'image</title>
<h1>Upload d'image</h1>

<?php
mysql_connect('localhost','root','');
mysql_select_db('upload');

$tab_ext = array('png','jpg','jpeg','gif');

if (empty($_FILES['image']['tmp_name']) or !isset($_FILES['image']['tmp_name']))
 echo('Insert an image');
else
{
	$image_content= mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
	$image_name = mysql_real_escape_string($_FILES['image']['name']);
	$extension =  strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
	if (in_array($extension, $tab_ext))
	{
		if ($_FILES['image']['size'] <= 4294967295)
		{
			$req1 = mysql_query("INSERT INTO image_store VALUES('','$image_name','$image_content') ");
			$id = mysql_query("SELECT * FROM image_store ORDER BY id DESC LIMIT 1");
			$tab = mysql_fetch_array($id) or die(mysql_error());
			$last_id = $tab['id'];
			echo "Your image: <p /><img src='put_image.php?id=".$last_id."'>";
		}
		else
		{
			echo "The size of the image is to large";
		}
	}
	else
	{
		echo "This is not an image";
	}

}
?>

<form action="submit_image.php" method="post" enctype="multipart/form-data">
<input type="file" name="image" /><br /><br />
<input type="submit" value="uploader l'image" /><br />
</form>
