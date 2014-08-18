<?php
mysql_connect('localhost','root','');
mysql_select_db('upload');

$id = addslashes($_REQUEST['id']);
$req1 = mysql_query("SELECT * FROM image_store WHERE id = $id");
$tab_image = mysql_fetch_array($req1);
$image = $tab_image['image'];

header("Content-type : image/jpeg");
echo ($image);
?>