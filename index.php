<?php
session_start();
include('includes/config.php');

//Conecto con la DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Compruebo la conexión
if (!$conn) {
    die("Fallo en la conexión a la base de datos: " . mysqli_connect_error());
}
//Pongo la base de datos en UTF8 para los acentos
mysqli_query($conn,"set names 'utf8'");

//Si han hecho un logout
if(isset($_GET['logout'])){
	session_unset(); 
	session_destroy(); 
}

?>
<!doctype html>
<html>
<head>

<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,700,900|Varela+Round" rel="stylesheet">

<meta charset="utf-8">
<title>PRAU</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>


<?php if(isset($_SESSION['prau_id_usuario'])) : //Compruebo si está logearo?>


<?php include('includes/homepage.php') //Cargo la página inicial (al estar logeado) ?>


<?php elseif(isset($_POST['code'])) : //Si no está logeado pero se está logeando?>

<?php
//Creo una consulta que comprueba que el usuario está registrado (por código o por nombre)
$sql_validate = "SELECT * FROM usuarios WHERE codigo_usuario = '" . $_POST['code'] . "' OR nombre = '" . $_POST['code'] ."' LIMIT 1";

//Ejecuto la consulta SQL
$result_validate = mysqli_query($conn, $sql_validate);

//Compruebo que me ha devuelto algún registro
if (mysqli_num_rows($result_validate) > 0) {
    //Compruebo si es profesor, creando un array asociativo
	$datos = mysqli_fetch_assoc($result_validate);
	//Si NO es profesor (el campo no es igual a 1)
	if($datos['administrador'] != 1)
	{
		echo "ERROR NO ESTÁS AUTORIZADO";
		include('includes/login_form.php');
	}
	else
	{
		//ES profesor
		//Creo las variablbes de sesión;
		$_SESSION['prau_id_usuario'] = $datos['id_usuario'];
		$_SESSION['prau_nombre'] = $datos['nombre'];
		$_SESSION['prau_dni'] = $datos['dni'];
		$_SESSION['prau_correo'] = $datos['correo'];
		$_SESSION['prau_log_time'] = time();
		
		echo "Estás logeado. Espera unos segundos a que la página se recargue";
		header("Refresh:0.5");
	}
   
} else {
    echo "ERROR NO HAY RESULTADOS";
	include('includes/login_form.php');
	
}

?>


<?php else : //No está logeado ?>


<?php include('includes/login_form.php') //Muestro la página del formulario ?>

<?php endif //Final  ?>

</body>
</html>