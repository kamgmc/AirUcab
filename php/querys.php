<?php  include 'conexion.php';
//Modelo_avion
	function insertarModeloAvion( $nombre, $longitud, $envergadura, $altura, $superficie_alar, $flecha_alar, $peso_max, $alcance, $velocidad_max, $techo_servicio, $regimen_ascenso, $numero_pasillos, $fuselaje_tipo, $fuselaje_altura, $fuselaje_ancho, $cabina_altura, $cabina_ancho, $volumen_carga, $capacidad_pilotos, $capacidad_asistentes, $carrera_despegue, $tiempo_estimado ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Modelo_avion (am_nombre, am_longitud, am_envergadura, am_altura, am_ala_superficie, am_ala_flecha, am_peso_aterrizaje_max, am_alcance, am_velocidad_max, am_techo_servicio, am_regimen_ascenso, am_numero_pasillos, am_fuselaje_tipo, am_fuselaje_altura, am_fuselaje_ancho, am_cabina_altura, am_cabina_ancho, am_carga_volumen, am_capacidad_pilotos, am_capacidad_asistentes, am_carrera_despegue, am_tiempo_estimado) VALUES('".$nombre."', ".$longitud.", ".$envergadura.", ".$altura.", ".$superficie_alar.", ".$flecha_alar.", ".$peso_max.", ".$alcance.", ".$velocidad_max.", ".$techo_servicio.", ".$regimen_ascenso.", ".$numero_pasillos.", '".$fuselaje_tipo."', ".$fuselaje_altura.", ".$fuselaje_ancho.", ".$cabina_altura.", ".$cabina_ancho.", ".$volumen_carga.", ".$capacidad_pilotos.", ".$capacidad_asistentes.", ".$carrera_despegue.", ".$tiempo_estimado.");";
		return pg_query($conexion, $qry);
	}
	function editarModeloAvion( $id, $nombre, $longitud, $envergadura, $altura, $superficie_alar, $flecha_alar, $peso_max, $alcance, $velocidad_max, $techo_servicio, $regimen_ascenso, $numero_pasillos, $fuselaje_tipo, $fuselaje_altura, $fuselaje_ancho, $cabina_altura, $cabina_ancho, $volumen_carga, $capacidad_pilotos, $capacidad_asistentes, $carrera_despegue, $tiempo_estimado ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Modelo_avion SET am_nombre='".$nombre."', am_longitud=".$longitud.", am_envergadura=".$envergadura.", am_altura=".$altura.", am_ala_superficie=".$superficie_alar.", am_ala_flecha=".$flecha_alar.", am_peso_aterrizaje_max=".$peso_max.", am_alcance=".$alcance.", am_velocidad_max=".$velocidad_max.", am_techo_servicio=".$techo_servicio.", am_regimen_ascenso=".$regimen_ascenso.", am_numero_pasillos=".$numero_pasillos.", am_fuselaje_tipo='".$fuselaje_tipo."', am_fuselaje_altura=".$fuselaje_altura.", am_fuselaje_ancho=".$fuselaje_ancho.", am_cabina_altura=".$cabina_altura.", am_cabina_ancho=".$cabina_ancho.", am_carga_volumen=".$volumen_carga.", am_capacidad_pilotos=".$capacidad_pilotos.", am_capacidad_asistentes=".$capacidad_asistentes.", am_carrera_despegue=".$carrera_despegue.", am_tiempo_estimado=".$tiempo_estimado." WHERE am_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarModeloAvion($id){
		global $conexion;
		$qry = "DELETE FROM Modelo_avion where am_id=".$id;
		$qry2 = "DELETE FROM Distribucion where di_modelo_avion=".$id;
		$qry3 = "DELETE FROM Submodelo_avion where as_modelo_avion=".$id;
		$qry4 = "DELETE FROM S_avion_m_motor where smt_submodelo_avion in (Select as_id from Submodelo_avion where as_modelo_avion=".$id.")";
		$qry5 = "DELETE FROM S_avion_m_pieza where smp_submodelo_avion in (Select as_id from Submodelo_avion where as_modelo_avion=".$id.")";
		$qry6 = "DELETE FROM Avion where a_submodelo_avion in (Select as_id from Submodelo_avion where as_modelo_avion=".$id.") or a_distribucion in (Select di_id from Distribucion where di_modelo_avion=".$id.")";
		$qry7 = "DELETE FROM Status_avion where sa_avion in (Select a_id from Avion, Submodelo_avion where a_submodelo_avion=as_id and as_modelo_avion=".$id.") or sa_avion in (Select a_id from Avion, Distribucion where a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry8 = "DELETE FROM Motor where mo_avion in (Select a_id from Avion, Submodelo_avion where a_submodelo_avion=as_id and as_modelo_avion=".$id.") or mo_avion in (Select a_id from Avion, Distribucion where a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry9 = "DELETE FROM Status_motor where stm_motor in (Select mo_id from Motor, Avion, Submodelo_avion where mo_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or stm_motor in (Select mo_id from Motor, Avion, Distribucion where mo_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry10 = "DELETE FROM Pieza where p_avion in (Select a_id from Avion, Submodelo_avion where a_submodelo_avion=as_id and as_modelo_avion=".$id.") or p_avion in (Select a_id from Avion, Distribucion where a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry11 = "DELETE FROM Status_pieza where spi_pieza in (Select p_id from Pieza, Avion, Submodelo_avion where p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or spi_pieza in (Select p_id from Pieza, Avion, Distribucion where p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry12 = "DELETE FROM Material where m_pieza in (Select p_id from Pieza, Avion, Submodelo_avion where p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or m_pieza in (Select p_id from Pieza, Avion, Distribucion where p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry13 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Material, Pieza, Avion, Submodelo_avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or prm_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry14 = "DELETE FROM Status_material where sm_material in (Select m_id from Material, Pieza, Avion, Submodelo_avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or sm_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry15 = "DELETE FROM Traslado where tr_pieza in (Select p_id from Pieza, Avion, Submodelo_avion where p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or tr_pieza in (Select p_id from Pieza, Avion, Distribucion where p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry16 = "DELETE FROM Traslado where tr_material in (Select m_id from Material, Pieza, Avion, Submodelo_avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or tr_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		$qry17 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion, Submodelo_avion where p_avion=a_id and a_submodelo_avion=as_id and as_modelo_avion=".$id.") or pp_pieza in (Select p_id from Pieza, Avion, Distribucion where p_avion=a_id and a_distribucion=di_id and di_modelo_avion=".$id.")";
		if(pg_query($conexion, $qry17))
			if(pg_query($conexion, $qry16))
				if(pg_query($conexion, $qry15))
					if(pg_query($conexion, $qry14))
						if(pg_query($conexion, $qry13))
							if(pg_query($conexion, $qry12))
								if(pg_query($conexion, $qry11))
									if(pg_query($conexion, $qry10))
										if(pg_query($conexion, $qry9))
											if(pg_query($conexion, $qry8))
												if(pg_query($conexion, $qry7))
													if(pg_query($conexion, $qry6))
														if(pg_query($conexion, $qry5))
															if(pg_query($conexion, $qry4))
																if(pg_query($conexion, $qry3))
																	if(pg_query($conexion, $qry2))
																		return pg_query($conexion, $qry);
		return false;
	}
//Querys de Empleado
	function insertarEmpleado( $nac, $ci, $nombre, $apellido, $usuario, $clave, $titulacion, $cargo, $rol, $zona, $direccion, $supervisa, $gerencia, $nota){
		global $conexion;
		$nombre = htmlentities(ucfirst(strtolower($nombre)), ENT_QUOTES);
		$apellido = htmlentities(ucfirst(strtolower($apellido)), ENT_QUOTES);
		$usuario = htmlentities($usuario, ENT_QUOTES);
		$clave = md5(htmlentities($clave, ENT_QUOTES));
		if($nota != 'NULL') $nota = "'".htmlentities($nota, ENT_QUOTES)."'";
		$qry = "INSERT INTO Empleado (em_nacionalidad, em_ci, em_nombre, em_apellido, em_fecha_ingreso, em_usuario, em_clave, em_titulacion, em_cargo, em_rol, em_zona, em_direccion, em_supervisa, em_gerencia, em_nota) VALUES ('".$nac."',".$ci.",'".$nombre."','".$apellido."',transaction_timestamp(),UPPER('".$usuario."'),'".$clave."',".$titulacion.",".$cargo.",".$rol.",".$zona.",".$direccion.", ".$supervisa.",".$gerencia.",".$nota.")";
		return pg_query($conexion, $qry);
	}
	function editarEmpleado( $id, $nacionalidad, $ci, $nombre, $apellido, $usuario, $titulacion, $cargo, $rol, $zona, $direccion, $supervisa, $gerencia, $nota){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$usuario = htmlentities($usuario, ENT_QUOTES);
		if($nota != 'NULL') $nota = "'".htmlentities($nota, ENT_QUOTES)."'";
		$qry = "UPDATE Empleado SET em_nacionalidad='".$nacionalidad."', em_ci=".$ci.", em_nombre='".$nombre."', em_apellido='".$apellido."', em_usuario='".$usuario."', em_titulacion=".$titulacion.", em_cargo=".$cargo.", em_rol=".$rol.", em_zona=".$zona.", em_direccion=".$direccion.", em_supervisa=".$supervisa.", em_gerencia=".$gerencia.", em_nota=".$nota." WHERE em_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarEmpleado( $id ){
		global $conexion;
		$qry = "DELETE FROM Empleado WHERE em_id=".$id;
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
	function editarContacto( $id, $valor, $tipo ){
		global $conexion;
		$valor = htmlentities($valor, ENT_QUOTES);
		$qry = "UPDATE Contacto SET co_valor='".$valor."', co_tipo=".$tipo." WHERE co_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarContacto( $id ){
		global $conexion;
		$qry = "DELETE FROM Contacto where co_id=".$id;
		return pg_query($conexion, $qry);
	}
//Querys de Beneficiario
	function insertarBeneficiario( $nacionalidad, $ci, $nombre, $apellido, $empleado){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$qry = "INSERT INTO Beneficiario (be_nacionalidad, be_ci, be_nombre, be_apellido, be_empleado) VALUES ('".$nacionalidad."', ".$ci.", '".$nombre."', '".$apellido."', ".$empleado." ) ";
		return pg_query($conexion, $qry);
	}
	function editarBeneficiario( $id, $nacionalidad, $ci, $nombre, $apellido ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$qry = "UPDATE Beneficiario SET be_nacionalidad='".$nacionalidad."', be_ci=".$ci.", be_nombre='".$nombre."', be_apellido='".$apellido."' WHERE be_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarBeneficiario( $id ){
		global $conexion;
		$qry = "DELETE FROM Beneficiario where be_id=".$id;
		return pg_query($conexion, $qry);
	}
//Querys de Experiencia
	function insertarExperiencia( $desc, $years, $empleado ){
		global $conexion;
		$desc = htmlentities($desc, ENT_QUOTES);
		$qry = "INSERT INTO Experiencia (ex_descripcion,ex_years,ex_empleado) VALUES ('".$desc."', ".$years.", ".$empleado.")";
		return pg_query($conexion, $qry);
	}
	function editarExperiencia( $id, $desc, $years ){
		global $conexion;
		$desc = htmlentities($desc, ENT_QUOTES);
		$qry = "UPDATE Experiencia SET ex_descripcion='".$desc."', ex_years=".$years." WHERE ex_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarExperiencia( $id ){
		global $conexion;
		$qry = "DELETE FROM Experiencia where ex_id=".$id;
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

//Cliente
	function insertarCliente ( $trif, $rif, $nombre, $pweb, $lugar ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "INSERT INTO Cliente (cl_tipo_rif, cl_rif, cl_nombre, cl_pagina_web, cl_fecha_inicio, cl_direccion) VALUES ('".$trif."', ".$rif.", '".$nombre."', '".$pweb."', transaction_timestamp(),".$lugar." )";
		return pg_query($conexion, $qry);
	}
	function editarCliente ( $id, $trif, $rif, $nombre, $pweb, $finicio ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "UPDATE Cliente SET cl_tipo_rif='".$trif."', cl_rif='".$trif."', cl_nombre='".$nombre."', cl_pagina_web='".$pweb."', cl_fecha_inicio='".$finicio."' WHERE cl_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarCliente($id){
		global $conexion;
		$qry = "DELETE FROM Cliente where cl_id=".$id;
		$qry2 = "DELETE FROM Contacto where co_cliente=".$id;
		$qry3 = "DELETE FROM Factura_venta where fv_cliente=".$id;
		$qry4 = "DELETE FROM Pago where pa_factura_venta in (Select fv_id from Factura_venta where fv_cliente=".$id.")";
		$qry5 = "DELETE FROM Avion where a_factura_venta in (Select fv_id from Factura_venta where fv_cliente=".$id.")";
		$qry6 = "DELETE FROM Status_avion where sa_avion in (Select a_id from Avion, Factura_venta, Cliente where a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry7 = "DELETE FROM Pieza where p_avion in (Select a_id from Avion, Factura_venta, Cliente where a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry8 = "DELETE FROM Status_pieza where spi_pieza in (Select p_id from Pieza, Avion, Factura_venta, Cliente where p_avion=a_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry9 = "DELETE FROM Material where m_pieza in (Select p_id from Pieza, Avion, Factura_venta, Cliente where p_avion=a_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry10 = "DELETE FROM Motor where mo_avion in (Select a_id from Avion, Factura_venta, Cliente where a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry11 = "DELETE FROM Status_motor where stm_motor in (Select mo_id from Avion, Factura_venta, Cliente, Motor where mo_avion=a_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry12 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Avion, Factura_venta, Cliente, Pieza, Material where p_avion=a_id and m_pieza=p_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry13 = "DELETE FROM Status_material where sm_material in (Select m_id from Avion, Factura_venta, Cliente, Pieza, Material where p_avion=a_id and m_pieza=p_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry14 = "DELETE FROM Traslado where tr_material in (Select m_id from Avion, Factura_venta, Cliente, Pieza, Material where p_avion=a_id and m_pieza=p_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry15 = "DELETE FROM Traslado where tr_pieza in (Select p_id from Pieza, Avion, Factura_venta, Cliente where p_avion=a_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		$qry16 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion, Factura_venta, Cliente where p_avion=a_id and a_factura_venta=fv_id and fv_cliente=".$id.")";
		if(pg_query($conexion, $qry16))
			if(pg_query($conexion, $qry15))
				if(pg_query($conexion, $qry14))
					if(pg_query($conexion, $qry13))
						if(pg_query($conexion, $qry12))
							if(pg_query($conexion, $qry11))
								if(pg_query($conexion, $qry10))
									if(pg_query($conexion, $qry9))
										if(pg_query($conexion, $qry8))
											if(pg_query($conexion, $qry7))
												if(pg_query($conexion, $qry6))
													if(pg_query($conexion, $qry5))
														if(pg_query($conexion, $qry4))
															if(pg_query($conexion, $qry3))
																if(pg_query($conexion, $qry2))
																	return pg_query($conexion, $qry);
	}
//Factura_venta
	function insertarFacturaVenta( $cliente ){
		global $conexion;
		$qry = "INSERT INTO Factura_venta (fv_cliente,fv_fecha) VALUES (".$cliente.",transaction_timestamp())";
		return pg_query($conexion, $qry);
	}
	function editarFacturaVenta( $id, $fecha ){
		global $conexion;
		$qry = "UPDATE Factura_venta SET fc_fecha='".$fecha."' WHERE fc_id=".$id;
		return pg_query($conexion, $qry);
	}
//Proveedor
	function insertarProveedor ( $trif, $rif, $nombre, $pweb, $finicio ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "INSERT INTO Proveedor (po_tipo_rif, po_rif, po_nombre, po_pagina_web, po_fecha_inicio) VALUES ('".$trif."', ".$rif.", '".$nombre."', '".$pweb."', '".$finicio."')";
		return pg_query($conexion, $qry);
	}
	function editarProveedor ( $id, $trif, $rif, $nombre, $pweb, $finicio ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "UPDATE Proveedor SET po_tipo_rif='".$trif."', po_rif='".$trif."', po_nombre='".$nombre."', po_pagina_web='".$pweb."', po_fecha_inicio='".$finicio."' WHERE po_id=".$id;
		return pg_query($conexion, $qry);
	}
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
		$qry2 = "DELETE FROM Modelo_motor where mm_marca_motor=".$id;
		$qry3 = "DELETE FROM S_avion_m_motor where smt_modelo_motor=".$id;
		$qry4 = "DELETE FROM Motor where mo_modelo_motor=".$id;
		$qry5 = "DELETE FROM Status_motor stm_motor=".$id;
		if(pg_query($conexion, $qry5)){
			if(pg_query($conexion, $qry4)){
				if(pg_query($conexion, $qry3)){
					if(pg_query($conexion, $qry2)){
						return pg_query($conexion, $qry);
					}
				}
			}
		}
		return 0;
	}
//Modelo_motor
	function eliminarModeloMotor( $id ){
		global $conexion;
		$qry2 = "DELETE FROM Modelo_motor where mm_id=".$id;
		$qry3 = "DELETE FROM S_avion_m_motor where smt_modelo_motor=".$id;
		$qry4 = "DELETE FROM Motor where mo_modelo_motor=".$id;
		$qry5 = "DELETE FROM Status_motor stm_motor=".$id;
		if(pg_query($conexion, $qry5)){
			if(pg_query($conexion, $qry4)){
				if(pg_query($conexion, $qry3)){
					return pg_query($conexion, $qry2);
				}
			}
		}
		return 0;
	}
//Distribucion
	function insertarDistribucion( $nombre, $capacidad_pasajeros, $numero_clases, $distancia_asientos, $ancho_asientos, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Distribucion (di_nombre, di_numero_clases, di_capacidad_pasajeros, di_distancia_asientos, di_ancho_asientos, di_modelo_avion) VALUES('".$nombre."', ".$numero_clases.", ".$capacidad_pasajeros.", ".$distancia_asientos.", ".$ancho_asientos.", ".$modelo.")";
		return pg_query($conexion, $qry);
	}
	function editarDistribucion( $id, $nombre, $capacidad_pasajeros, $numero_clases, $distancia_asientos, $ancho_asientos, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Distribucion  SET di_nombre='".$nombre."', di_numero_clases=".$numero_clases.", di_capacidad_pasajeros=".$capacidad_pasajeros.", di_distancia_asientos=".$distancia_asientos.", di_ancho_asientos=".$ancho_asientos.", di_modelo_avion=".$modelo." WHERE di_id=".$id;
		return pg_query($conexion, $qry);
	}
//Submodelo_avion
	function insertarSubmodeloAvion( $nombre, $peso_max, $peso_vacio, $velocidad_crucero, $carrera, $autonomia, $combustible, $alcance, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Submodelo_avion (as_nombre, as_peso_maximo_despegue, as_peso_vacio, as_velocidad_crucero, as_carrera_despegue_peso_maximo, as_autonomia_peso_maximo_despegue, as_capacidad_combustible, as_alcance_carga_maxima, as_modelo_avion) VALUES('".$nombre."', ".$peso_max.", ".$peso_vacio.", ".$velocidad_crucero.", ".$carrera.", ".$autonomia.", ".$combustible.", ".$alcance.", ".$modelo.")";
		return pg_query($conexion, $qry);
	}
	function editarSubmodeloAvion( $id, $nombre, $peso_max, $peso_vacio, $velocidad_crucero, $carrera, $autonomia, $combustible, $alcance, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Submodelo_avion SET as_nombre='".$nombre."', as_peso_maximo_despegue=".$peso_max.", as_peso_vacio=".$peso_vacio.", as_velocidad_crucero=".$velocidad_crucero.", as_carrera_despegue_peso_maximo=".$carrera.", as_autonomia_peso_maximo_despegue= ".$autonomia.", as_capacidad_combustible=".$combustible.", as_alcance_carga_maxima=".$alcance.", as_modelo_avion=".$modelo." WHERE as_id=".$id;
		return pg_query($conexion, $qry);
	}
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
	function insertarAvion( $factura, $distribucion, $submodelo, $precio ){
		global $conexion;
		$qry = "INSERT INTO Avion (a_factura_venta, a_distribucion, a_submodelo_avion, a_precio, a_fecha_ini) VALUES (".$factura.", ".$distribucion.", ".$submodelo.", ".$precio.", transaction_timestamp())";
		return pg_query($conexion, $qry);
	}
//Status_avion
//Motor
	function eliminarMotor( $id ){
		global $conexion;
		$qry4 = "DELETE FROM Motor where mo_id=".$id;
		$qry5 = "DELETE FROM Status_motor stm_motor=".$id;
		if(pg_query($conexion, $qry5)){
			return pg_query($conexion, $qry4);
		}
		return 0;
	}
//Status_motor
//Pieza
//Status_pieza
//Material
//Prueba_material
//Status_material
//Prueba_pieza
//Traslado
?>
