<?php  include 'conexion.php';
//Querys de Modelo_avion
	function insertarModeloAvion( $nombre, $longitud, $envergadura, $altura, $superficie_alar, $flecha_alar, $peso_max, $alcance, $velocidad_max, $techo_servicio, $regimen_ascenso, $numero_pasillos, $fuselaje_tipo, $fuselaje_altura, $fuselaje_ancho, $cabina_altura, $cabina_ancho, $volumen_carga, $capacidad_pilotos, $capacidad_asistentes, $carrera_despegue, $tiempo_estimado ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$longitud = htmlentities($longitud, ENT_QUOTES);
		$envergadura = htmlentities($envergadura, ENT_QUOTES);
		$altura = htmlentities($altura, ENT_QUOTES);
		$superficie_alar = htmlentities($superficie_alar, ENT_QUOTES);
		$flecha_alar = htmlentities($flecha_alar, ENT_QUOTES);
		$peso_max = htmlentities($peso_max, ENT_QUOTES);
		$alcance = htmlentities($alcance, ENT_QUOTES);
		$velocidad_max = htmlentities($velocidad_max, ENT_QUOTES);
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
		$id = htmlentities($id, ENT_QUOTES);
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
//Querys de Submodelo_avion
	function insertarSubmodeloAvion( $nombre, $peso_max, $peso_vacio, $velocidad_crucero, $carrera, $autonomia, $combustible, $alcance, $modelo, $motores ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Submodelo_avion (as_nombre, as_peso_maximo_despegue, as_peso_vacio, as_velocidad_crucero, as_carrera_despegue_peso_maximo, as_autonomia_peso_maximo_despegue, as_capacidad_combustible, as_alcance_carga_maxima, as_modelo_avion, as_cantidad_motor, as_fecha_creacion) VALUES('".$nombre."', ".$peso_max.", ".$peso_vacio.", ".$velocidad_crucero.", ".$carrera.", ".$autonomia.", ".$combustible.", ".$alcance.", ".$modelo.", ".$motores.", transaction_timestamp())";
		return pg_query($conexion, $qry);
	}
	function editarSubmodeloAvion( $id, $nombre, $peso_max, $peso_vacio, $velocidad_crucero, $carrera, $autonomia, $combustible, $alcance, $modelo, $motores ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Submodelo_avion SET as_nombre='".$nombre."', as_peso_maximo_despegue=".$peso_max.", as_peso_vacio=".$peso_vacio.", as_velocidad_crucero=".$velocidad_crucero.", as_carrera_despegue_peso_maximo=".$carrera.", as_autonomia_peso_maximo_despegue= ".$autonomia.", as_capacidad_combustible=".$combustible.", as_alcance_carga_maxima=".$alcance.", as_modelo_avion=".$modelo.", as_cantidad_motor=".$motores." WHERE as_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarSubmodeloAvion($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Submodelo_avion where as_id=".$id;
		$qry2 = "DELETE FROM S_avion_m_motor where smt_submodelo_avion=".$id;
		$qry3 = "DELETE FROM S_avion_m_pieza where smp_submodelo_avion=".$id;
		$qry4 = "DELETE FROM Avion where a_submodelo_avion=".$id;
		$qry5 = "DELETE FROM Status_avion where sa_avion in (Select a_id from Avion where a_submodelo_avion=".$id.")";
		$qry6 = "DELETE FROM Motor where mo_avion in (Select a_id from Avion where a_submodelo_avion=".$id.")";
		$qry7 = "DELETE FROM Status_motor where stm_motor in (Select mo_id from Motor, Avion where mo_avion=a_id and a_submodelo_avion=".$id.")";
		$qry8 = "DELETE FROM Pieza where p_avion in (Select a_id from Avion where a_submodelo_avion=".$id.")";
		$qry9 = "DELETE FROM Status_pieza where spi_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry10 = "DELETE FROM Material where m_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry11 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Material, Pieza, Avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry12 = "DELETE FROM Status_material where sm_material in (Select m_id from Material, Pieza, Avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry13 = "DELETE FROM Traslado where tr_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry14 = "DELETE FROM Traslado where tr_material in (Select m_id from Material, Pieza, Avion where m_pieza=p_id and p_avion=a_id and a_submodelo_avion=".$id.")";
		$qry15 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_submodelo_avion=".$id.")";
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
//Querys de Distribucion
	function insertarDistribucion( $nombre, $capacidad_pasajeros, $numero_clases, $distancia_asientos, $ancho_asientos, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Distribucion (di_nombre, di_numero_clases, di_capacidad_pasajeros, di_distancia_asientos, di_ancho_asientos, di_modelo_avion) VALUES('".$nombre."', ".$numero_clases.", ".$capacidad_pasajeros.", ".$distancia_asientos.", ".$ancho_asientos.", ".$modelo.")";
		return pg_query($conexion, $qry);
	}
	function editarDistribucion( $id, $nombre, $capacidad_pasajeros, $numero_clases, $distancia_asientos, $ancho_asientos, $modelo ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Distribucion	 SET di_nombre='".$nombre."', di_numero_clases=".$numero_clases.", di_capacidad_pasajeros=".$capacidad_pasajeros.", di_distancia_asientos=".$distancia_asientos.", di_ancho_asientos=".$ancho_asientos.", di_modelo_avion=".$modelo." WHERE di_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarDistribucion($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Distribucion where di_id=".$id;
		$qry2 = "DELETE FROM Avion where a_distribucion=".$id;
		$qry3 = "DELETE FROM Motor where mo_avion in (Select a_id from Avion where a_distribucion=".$id.")";
		$qry4 = "DELETE FROM Status_motor where stm_motor in (Select mo_id from Motor, Avion where mo_avion=a_id and a_distribucion=".$id.")";
		$qry5 = "DELETE FROM Status_avion where sa_avion in (Select a_id from Avion where a_distribucion=".$id.")";
		$qry6 = "DELETE FROM Pieza where p_avion in (Select a_id from Avion where a_distribucion=".$id.")";
		$qry7 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_distribucion=".$id.")";
		$qry8 = "DELETE FROM Status_pieza where spi_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_distribucion=".$id.")";
		$qry9 = "DELETE FROM Material where m_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_distribucion=".$id.")";
		$qry10 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Material, Pieza, Avion where m_pieza=p_id and p_avion=a_id and a_distribucion=".$id.")";
		$qry11 = "DELETE FROM Traslado where tr_material in (Select m_id from Material, Pieza, Avion where m_pieza=p_id and p_avion=a_id and a_distribucion=".$id.")";
		$qry12 = "DELETE FROM Traslado where tr_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_distribucion=".$id.")";
		$qry13 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion where p_avion=a_id and a_distribucion=".$id.")";
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
		$qry = "UPDATE Empleado SET em_nacionalidad='".$nacionalidad."', em_ci=".$ci.", em_nombre='".$nombre."', em_apellido='".$apellido."', em_usuario=UPPER('".$usuario."'), em_titulacion=".$titulacion.", em_cargo=".$cargo.", em_rol=".$rol.", em_zona=".$zona.", em_direccion=".$direccion.", em_supervisa=".$supervisa.", em_gerencia=".$gerencia.", em_nota=".$nota." WHERE em_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarEmpleado( $id ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Empleado WHERE em_id=".$id;
		$qry2 = "DELETE FROM Experiencia WHERE ex_empleado=".$id;
		$qry3 = "DELETE FROM Beneficiario WHERE be_empleado=".$id;
		$qry4 = "DELETE FROM Contacto WHERE co_empleado=".$id;
		$qry5 = "DELETE FROM Prueba WHERE pr_empleado=".$id;
		$qry6 = "DELETE FROM Prueba_pieza WHERE pp_prueba IN (SELECT pr_id FROM Prueba WHERE pr_empleado=".$id.")";
		$qry7 = "DELETE FROM Status_prueba WHERE sp_prueba IN (SELECT pr_id FROM Prueba WHERE pr_empleado=".$id.")";
		$qry8 = "DELETE FROM Prueba_material WHERE prm_prueba IN (SELECT pr_id FROM Prueba WHERE pr_empleado=".$id.")";
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
//Querys de Contacto
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
		$id = htmlentities($id, ENT_QUOTES);
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
		$id = htmlentities($id, ENT_QUOTES);
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
		$id = htmlentities($id, ENT_QUOTES);
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Rol_sistema WHERE sr_id=".$id;
		$qry2 = "DELETE FROM Rol_permiso WHERE rp_rol=".$id;
		$qry3 = "UPDATE Empleado SET em_rol=2 WHERE em_rol=".$id;
		if(pg_query($conexion, $qry3))
			if(pg_query($conexion, $qry2))
				return pg_query($conexion, $qry);
		return false;
	}
//Querys de Cargo
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Cargo where er_id=".$id;
		$qry2 = "UPDATE Empleado SET em_cargo=1 WHERE em_cargo=".$id;
			if(pg_query($conexion, $qry2))
				return pg_query($conexion, $qry);
	}
//Querys de Titulacion
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Titulacion where ti_id=".$id;
		$qry2 = "UPDATE Empleado SET em_titulacion=1 WHERE em_titulacion=".$id;
			if(pg_query($conexion, $qry2))
				return pg_query($conexion, $qry);
	}
//Querys de Rol - permiso
	function insertarRolPermiso( $rol, $permiso ){
		global $conexion;
		$qry = "INSERT INTO Rol_permiso (rp_rol,rp_permiso) VALUES (".$rol.",".$permiso.")";
		return pg_query($conexion, $qry);
	}
	function eliminarRolPermiso( $rol, $permiso ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Rol_permiso WHERE rp_rol=".$rol." AND rp_permiso=".$permiso;
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Status WHERE st_id=".$id;
		$qry2 = "DELETE FROM Status_pieza WHERE spi_status=".$id;
		$qry3 = "DELETE FROM Status_material WHERE sm_status=".$id;
		$qry4 = "DELETE FROM Prueba_material WHERE prm_status=".$id;
		$qry5 = "DELETE FROM Status_prueba WHERE sp_status=".$id;
		$qry6 = "DELETE FROM Status_avion WHERE sa_status=".$id;
		$qry7 = "DELETE FROM Prueba_pieza WHERE pp_status=".$id;
		$qry8 = "DELETE FROM Status_motor WHERE stm_status=".$id;
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
		$id = htmlentities($id, ENT_QUOTES);
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
	function eliminarSede($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Sede WHERE se_id=".$id;
		$qry2 = "DELETE FROM Zona WHERE zo_sede=".$id;
		$qry3 = "DELETE FROM Traslado WHERE tr_zona_envia IN (SELECT zo_id FROM Zona WHERE zo_sede=".$id.")";
		$qry4 = "DELETE FROM Traslado WHERE tr_zona_recibe IN (SELECT zo_id FROM Zona WHERE zo_sede=".$id.")";
		$qry5 = "DELETE FROM Empleado WHERE em_zona IN (SELECT zo_id FROM Zona WHERE zo_sede=".$id.")";		   
		$qry6 = "DELETE FROM Contacto WHERE co_empleado IN (SELECT em_id FROM Empleado, Zona WHERE em_zona=zo_id AND zo_sede=".$id.")";
		$qry7 = "DELETE FROM Experiencia WHERE ex_empleado IN (SELECT em_id FROM Empleado, Zona WHERE em_zona=zo_id AND zo_sede=".$id.")";
		$qry8 = "DELETE FROM Beneficiario WHERE be_empleado IN (SELECT em_id FROM Empleado, Zona WHERE em_zona=zo_id AND zo_sede=".$id.")";
		$qry9 = "DELETE FROM Prueba WHERE pr_zona IN (SELECT zo_id FROM Zona WHERE zo_sede=".$id.")";
		$qry10 = "DELETE FROM Status_prueba WHERE sp_prueba IN (SELECT pr_id FROM Prueba, Zona WHERE pr_zona=zo_id AND zo_sede=".$id.")";
		$qry11 = "DELETE FROM Prueba_pieza WHERE pp_prueba IN (SELECT pr_id FROM Prueba, Zona WHERE pr_zona=zo_id AND zo_sede=".$id.")";
		$qry12 = "DELETE FROM Prueba_material WHERE prm_prueba IN (SELECT pr_id FROM Prueba, Zona WHERE pr_zona=zo_id AND zo_sede=".$id.")";
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Zona WHERE zo_id=".$id;
		$qry2 = "DELETE FROM Traslado WHERE tr_zona_envia=".$id;
		$qry3 = "DELETE FROM Traslado WHERE tr_zona_recibe=".$id;
		$qry4 = "DELETE FROM Empleado WHERE em_zona=".$id;
		$qry5 = "DELETE FROM Contacto WHERE co_empleado IN (SELECT em_id FROM Empleado WHERE em_zona=".$id.")";
		$qry6 = "DELETE FROM Experiencia WHERE ex_empleado IN (SELECT em_id FROM Empleado WHERE em_zona=".$id.")";
		$qry7 = "DELETE FROM Beneficiario WHERE be_empleado IN (SELECT em_id FROM Empleado WHERE em_zona=".$id.")";
		$qry8 = "DELETE FROM Prueba WHERE pr_zona=".$id;
		$qry9 = "DELETE FROM Status_prueba WHERE sp_prueba IN (SELECT pr_id FROM Prueba WHERE pr_zona=".$id.")";
		$qry10 = "DELETE FROM Prueba_pieza WHERE pp_prueba IN (SELECT pr_id FROM Prueba WHERE pr_zona=".$id.")";
		$qry11 = "DELETE FROM Prueba_material WHERE prm_prueba IN (SELECT pr_id FROM Prueba WHERE pr_zona=".$id.")";
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
//Querys de Cliente
	function insertarCliente ( $trif, $rif, $nombre, $pweb, $lugar ){
		global $conexion;
		$trif = htmlentities($trif, ENT_QUOTES);
		$rif = htmlentities($rif, ENT_QUOTES);
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$lugar = htmlentities($lugar, ENT_QUOTES);
		$qry = "INSERT INTO Cliente (cl_tipo_rif, cl_rif, cl_nombre, cl_pagina_web, cl_fecha_inicio, cl_direccion) VALUES ('".$trif."', ".$rif.", '".$nombre."', '".$pweb."', transaction_timestamp(),".$lugar." )";
		return pg_query($conexion, $qry);
	}
	function editarCliente ( $id, $trif, $rif, $nombre, $pweb, $lugar ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$trif = htmlentities($trif, ENT_QUOTES);
		$rif = htmlentities($rif, ENT_QUOTES);
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$lugar = htmlentities($lugar, ENT_QUOTES);
		$qry = "UPDATE Cliente SET cl_tipo_rif='".$trif."', cl_rif=".$rif.", cl_nombre='".$nombre."', cl_pagina_web='".$pweb."', cl_direccion=".$lugar." WHERE cl_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarCliente($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
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
		return false;
	}
//Factura_venta
	function insertarFacturaVenta( $cliente ){
		global $conexion;
		$qry = "INSERT INTO Factura_venta (fv_cliente,fv_fecha) VALUES (".$cliente.",transaction_timestamp())";
		return ( pg_query( $conexion, $qry ) );
	}
	function eliminarFacturaVenta($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Factura_venta WHERE fv_id=".$id;
		$qry2 = "DELETE FROM Pago WHERE pa_factura_venta=".$id;
		$qry3 = "DELETE FROM Avion WHERE a_factura_venta=".$id;
		$qry4 = "DELETE FROM Status_avion WHERE sa_avion IN (SELECT a_id FROM Avion WHERE  a_factura_venta=".$id.")";
		$qry5 = "DELETE FROM Motor WHERE mo_avion IN (SELECT a_id FROM Avion WHERE a_factura_venta=".$id.")";
		$qry6 = "DELETE FROM Status_motor WHERE stm_motor IN (SELECT mo_id FROM Motor WHERE	 a_factura_venta=".$id.")";
		$qry7 = "DELETE FROM Pieza where p_avion in (Select a_id from Avion, Factura_venta where a_factura_venta=fv_id and fv_id=".$id.")";
		$qry8 = "DELETE FROM Prueba_pieza where pp_pieza in (Select p_id from Pieza, Avion, Factura_venta where p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry9 = "DELETE FROM Status_pieza where spi_pieza in (Select p_id from Pieza, Avion, Factura_venta where p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry10 = "DELETE FROM Material where m_pieza in (Select p_id from Pieza, Avion, Factura_venta where p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry11 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry12 = "DELETE FROM Traslado where tr_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry13 = "DELETE FROM Traslado where tr_pieza in (Select p_id from Pieza, Avion, Factura_venta where p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
		$qry14 = "DELETE FROM Status_material where sm_material in (Select m_id from Material, Pieza, Avion, Distribucion where m_pieza=p_id and p_avion=a_id and a_factura_venta=fv_id and fv_id=".$id.")";
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
//Proveedor
	function insertarProveedor ( $trif, $rif, $nombre, $pweb, $lugar ){
		global $conexion;
		$trif = htmlentities($trif, ENT_QUOTES);
		$rif = htmlentities($rif, ENT_QUOTES);
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$lugar = htmlentities($lugar, ENT_QUOTES);
		$qry = "INSERT INTO Proveedor (po_tipo_rif, po_rif, po_nombre, po_pagina_web, po_fecha_ini, po_direccion) VALUES ('".$trif."', ".$rif.", '".$nombre."', '".$pweb."', transaction_timestamp(),".$lugar." )";
		return pg_query($conexion, $qry);
	}
	function editarProveedor ( $id, $trif, $rif, $nombre, $pweb, $lugar ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$trif = htmlentities($trif, ENT_QUOTES);
		$rif = htmlentities($rif, ENT_QUOTES);
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$lugar = htmlentities($lugar, ENT_QUOTES);
		$qry = "UPDATE Proveedor SET po_tipo_rif='".$trif."', po_rif=".$rif.", po_nombre='".$nombre."', po_pagina_web='".$pweb."', po_direccion=".$lugar." WHERE po_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarProveedor( $id ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Proveedor WHERE po_id=".$id;
		$qry2 = "DELETE FROM Contacto WHERE co_proveedor=".$id;
		$qry3 = "DELETE FROM Factura_compra WHERE fc_proveedor=".$id;
		$qry4 = "DELETE FROM Pago WHERE pa_factura_compra IN (SELECT fc_id FROM Factura_compra WHERE fc_proveedor=".$id.")";
		$qry5 = "DELETE FROM Material WHERE m_factura_compra IN (SELECT fc_id FROM Factura_compra WHERE fc_proveedor=".$id.")";
		$qry6 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Material,Factura_compra WHERE m_factura_compra=fc_id AND fc_proveedor=".$id.")";
		$qry7 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Material,Factura_compra WHERE m_factura_compra=fc_id AND fc_proveedor=".$id.")";
		$qry8 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Material,Factura_compra WHERE m_factura_compra=fc_id AND fc_proveedor=".$id.")";
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Tipo_contacto WHERE ct_id=".$id;
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
	function eliminarMarcaMotor($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Marca_motor WHERE mb_id=".$id;
		$qry2 = "DELETE FROM Modelo_motor WHERE mm_marca=".$id;
		$qry3 = "DELETE FROM S_avion_m_motor WHERE smt_modelo_motor IN (SELECT mm_id FROM Modelo_motor WHERE mm_marca=".$id.")";
		$qry4 = "DELETE FROM Motor WHERE mo_modelo_motor IN (SELECT mm_id FROM Modelo_motor WHERE mm_marca=".$id.")";
		$qry5 = "DELETE FROM Status_motor WHERE stm_motor IN (SELECT mo_id FROM Motor, Modelo_motor WHERE mo_modelo_motor=mm_id AND mm_marca=".$id.")";
		if(pg_query($conexion, $qyr5))
			if(pg_query($conexion, $qyr4))
				if(pg_query($conexion, $qyr3))
					if(pg_query($conexion, $qyr2))
						return pg_query($conexion, $qyr);
		return false;
	}
//Modelo_motor
	function eliminarModeloMotor($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Modelo_motor WHERE mm_id=".$id;
		$qry2 = "DELETE FROM S_avion_m_motor WHERE smt_modelo_motor=".$id;
		$qry3 = "DELETE FROM Motor WHERE mo_modelo_motor=".$id;
		$qry4 = "DELETE FROM Status_motor WHERE stm_motor IN (SELECT mo_id FROM Motor WHERE mo_modelo_motor=".$id.")";
		if(pg_query($conexion, $qyr4))
			if(pg_query($conexion, $qyr3))
				if(pg_query($conexion, $qyr2))
					return pg_query($conexion, $qyr);
		return false;
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
		$id = htmlentities($id, ENT_QUOTES);
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
	function eliminarTipoAla($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry ="DELETE FROM Tipo_Ala WHERE wt_id=".$id;
		$qry2 ="DELETE FROM Modelo_pieza WHERE pm_tipo_ala=".$id;		 
		$qry3 = "DELETE FROM S_avion_m_pieza WHERE smp_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_ala=".$id.")";
		$qry4 = "DELETE FROM T_material_m_pieza WHERE tmm_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_ala=".$id.")";
		$qry5 = "DELETE FROM Pieza WHERE p_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_ala=".$id.")";
		$qry6 = "DELETE FROM Prueba_pieza WHERE pp_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry7 = "DELETE FROM Traslado WHERE tr_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry8 = "DELETE FROM Status_pieza WHERE spi_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry9 = "DELETE FROM Material WHERE m_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry10 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry11 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
		$qry12 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_ala=".$id.")";
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
	function eliminarTipoEstabilizador($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry ="DELETE FROM Tipo_estabilizador WHERE wt_id=".$id;
		$qry2 ="DELETE FROM Modelo_pieza WHERE pm_tipo_estabilizador=".$id;		   
		$qry3 = "DELETE FROM S_avion_m_pieza WHERE smp_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_estabilizador=".$id.")";
		$qry4 = "DELETE FROM T_material_m_pieza WHERE tmm_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_estabilizador=".$id.")";
		$qry5 = "DELETE FROM Pieza WHERE p_modelo_pieza IN (SELECT pm_id FROM Modelo_pieza WHERE pm_tipo_estabilizador=".$id.")";
		$qry6 = "DELETE FROM Prueba_pieza WHERE pp_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry7 = "DELETE FROM Traslado WHERE tr_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry8 = "DELETE FROM Status_pieza WHERE spi_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry9 = "DELETE FROM Material WHERE m_pieza IN (SELECT p_id FROM Pieza, Modelo_pieza WHERE p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry10 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry11 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
		$qry12 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Pieza, Material, Modelo_Pieza WHERE m_pieza=p_id AND p_modelo_pieza=pm_id AND pm_tipo_estabilizador=".$id.")";
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
//Modelo_pieza
	function eliminarModeloPieza($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Modelo_pieza WHERE pm_id=".$id;
		$qry2 = "DELETE FROM Modelo_pieza WHERE pm_modelo_pieza=".$id;
		$qry3 = "DELETE FROM S_avion_m_pieza WHERE smp_modelo_pieza=".$id;
		$qry4 = "DELETE FROM T_material_m_pieza WHERE tmm_modelo_pieza=".$id;
		$qry5 = "DELETE FROM Pieza WHERE p_modelo_pieza=".$id;
		$qry6 = "DELETE FROM Prueba_pieza WHERE pp_pieza IN (SELECT p_id FROM Pieza WHERE p_modelo_pieza=".$id.")";
		$qry7 = "DELETE FROM Traslado WHERE tr_pieza IN (SELECT p_id FROM Pieza WHERE p_modelo_pieza=".$id.")";
		$qry8 = "DELETE FROM Status_pieza WHERE spi_pieza IN (SELECT p_id FROM Pieza WHERE p_modelo_pieza=".$id.")";
		$qry9 = "DELETE FROM Material WHERE m_pieza IN (SELECT p_id FROM Pieza WHERE p_modelo_pieza=".$id.")";
		$qry10 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Pieza, Material WHERE m_pieza=p_id AND p_modelo_pieza=".$id.")";
		$qry11 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Pieza, Material WHERE m_pieza=p_id AND p_modelo_pieza=".$id.")";
		$qry12 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Pieza, Material WHERE m_pieza=p_id AND p_modelo_pieza=".$id.")";
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
		$id = htmlentities($id, ENT_QUOTES);
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
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Prueba WHERE pr_id=".$id;
		$qry2 = "DELETE FROM Prueba_pieza WHERE pp_prueba=".$id;
		$qry3 = "DELETE FROM Status_prueba WHERE sp_prueba=".$id;
		$qry4 = "DELETE FROM Prueba_material WHERE prm_prueba=".$id;
		if(pg_query($conexion, $qry4))
			if(pg_query($conexion, $qry3))
				if(pg_query($conexion, $qry2))
					return pg_query($conexion, $qry);
		return false;
	}
//Status_prueba
//Factura_compra
	function eliminarFacturaCompra($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Factura_compra WHERE fc_id=".$id;
		$qry2 = "DELETE FROM Pago WHERE pa_factura_compra=".$id;
		$qry3 = "DELETE FROM Material WHERE m_factura_compra=".$id;
		$qry4 = "DELETE FROM Prueba_material where prm_material in (Select m_id from Material where m_factura_compra=".$id.")";
		$qry5 = "DELETE FROM Traslado where tr_material in (Select m_id from Material where m_factura_compra=".$id.")";
		$qry6 = "DELETE FROM Status_material where sm_material in (Select m_id from Material where m_factura_compra=".$id.")";
		if(pg_query($conexion, $qry6))
			if(pg_query($conexion, $qry5))
				if(pg_query($conexion, $qry4))
					if(pg_query($conexion, $qry3))
						if(pg_query($conexion, $qry2))
							return pg_query($conexion, $qry);
		return false;
	}
//Tipo_pago
	function insertarTipoPago( $numero, $nombre, $cod, $fecha ){
		global $conexion;
		$numero = htmlentities($numero, ENT_QUOTES);
		if($nombre != 'NULL') $nombre = "'".htmlentities($nombre, ENT_QUOTES)."'";
		$cod = htmlentities($cod, ENT_QUOTES);
		if($fecha != 'NULL') $fecha = "'".htmlentities($fecha, ENT_QUOTES)."'";
		$qry = "INSERT INTO Tipo_pago (pt_numero, pt_tc_nombre, pt_tc_cod, pt_tc_fecha) VALUES (".$numero.", ".$nombre.", ".$cod.", ".$fecha.")";
		return pg_query($conexion, $qry);
	}
	function editarTipoPago( $id, $numero, $nombre, $cod, $fecha ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$numero = htmlentities($numero, ENT_QUOTES);
		if($nombre != 'NULL') $nombre = "'".htmlentities($nombre, ENT_QUOTES)."'";
		$cod = htmlentities($cod, ENT_QUOTES);
		$fecha = htmlentities($fecha, ENT_QUOTES);
		$qry = "UPDATE Tipo_pago SET pt_numero=".$numero.", pt_tc_nombre=".$nombre.", pt_tc_cod=".$cod.", pt_tc_fecha=".$fecha." WHERE pt_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTipoPago($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Tipo_pago WHERE pt_id=".$id;
		$qry2 = "DELETE FROM Pago WHERE pa_tipo_pago=".$id;
		if(pg_query($conexion, $qyr2))
			return pg_query($conexion, $qyr);
		return false;
	}
//Pago
	function insertarPago( $monto, $tipo_pago, $factura_venta, $factura_compra ){
		global $conexion;
		$monto = htmlentities($monto, ENT_QUOTES);
		$qry = "INSERT INTO Pago (pa_monto, pa_fecha, pa_tipo_pago, pa_factura_venta, pa_factura_compra) VALUES (".$monto.", transaction_timestamp(),".$tipo_pago.", ".$factura_venta.", ".$factura_compra.")";
		return pg_query($conexion, $qry);
	}
	function editarPago( $id, $monto ){
		global $conexion;
		$qry = "UPDATE Pago SET pa_monto='".$monto."' WHERE pa_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarPago($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Pago WHERE pa_id=".$id;
		return pg_query($conexion, $qyr);
	}
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
	function eliminarTipoMaterial($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry ="DELETE FROM Tipo_material WHERE tm_id=".$id;
		$qry2 ="DELETE FROM T_material_m_pieza WHERE tmm_tipo_material=".$id;
		$qry3 ="DELETE FROM Material WHERE m_tipo_material=".$id;
		$qry4 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Material WHERE m_tipo_material=".$id.")";
		$qry5 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Material WHERE m_tipo_material=".$id.")";
		$qry6 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Material WHERE m_tipo_material=".$id.")";
		if(pg_query($conexion, $qry6))
			if(pg_query($conexion, $qry5))
				if(pg_query($conexion, $qry4))
					if(pg_query($conexion, $qry3))
						if(pg_query($conexion, $qry2))
							return pg_query($conexion, $qry);
		return false;
	}
//T_material_m_pieza
//Avion
	function insertarAvion( $factura, $distribucion, $submodelo, $precio ){
		global $conexion;
		$qry = "INSERT INTO Avion (a_factura_venta, a_distribucion, a_submodelo_avion, a_precio, a_fecha_ini) VALUES (".$factura.", ".$distribucion.", ".$submodelo.", ".$precio.", transaction_timestamp())";
		return pg_query($conexion, $qry);
	}
	function eliminarAvion($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Avion WHERE a_id=".$id;
		$qry2 = "DELETE FROM Status_avion WHERE sa_avion=".$id;
		$qry3 = "DELETE FROM Motor WHERE mo_avion=".$id;
		$qry4 = "DELETE FROM Status_motor WHERE stm_motor IN (SELECT mo_id FROM Motor WHERE mo_avion=".$id.")";
		$qry5 = "DELETE FROM Pieza WHERE p_avion=".$id;
		$qry6 = "DELETE FROM Prueba_pieza WHERE pp_pieza IN (SELECT p_id FROM Pieza WHERE p_avion=".$id.")";
		$qry7 = "DELETE FROM Status_pieza WHERE spi_pieza IN (SELECT p_id FROM Pieza WHERE p_avion=".$id.")";
		$qry8 = "DELETE FROM Traslado WHERE tr_pieza IN (SELECT p_id FROM Pieza WHERE p_avion=".$id.")";
		$qry9 = "DELETE FROM Material WHERE m_pieza IN (SELECT p_id FROM Pieza WHERE p_avion=".$id.")";
		$qry10 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Material, Pieza WHERE m_pieza=p_id AND p_avion=".$id.")";
		$qry11 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Material, Pieza WHERE m_pieza=p_id AND p_avion=".$id.")";
		$qry12 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Material, Pieza WHERE m_pieza=p_id AND p_avion=".$id.")";
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
//Status_avion
	function insertarStatusAvion( $status, $avion ){
		global $conexion;
		$qry = "SELECT Max(sa_id) AS id From Status_avion WHERE sa_avion=".$avion;
		$answer = pg_query( $conexion, $qry );
		$sa = pg_fetch_object($answer);
		if(!is_null($sa->id)){
			$qry = "UPDATE Status_avion SET sa_fecha_fin=transaction_timestamp() WHERE sa_id=".$sa->id;
			pg_query( $conexion, $qry );
		}
		$qry = "INSERT INTO Status_avion (sa_fecha_ini,sa_status,sa_avion) VALUES (transaction_timestamp(),".$status.",".$avion.")";
		return pg_query($conexion, $qry);
	}
//Motor
	function insertarMotor( $motor, $avion ){
		global $conexion;
		$motor = htmlentities($motor, ENT_QUOTES);
		$avion = htmlentities($avion, ENT_QUOTES);
		$qry = "INSERT INTO Motor (mo_fecha_ini,mo_modelo_motor,mo_avion) VALUES (transaction_timestamp(),".$motor.",".$avion.")";
		return pg_query($conexion, $qry);
	}
	function eliminarMotor($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Motor WHERE mo_id=".$id;
		$qry2 = "DELETE FROM Status_motor WHERE stm_motor=".$id;
		if(pg_query($conexion, $qry2))
			return pg_query($conexion, $qry);
		return false;
	}
//Status_motor
	function insertarStatusMotor( $status, $motor ){
		global $conexion;
		$status = htmlentities($status, ENT_QUOTES);
		$motor = htmlentities($motor, ENT_QUOTES);
		$qry = "SELECT Max(stm_id) AS id From Status_motor WHERE stm_motor=".$motor;
		$answer = pg_query( $conexion, $qry );
		$sm = pg_fetch_object($answer);
		if(!is_null($sm->id)){
			$qry = "UPDATE Status_motor SET stm_fecha_fin=transaction_timestamp() WHERE stm_id=".$sm->id;
			pg_query( $conexion, $qry );
		}
		$qry = "INSERT INTO Status_motor (stm_fecha_ini,stm_status,stm_motor) VALUES (transaction_timestamp(),".$status.",".$motor.")";
		return pg_query($conexion, $qry);
	}
//Pieza
	function insertarPieza( $pieza, $avion ){
		global $conexion;
		$pieza = htmlentities($pieza, ENT_QUOTES);
		$avion = htmlentities($avion, ENT_QUOTES);
		$qry = "INSERT INTO Pieza (p_fecha_ini,p_modelo_pieza,p_avion) VALUES (transaction_timestamp(),".$pieza.",".$avion.")";
		return pg_query($conexion, $qry);
	}
	function eliminarPieza($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Pieza WHERE p_id".$id;
		$qry2 = "DELETE FROM Prueba_pieza WHERE pp_pieza".$id;
		$qry3 = "DELETE FROM Traslado WHERE tr_pieza".$id;
		$qry4 = "DELETE FROM Status_pieza WHERE spi_pieza".$id;
		$qry5 = "DELETE FROM Material WHERE m_pieza".$id;
		$qry6 = "DELETE FROM Status_material WHERE sm_material IN (SELECT m_id FROM Material WHERE m_pieza=".$id.")";
		$qry7 = "DELETE FROM Prueba_material WHERE prm_material IN (SELECT m_id FROM Material WHERE m_pieza=".$id.")";
		$qry8 = "DELETE FROM Traslado WHERE tr_material IN (SELECT m_id FROM Material WHERE m_pieza=".$id.")";
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
//Status_pieza
	function insertarStatusPieza( $status, $pieza ){
		global $conexion;
		$status = htmlentities($status, ENT_QUOTES);
		$pieza = htmlentities($pieza, ENT_QUOTES);
		$qry = "SELECT Max(spi_id) AS id From Status_pieza WHERE spi_pieza=".$pieza;
		$answer = pg_query( $conexion, $qry );
		$sp = pg_fetch_object($answer);
		if(!is_null($sp->id)){
			$qry = "UPDATE Status_pieza SET spi_fecha_fin=transaction_timestamp() WHERE spi_id=".$sp->id;
			pg_query( $conexion, $qry );
		}
		$qry = "INSERT INTO Status_pieza (spi_fecha_ini,spi_status,spi_pieza) VALUES (transaction_timestamp(),".$status.",".$pieza.")";
		return pg_query($conexion, $qry);
	}
//Material
	function insertarMaterial( $tipo_material, $factura_compra, $pieza, $precio ){
		global $conexion;
		$tipo_material = htmlentities($tipo_material, ENT_QUOTES);
		$factura_compra = htmlentities($factura_compra, ENT_QUOTES);
		$pieza = htmlentities($pieza, ENT_QUOTES);
		$precio = htmlentities($precio, ENT_QUOTES);
		$qry = "INSERT INTO Material (m_fecha,m_tipo_material,m_factura_compra,m_pieza,m_precio) VALUES (transaction_timestamp(), ".$tipo_material.", ".$factura_compra.", ".$pieza.", ".$precio.")";
		return pg_query($conexion, $qry);
	}
	function editarMaterial( $id, $pieza, $precio ){
		global $conexion;
		$pieza = htmlentities($pieza, ENT_QUOTES);
		$precio = htmlentities($precio, ENT_QUOTES);
		$qry = "UPDATE Material SET m_pieza =".$pieza.", m_precio=".$precio." WHERE m_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarMaterial( $id ){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Material WHERE m_id=".$id;
		$qry2 = "DELETE FROM Status_material WHERE sm_material=".$id;
		$qry3 = "DELETE FROM Prueba_material WHERE prm_material=".$id;
		$qry4 = "DELETE FROM Traslado WHERE tr_material=".$id;
		if(pg_query($conexion, $qry4))
			if(pg_query($conexion, $qry3))
				if(pg_query($conexion, $qry2))
					return pg_query($conexion, $qry);
		return false;
	}
//Prueba_material
//Status_material
	function insertarStatusMaterial( $status, $material ){
		global $conexion;
		$status = htmlentities($status, ENT_QUOTES);
		$material = htmlentities($material, ENT_QUOTES);
		$qry = "SELECT Max(sm_id) AS id FROM Status_material WHERE sm_material=".$material;
		$answer = pg_query( $conexion, $qry );
		$sm = pg_fetch_object($answer);
		if(!is_null($sm->id)){
			$qry = "UPDATE Status_material SET sm_fecha_fin=transaction_timestamp() WHERE sm_id=".$sm->id;
			pg_query( $conexion, $qry );
		}
		$qry = "INSERT INTO Status_material (sm_fecha_ini,sm_status,sm_material) VALUES (transaction_timestamp(), ".$status.", ".$material.")";
		return pg_query($conexion, $qry);
	}
//Prueba_pieza
//Traslado
	function insertarTraslado($envia, $recibe, $pieza, $material, $motor){
		global $conexion;
		$envia = htmlentities($envia, ENT_QUOTES);
		$recibe = htmlentities($recibe, ENT_QUOTES);
		$pieza = htmlentities($pieza, ENT_QUOTES);
		$material = htmlentities($material, ENT_QUOTES);
		$motor = htmlentities($motor, ENT_QUOTES);
		$qry = "INSERT INTO Traslado (tr_fecha_ini, tr_confirmacion, tr_zona_envia, tr_zona_recibe, tr_pieza, tr_material, tr_motor) VALUES (transaction_timestamp(), false, ".$envia.", ".$recibe.", ".$pieza.", ".$material.", ".$motor.")";
		return pg_query($conexion, $qry);
	}
	function editarTraslado($id, $confirmacion){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$confirmacion = htmlentities($confirmacion, ENT_QUOTES);
		$qry = "UPDATE Traslado SET tr_fecha_fin=transaction_timestamp(), tr_confirmacion=".$confirmacion." WHERE tr_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarTraslado($id){
		global $conexion;
		$id = htmlentities($id, ENT_QUOTES);
		$qry = "DELETE FROM Traslado WHERE tr_id=".$id;
		return pg_query($conexion, $qry);
	}
?>
