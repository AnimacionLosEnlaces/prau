<?php

$sql = "SELECT $campo_val FROM usuarios ORDER BY nombre";
$result = mysqli_query($conn, $sql);

?>

<form name="form1" method="post" action="index.php">
    <input list="login_list" name="code">
    
  <datalist id="login_list">
<?php
if (mysqli_num_rows($result) > 0) {
    //Listo los usuarios por nombre
    while($row = mysqli_fetch_assoc($result)) {
        echo '
		<option value="' . $row[$campo_val] . '">
';
    }
}

?>
    </datalist>


  <input type="submit" name="button" id="button" value="Enviar">
</form>