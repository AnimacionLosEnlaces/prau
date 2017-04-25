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

if(isset($_GET['m']) && $_GET['m'] != '') {
	//Consulta SQL compleja que devuelve los datos del usuario y de los ciclos en los que está inscrito
	$sql = "SELECT * FROM materiales WHERE codigo_material = '" . $_GET['m'] . "' LIMIT 1";
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
else
{
	$row['error'] = "No se ha especificado código de material";
}
echo json_encode($row);
?>