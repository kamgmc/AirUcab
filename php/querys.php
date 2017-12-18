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
	function insertarEmpleado( $nacionalidad, $ci, $nombre, $apellido, $fingreso, $usuario, $clave, $titulacion, $cargo, $rol, $zona, $direccion, $supervisa, $gerencia, $nota){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$usuario = htmlentities($usuario, ENT_QUOTES);
		$clave = md5(htmlentities($clave, ENT_QUOTES));
		if($nota != 'NULL') $nota = "'".htmlentities($nota, ENT_QUOTES)."'";
		$qry = "INSERT INTO Empleado (em_nacionalidad, em_ci, em_nombre, em_apellido, em_fecha_ingreso, em_usuario, em_clave, em_titulacion, em_cargo, em_rol, em_zona, em_direccion, em_supervisa, em_gerencia, em_nota) VALUES ('".$nacionalidad."',".$ci.",'".$nombre."','".$apellido."','".$fingreso."','".$usuario."','".$clave."',".$titulacion.",".$cargo.",".$rol.",".$zona.",".$direccion.", ".$supervisa.",".$gerencia.",".$nota.")";
		return pg_query($conexion, $qry);
	}
	function editarEmpleado( $id, $nacionalidad, $ci, $nombre, $apellido, $fingreso, $usuario, $clave, $titulacion, $cargo, $rol, $zona, $direccion, $supervisa, $gerencia, $nota){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$usuario = htmlentities($usuario, ENT_QUOTES);
		$clave = md5(htmlentities($clave, ENT_QUOTES));
		if($nota != 'NULL') $nota = "'".htmlentities($nota, ENT_QUOTES)."'";
		$qry = "UPDATE Empleado SET em_nacionalidad='".$nacionalidad."', em_ci=".$ci.", em_nombre='".$nombre."', em_apellido='".$apellido."', em_fecha_ingreso='".$fingreso."', em_usuario='".$usuario."', em_clave='".$clave."', em_titulacion=".$titulacion.", em_cargo=".$cargo.", em_rol=".$rol.", em_zona=".$zona.", em_direccion=".$direccion.", em_supervisa=".$supervisa.", em_gerencia=".$gerencia.", em_nota=".$nota." WHERE em_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarEmpleado( $id ){
		global $conexion;
		$qry = "DELETE FROM Empleado WHERE em_id=".$id;
		return pg_query($conexion, $qry);
	}
//Beneficiario
	function insertarBeneficiario( $nacionalidad, $ci, $nombre, $apellido, $empleado){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$qry = "INSERT INTO Beneficiario (be_nacionalidad, be_ci, be_nombre, be_apellido, be_empleado) VALUES ('".$nacionalidad."', ".$ci.", '".$nombre."', '".$apellido."', ".$empleado." ) ";
		return pg_query($conexion, $qry);
	}
	function editarBeneficiario( $id, $nacionalidad, $ci, $nombre, $apellido, $empleado){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$apellido = htmlentities($apellido, ENT_QUOTES);
		$qry = "UPDATE Beneficiario SET be_nacionalidad='".$nacionalidad."', be_ci='".$ci."', be_nombre='".$nombre."', be_apellido='".$apellido."', be_empleado=".$empleado." WHERE be_id".$id;
		return pg_query($conexion, $qry);
	}
//Experiencia
	function insertarExperiencia( $desc, $anos ){
		global $conexion;
		$desc = htmlentities($desc, ENT_QUOTES);
		$qry = "INSERT INTO Experiencia (ex_desc, ex_anos) VALUES ('".$desc."', '".$anos."')";
		return pg_query($conexion, $qry);
	}
	function editarExperiencia( $id, $desc, $anos ){
		global $conexion;
		$desc = htmlentities($desc, ENT_QUOTES);
		$qry = "UPDATE Experiencia SET ex_desc='".$desc."', ex_anos='".$anos."' WHERE ex_id=".$id;
		return pg_query($conexion, $qry);
	}
//Cliente
	function insertarCliente ( $trif, $rif, $nombre, $pweb, $finicio ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "INSERT INTO Cliente (cl_tipo_rif, cl_rif, cl_nombre, cl_pagina_web, cl_fecha_inicio) VALUES ('".$trif."', ".$rif.", '".$nombre."', '".$pweb."', '".$finicio."')";
		return pg_query($conexion, $qry);
	}
	function editarCliente ( $id, $trif, $rif, $nombre, $pweb, $finicio ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$pweb = htmlentities($pweb, ENT_QUOTES);
		$qry = "UPDATE Cliente SET cl_tipo_rif='".$trif."', cl_rif='".$trif."', cl_nombre='".$nombre."', cl_pagina_web='".$pweb."', cl_fecha_inicio='".$finicio."' WHERE cl_id=".$id;
		return pg_query($conexion, $qry);
	}
//Factura_venta
	function insertarFacturaVenta( $fecha ){
		global $conexion;
		$qry = "INSERT INTO Factura_venta (fc_fecha) VALUES ('".$fecha."')";
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
	function insertarModeloMotor( $nombre, $tipo, $emax, $enorma, $ecrucero, $longitud, $daspa ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Modelo_motor (mm_nombre, mm_tipo, mm_empuje_max, mm_empuje_norma, mm_empuje_crucero, mm_longitud, mm_diametro_aspa) VALUES ('".$nombre."', '".$tipo."', ".$emax.", ".$enorma.", ".$ecrucero.", ".$longitud.", ".$daspa.")";
		return pg_query($conexion, $qry);
	}
	function editarModeloMotor( $id, $nombre, $tipo, $emax, $enorma, $ecrucero, $longitud, $daspa ){
		global $conexion;
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Modelo_motor SET mm_nombre='".$nombre."', mm_tipo='".$tipo."', mm_empuje_max=".$emax.", mm_empuje_norma=".$enorma.", mm_empuje_crucero=".$ecrucero.", mm_longitud=".$longitud." , mm_diametro_aspa=".$daspa." WHERE mm_id=".$id;
		return pg_query($conexion, $qry);
	}
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
//Modelo_avion
	function eliminarModeloAvion( $id ){
		global $conexion;
		$qry = "DELETE FROM Modelo_avion where am_id=".$id;
		$qry2 = "DELETE FROM Distribucion where di_modelo_avion=".$id;
		$qry3 = "DELETE FROM Avion where a_distribucion=".$id;
		$qry4 = "DELETE FROM Pieza where p_avion=".$id;
		$qry5 = "DELETE FROM Material where m_pieza=".$id;
		$qry6 = "DELETE FROM Traslado where tr_material=".$id;
		$qry7 = "DELETE FROM Prueba_material where prm_material=".$id;
		$qry8 = "DELETE FROM Status_material where sm_material=".$id;
		$qry9 = "DELETE FROM Status_pieza where spi_pieza=".$id;
		$qry10 = "DELETE FROM Prueba_material where prm_material=".$id;
		$qry11 = "DELETE FROM Traslado where tr_pieza=".$id;
		$qry12 = "DELETE FROM Status_avion where sa_avion=".$id;
		$qry13 = "DELETE FROM Submodelo_avion where as_modelo_avion=".$id;
		$qry14 = "DELETE FROM Avion where a_submodelo_aviono=".$id;
		if(pg_query($conexion, $qry14)){
			if(pg_query($conexion, $qry13)){
				if(pg_query($conexion, $qry12)){
					if(pg_query($conexion, $qry11)){
						if(pg_query($conexion, $qry10)){	
							if(pg_query($conexion, $qry9)){
								if(pg_query($conexion, $qry8)){
									if(pg_query($conexion, $qry7)){
										if(pg_query($conexion, $qry6)){	
											if(pg_query($conexion, $qry5)){
												if(pg_query($conexion, $qry4)){
													if(pg_query($conexion, $qry3)){
														if(pg_query($conexion, $qry2)){	
															return pg_query($conexion, $qry1);
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		return 0;
	}
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
