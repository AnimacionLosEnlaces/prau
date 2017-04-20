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
	//Consulta SQL compleja que devuelve los datos del usuario y de los ciclos en los que está inscrito
	$sql = "SELECT U.*, R.id_ciclo, C.nombre AS nombre_curso, C.curso FROM 
			usuarios U, rel_usuarios_ciclos R, ciclos C
			WHERE U.id_usuario = 1 
			AND U.id_usuario = R.id_usuario 
			AND R.id_ciclo = C.id_ciclo";

	//Ejecuto la consulta SQL
	$result = mysqli_query($conn, $sql);
	
	//Compruebo que me ha devuelto algún registro
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		
		//Id de usuario
		$id_usuario = $row['id_usuario'];
		
		$row['error'] = "";
		
	}
	else
	{
		$row['error'] = "No hay resultados";
	}
}
else
{
	$row['error'] = "No se ha especificado código de usuario";
}
echo json_encode($row);
?>