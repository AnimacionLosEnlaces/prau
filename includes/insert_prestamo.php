<?php
include('config.php');

//Conecto con la DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Compruebo la conexión
if (!$conn) {
    die();
}
mysqli_query($conn,"set names 'utf8'");

$row = array();

if(isset($_GET['u']) && $_GET['u'] != '') {
	
	$sql = "INSERT INTO `prestamos` 
	(`id_prestamo`, `id_alumno`, `time`, `comentarios`) 
	VALUES (NULL, '" . $_GET['u'] . "', '" . time() ."', '')";
	if (mysqli_query($conn, $sql)) {
    	echo mysqli_insert_id($conn);
	} else {
		echo "error";
	}
	
}


?>