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
	
	$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_GET['u'] . "' LIMIT 1";

	//Ejecuto la consulta SQL
	$result = mysqli_query($conn, $sql);
	
	//Compruebo que me ha devuelto algún registro
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$row['error'] = "";
		
	}
	else
	{
		$row['error'] = "No hay resultados";
	}
}
echo json_encode($row);
?>