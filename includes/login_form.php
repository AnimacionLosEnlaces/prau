<?php

$sql = "SELECT $campo_val FROM usuarios ORDER BY nombre";
$result = mysqli_query($conn, $sql);

?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p><img src="img/home_logo_prau.png" width="35%"></p>
<p>&nbsp; </p>
<form name="form1" method="post" action="index.php">
    <input list="login_list" name="code" id="code">
    
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
<p>&nbsp;</p>
<p><img src="img/home_logo_enlaces.png" width="25%" /></p>
