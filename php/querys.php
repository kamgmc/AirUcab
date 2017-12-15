<?php  include 'conexion.php';
//Querys de Status
	function insertarStatus( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Status (st_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarStatus( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Status SET st_nombre='".$nombre."' WHERE st_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarStatus( $id ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "DELETE FROM Status WHERE st_id=".$id;
		return pg_query($conexion, $qry);
	}
//Querys de Rol de sistema
	function insertarRol( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Rol_sistema (sr_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarRol( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Rol_sistema SET sr_nombre='".$nombre."' WHERE sr_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarRol( $id ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "DELETE FROM Rol_sistema WHERE sr_id=".$id;
		return pg_query($conexion, $qry);
	}
//Querys de Rol - permiso
	function insertarRolPermiso( $rol, $permiso ){
		global $conexion;
		$qry = "INSERT INTO Rol_permiso (rp_rol,rp_permiso) VALUES (".$rol.",".$permiso.")";
		return pg_query($conexion, $qry);
	}
	function editarRolPermiso( $id, $rol, $permiso ){
		global $conexion;
		$qry = "UPDATE Rol_permiso SET rp_rol=".$rol.", rp_permiso=".$permiso." WHERE rp_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarRolPermiso( $id ){
		global $conexion;
		$qry = "DELETE FROM Rol_permiso WHERE rp_id=".$id;
		return pg_query($conexion, $qry);
	}
// Querys de Lugar
	function insertarLugar( $nombre , $tipo, $lugar ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Lugar (lu_nombre, lu_tipo, lu_lugar) VALUES ('".$nombre."','".$tipo."',".$lugar.")";
		return pg_query($conexion, $qry);
	}
	function editarLugar( $id, $nombre, $tipo, $lugar ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Lugar SET lu_nombre ='".$nombre."', lu_tipo='".$tipo."', lu_lugar=".$lugar." where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarLugar( $id ){
		global $conexion;
		$qry = "DELETE FROM Lugar where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
// Querys de Sede
	function insertarSede( $nombre , $area, $principal, $lugar ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Sede (se_nombre, se_area, se_principal, se_lugar) VALUES ('".$nombre."',".$area.",".$principal.",".$lugar.")";
		return pg_query($conexion, $qry);
	}
	function editarSede( $id, $nombre , $area, $principal, $lugar ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Sede SET se_nombre='".$nombre."', se_area=".$area.", se_principal=".$principal.", se_lugar=".$lugar." WHERE se_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarSede( $id ){
		global $conexion;
		$qry = "DELETE FROM Sede where se_id=".$id;
		return pg_query($conexion, $qry);
	}
//Query de Zona
	function insertarZona( $nombre , $tipo, $sede ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		if($tipo != "Ensamblaje" && $tipo != "Prueba")
			return false;
		$qry = "INSERT INTO Zona (zo_nombre, zo_tipo, zo_sede) VALUES ('".$nombre."','".$tipo."',".$sede.")";
		return pg_query($conexion, $qry);
	}
	function editarZona( $id, $nombre , $tipo, $sede ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		if($tipo != "Ensamblaje" && $tipo != "Prueba")
			return false;
		$qry = "UPDATE Zona SET zo_nombre='".$nombre."', zo_tipo='".$tipo."', zo_sede=".$sede." WHERE zo_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarZona( $id ){
		global $conexion;
		$qry = "DELETE FROM Zona where zo_id=".$id;
		return pg_query($conexion, $qry);
	}
//Query de Titulacion
	function insertarTitulacion( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Titulacion (ti_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarTitulacion( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Titulacion SET ti_nombre='".$nombre."' WHERE ti_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTitulacion( $id ){
		global $conexion;
		$qry = "DELETE FROM Titulacion where ti_id=".$id;
		return pg_query($conexion, $qry);
	}
//Cargo
//Empleado
//Beneficiario
//Experiencia
//Cliente
//Factura_venta
//Detalle_factura_venta
//Proveedor
//Tipo_contacto
//Contacto
//Marca_motor
//Modelo_motor
//Modelo_avion
//Distribucion
//Submodelo_avion
//S_avion_m_motor
//Tipo_ala
//Tipo_estabilizador
//Modelo_pieza
//S_avion_m_pieza
//Prueba
//Status_prueba
//Factura_compra
//Detalle_factura_compra
//Tipo_pago
//Pago
//Tipo_material
//T_material_m_pieza
//Avion
//Status_avion
//Motor
//Status_motor
//Pieza
//Status_pieza
//Material
//Prueba_material
//Status_material
//Prueba_pieza
//Traslado
?>
