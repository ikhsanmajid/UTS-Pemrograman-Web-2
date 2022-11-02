<!--
buat mroses ngedit ya brooo.......!
-->
<?php
	include "koneksi.php";
	$modal_id=$_POST['modal_id'];
	$modal_name = $_POST['modal_name'];
	$description = $_POST['description'];
	$modal=mysqli_query($koneksi,"UPDATE modal SET modal_name = '$modal_name',description = '$description' WHERE modal_id = '$modal_id'");
	header('location:index.php');
?>