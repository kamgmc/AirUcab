<?php 
if(empty($_SESSION['code'])){
	include "conexion.php"; 
	$pass = md5(mysql_real_escape_string($_POST['loginPassword']));
	$usuario = strtoupper(htmlentities($_POST['loginUsername'], ENT_QUOTES));
	$usuario = md5(mysql_real_escape_string($usuario));
	$qry = "SELECT em_id id, em_usuario usuario, em_rol rol, em_nombre || ' ' || em_apellido AS nombre, er_nombre AS cargo FROM Empleado, Cargo WHERE em_cargo=er_id AND md5(em_usuario)='".$usuario."' AND em_clave='".$pass."'";
	$con = pg_query($conexion, $qry);
	if($empleado = pg_fetch_object($con)){
		session_start(); 
		date_default_timezone_set('America/Port_of_Spain');  
		$nombre = session_name("AirUCAB");
		$_SESSION['id'] = $empleado->id;
		$_SESSION['nombre'] = $empleado->nombre;
		$_SESSION['usuario'] = ucfirst(strtolower($empleado->usuario));
		$_SESSION['cargo'] = $empleado->cargo;
		$_SESSION['code'] = "9d5e3ecdeb4cdb7acfd63075ae046672";?>
		<meta content="0,modeloavion.php" http-equiv="refresh"/>
	<?php 
	}
	else{?> 
	<meta content="0,login.php?error=1" http-equiv="refresh"/> <?php 
	}
}
else{?>
	<meta content="0,modeloavion.php" http-equiv="refresh"/><?php 
}?>