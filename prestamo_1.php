<?php
session_start();
include_once('includes/config.php');

//Si el usuario no está logeado lo reenviamos a la home
if(!isset($_SESSION['prau_id_usuario'])) {
	header("Location: index.php");
	die();	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PRAU - Préstamo</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="initJS()">
<form name="form1" method="post" onsubmit="return false">
  <input type="text" name="usr_input" id="usr_input">
</form>

<div id="usr_data">
	<img id="usr_img">
	<h4>Nombre: <span id="usr_name"></span></h4>
	<h4>Curso: <span id="usr_curso"></span></h4>
</div>
<div id="usr_error">
	ERROR
</div>



<script src="js/prestamo_1.js"></script>
</body>
</html>