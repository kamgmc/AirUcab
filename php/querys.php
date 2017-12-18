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
//Query de Cargo
	function insertarCargo( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Cargo (er_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarCargo( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Cargo SET er_nombre='".$nombre."' WHERE er_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarCargo( $id ){
		global $conexion;
		$qry = "DELETE FROM Cargo where er_id=".$id;
		return pg_query($conexion, $qry);
	}
//Empleado
//Beneficiario
//Experiencia
//Cliente
//Factura_venta
//Proveedor
//Query Tipo de contacto
	function insertarTipoContacto( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Tipo_contacto (ct_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarTipoContacto( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Tipo_contacto SET ct_nombre='".$nombre."' WHERE ct_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTipoContacto( $id ){
		global $conexion;
		$qry = "DELETE FROM Tipo_contacto where ct_id=".$id;
		return pg_query($conexion, $qry);
	}
//Query de Contacto
	function insertarContacto( $valor, $tipo, $cliente, $empleado, $proveedor ){
		global $conexion;
		$valor = htmlentities($valor, ENT_QUOTES);
		if($empleado == 'NULL' && $cliente == 'NULL' && $proveedor == 'NULL') return false;
		if($cliente != 'NULL'){if($empleado!='NULL') return false; if($proveedor!='NULL') return false;}
		if($proveedor != 'NULL'){if($cliente!='NULL') return false; if($empleado!='NULL') return false;}
		if($empleado != 'NULL'){if($proveedor!='NULL') return false; if($cliente!='NULL') return false;}
		$qry = "INSERT INTO Contacto (co_valor, co_tipo, co_cliente, co_empleado, co_proveedor) VALUES ('".$valor."', ".$tipo.", ".$cliente.", ".$empleado.", ".$proveedor.")";
		return pg_query($conexion, $qry);
	}
	function editarContacto( $id, $valor, $tipo, $cliente, $empleado, $proveedor ){
		global $conexion;
		$valor = htmlentities($valor, ENT_QUOTES);
		if($empleado == 'NULL' && $cliente == 'NULL' && $proveedor == 'NULL') return false;
		if($cliente != 'NULL'){if($empleado!='NULL') return false; if($proveedor!='NULL') return false;}
		if($proveedor != 'NULL'){if($cliente!='NULL') return false; if($empleado!='NULL') return false;}
		if($empleado != 'NULL'){if($proveedor!='NULL') return false; if($cliente!='NULL') return false;}
		$qry = "UPDATE Contacto SET co_valor='".$valor."', co_tipo=".$tipo.", co_cliente=".$cliente.", co_empleado=".$empleado.", co_proveedor=".$proveedor." WHERE co_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarContacto( $id ){
		global $conexion;
		$qry = "DELETE FROM Contacto where co_id=".$id;
		return pg_query($conexion, $qry);
	}
//Query de Marca de motor
	function insertarMarcaMotor( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Marca_motor (mb_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarMarcaMotor( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Marca_motor SET mb_nombre='".$nombre."' WHERE mb_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarMarcaMotor( $id ){
		global $conexion;
		$qry = "DELETE FROM Marca_motor where mb_id=".$id;
		return pg_query($conexion, $qry);
	}
//Modelo_motor
//Modelo_avion
//Distribucion
//Submodelo_avion
//Query de S avion - m motor
	function insertarSAvionMMotor( $cantidad, $sAvion , $mMotor ){
		global $conexion;
		$qry = "INSERT INTO S_avion_m_motor (smt_cantidad, smt_submodelo_avion, smt_modelo_motor) VALUES (".$cantidad.", ".$sAvion.", ".$mMotor.")";
		return pg_query($conexion, $qry);
	}
	function editarSAvionMMotor( $id, $cantidad, $sAvion , $mMotor ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE S_avion_m_motor SET smt_cantidad=".$cantidad.", smt_submodelo_avion=".$sAvion.", smt_modelo_motor=".$mMotor." WHERE smt_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarSAvionMMotor( $id ){
		global $conexion;
		$qry = "DELETE FROM S_avion_m_motor where smt_id=".$id;
		return pg_query($conexion, $qry);
	}
//Query Tipo de ala
	function insertarTipoAla( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Tipo_ala (wt_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarTipoAla( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Tipo_ala SET wt_nombre='".$nombre."' WHERE wt_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTipoAla( $id ){
		global $conexion;
		$qry = "DELETE FROM Tipo_ala where wt_id=".$id;
		return pg_query($conexion, $qry);
	}
//Tipo_estabilizador
	function insertarTipoEstabilizador( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Tipo_estabilizador (et_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarTipoEstabilizador( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Tipo_estabilizador SET et_nombre='".$nombre."' WHERE et_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTipoEstabilizador( $id ){
		global $conexion;
		$qry = "DELETE FROM Tipo_estabilizador where et_id=".$id;
		return pg_query($conexion, $qry);
	}
//Modelo_pieza
//Query de S avion - m pieza
	function insertarSAvionMPieza( $cantidad, $sAvion , $mPieza ){
		global $conexion;
		$qry = "INSERT INTO S_avion_m_pieza (smp_cantidad, smp_submodelo_avion, smp_modelo_pieza) VALUES (".$cantidad.", ".$sAvion.", ".$mPieza.")";
		return pg_query($conexion, $qry);
	}
	function editarSAvionMPieza( $id, $cantidad, $sAvion , $mPieza ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE S_avion_m_pieza SET smp_cantidad=".$cantidad.", smp_submodelo_avion=".$sAvion.", smp_modelo_pieza=".$mPieza." WHERE smp_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarSAvionMPieza( $id ){
		global $conexion;
		$qry = "DELETE FROM S_avion_m_pieza where smp_id=".$id;
		return pg_query($conexion, $qry);
	}
//Prueba
	function insertarPrueba( $nombre, $tipo, $zona, $empleado ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$tipo = htmlentities($tipo, ENT_QUOTES);
		$qry = "INSERT INTO Prueba (pr_nombre, pr_tipo, pr_zona, pr_empleado) VALUES ('".$nombre."','".$tipo."',".$zona.",".$empleado.")";
		return pg_query($conexion, $qry);
	}
	function editarPrueba( $id, $nombre, $tipo, $zona, $empleado ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$tipo = htmlentities($tipo, ENT_QUOTES);
		$qry = "UPDATE Prueba SET pr_nombre='".$nombre."', pr_tipo='".$tipo."', pr_zona=".$zona.", pr_empleado=".$empleado." WHERE pr_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarPrueba( $id ){
		global $conexion;
		$qry = "DELETE FROM Prueba where pr_id=".$id;
		return pg_query($conexion, $qry);
	}
//Status_prueba
//Factura_compra
//Tipo_pago
//Pago
//Tipo_material
	function insertarTipoMaterial( $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Tipo_material (tm_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarTipoMaterial( $id, $nombre ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Tipo_material SET tm_nombre='".$nombre."' WHERE tm_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTipoMaterial( $id ){
		global $conexion;
		$qry = "DELETE FROM Tipo_material where tm_id=".$id;
		return pg_query($conexion, $qry);
	}
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
