<?php
session_start();
?>

<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "login";
$tbl_name = "alumnos";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM $tbl_name WHERE username = '$username'";

$result = $conexion->query($sql);

$alumno=array();


if ($result->num_rows > 0) {
  while($row=$result->fetch_assoc())
  {
    $alumno[$row["Nombre"]]=array("Cuenta" => $row["username"], "Password" => $row["password"]);
  }
 }

 foreach ($alumno as $key => $value) {
   echo $value["Password"]!=$password;
   if($value["Cuenta"]==$username && $value["Password"]==$password){
     if($value["Password"]==$password && $value["Cuenta"]==$username){
       echo "Bienvenido! " .$key ;
       echo "<br><br><a href=panel-control.php>Panel de Control</a>";
     }
   }
   else{
     echo "Username o Password estan incorrectos.";
     echo "<br><br><a href='login.php'>Volver a Intentarlo</a>";
   }
}
 mysqli_close($conexion);
 ?>
