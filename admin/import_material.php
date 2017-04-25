<?php
include('../includes/config.php');

//Conecto con la DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Compruebo la conexión
if (!$conn) {
    die();
}
mysqli_query($conn,"set names 'utf8'");


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Importar material</title>
</head>

<body>

<?php

$sql = "SELECT * FROM inventario";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	
	echo "<h1 align='center'>Materiales disponibles (" . mysqli_num_rows($result) . ") </h1>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$code = "IS-" . $row['num_orden'];
		$nombre = $row['descripcion'];
		$modelo = $row['modelo'];
		$no_serie = $row['numero_serie'];
		$descripcion = $row['observaciones'];
		
        echo "<p>Code: " . $code . "</p>";
		echo "<p>Nombre: " . $nombre . "</p>";
		echo "<p>Modelo: " . $modelo . "</p>";
		echo "<p>Número de serie: " . $no_serie . "</p>";
		echo "<p>Descripción: " . $descripcion . "</p>";
		
		//Si no existe la marca, la creamos
		$marca = $row['marca'];
		$sql_marca = "SELECT id_marca FROM marcas WHERE nombre = '$marca' LIMIT 1";
		$result_marca = mysqli_query($conn, $sql_marca);
		if(mysqli_num_rows($result_marca) > 0)
		{
			$row_marca = mysqli_fetch_assoc($result_marca);
			$id_marca = $row_marca['id_marca'];
			$aviso = "";
		}
		else 
		{
			//Insertamos la nueva marca
			mysqli_query($conn, "INSERT INTO marcas (id_marca, nombre) VALUES (NULL,'$marca')");
			$id_marca = mysqli_insert_id($conn);
			$aviso = " -  NUEVA";
		}
		echo "<p>ID Marca: " . $id_marca . " (" . $marca . ")" . $aviso . "</p>";
		
		//Si el producto no existe lo insertamos
		$sql_check = "SELECT codigo_material FROM materiales WHERE codigo_material = '$code' LIMIT 1";
		$result_check = mysqli_query($conn, $sql_check);
		if(mysqli_num_rows($result_check) == 0)
		{
			//Insertamos el nuevo material
			mysqli_query($conn, "INSERT INTO `materiales` 
			(`id_material`, `codigo_material`, `nombre`, `modelo`, `id_marca`, `id_subcategoria`, `no_serie`, `descripcion`) 
			VALUES (NULL, '$code', '$nombre', '$modelo', '$id_marca', '1', '$no_serie', '$descripcion');");
			$id_material = mysqli_insert_id($conn);
			$aviso = " -  NUEVO ($id_material)";
		}
		
		echo "<hr>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>
</body>
</html>