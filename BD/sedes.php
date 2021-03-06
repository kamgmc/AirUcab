<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("se_r", $permiso) && !in_array("zo_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: empleados.php');
        exit;
    }
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Sedes</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="css/fontastic.css">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="css/custom.css">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/airucab.ico">
</head>
<body>
	<div class="page home-page">
		<!-- Main Navbar-->
		<header class="header">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-holder d-flex align-items-center justify-content-between">
						<!-- Navbar Header-->
						<div class="navbar-header">
							<!-- Navbar Brand -->
							<a href="index.html" class="navbar-brand">
								<div class="brand-text brand-big"><span>Air</span><strong>UCAB</strong></div>
								<div class="brand-text brand-small"><strong>AU</strong></div>
							</a>
							<!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a> </div>
						<!-- Navbar Menu -->
						<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
							<?php if( isset($_SESSION['code']) ){ ?>
							<!-- Logout    -->
							<li class="nav-item">
								<a href="close.php" class="nav-link logout">Cerrar Sesión<i class="fa fa-sign-out"></i></a>
							</li>
							<?php }else{ ?>
							<!-- Login -->
							<li class="nav-item">
								<a href="login.php" class="nav-link logout">Iniciar Sesión<i class="fa fa-sign-in"></i></a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="page-content d-flex align-items-stretch">
			<!-- Side Navbar -->
			<nav class="side-navbar">
				<?php if( isset($_SESSION['code']) ){ ?>
				<!-- Sidebar Header-->
				<div class="sidebar-header d-flex align-items-center">
					<div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
					<div class="title">
						<h1 class="h4"><?php print $_SESSION['usuario']; ?></h1>
						<p><?php print $_SESSION['cargo']; ?></p>
					</div>
				</div>
					<?php } ?>
				<!-- Sidebar Navidation Menus-->
				<ul class="list-unstyled">
                	<li>
						<a href="index.php"> <i class="fa fa-space-shuttle" aria-hidden="true"></i> Reportes</a>
					</li>
					<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) ){ ?>
					<li>
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
					<?php }?>
					<?php if (in_array("mb_r", $permiso) || in_array("mm_r", $permiso) || in_array("mo_r", $permiso) ) { ?>
					<li>
						<a href="motores.php"> <i class="fa fa-tachometer" aria-hidden="true"></i>Motores </a>
					</li>
					<?php }?>
					<?php if( in_array("p_r", $permiso) || in_array("pm_r", $permiso) || in_array("wt_r", $permiso) || in_array("et_r", $permiso) ) { ?>
					<li>
						<a href="piezas.php"> <i class="fa fa-puzzle-piece " aria-hidden="true"></i>Piezas </a>
					</li>
					<?php }?>
					<?php if( in_array("m_r", $permiso) || in_array("tm_r", $permiso) ) { ?>
					<li>
						<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
					</li>
					<?php }?>
					<?php if( in_array("fv_r", $permiso) ){ ?>
					<li>
						<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
					</li>
					<?php }?>
					<?php if( in_array("fc_r", $permiso) ){ ?>
					<li>
						<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
					</li>
					<?php }?>
					<?php if( in_array("se_r", $permiso) || in_array("zo_r", $permiso) ){ ?>
					<li class="active">
						<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
					</li>
					<?php }?>
					<?php if( in_array("em_r", $permiso) || in_array("sr_r", $permiso) || in_array("er_r", $permiso) || in_array("ti_r", $permiso) || in_array("pe_r", $permiso) || in_array("rp_r", $permiso) || in_array("ct_r", $permiso) ){ ?>
					<li>
						<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
					</li>
					<?php }?>
					<?php if( in_array("cl_r", $permiso) ){ ?>
					<li>
						<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
					</li>
					<?php }?>
					<?php if( in_array("po_r", $permiso) ){ ?>
					<li>
						<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
					</li>
					<?php }?>
					<?php if( in_array("pr_r", $permiso) ){ ?>
					<li>
						<a href="pruebas.php"> <i class="fa fa-check-square-o " aria-hidden="true"></i>Pruebas </a>
					</li>
					<?php }?>
					<?php if( in_array("tr_r", $permiso) ){ ?>
					<li>
						<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
					</li>
					<?php }?>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS -->
				<section>
					<div class="container-fluid">
                        <?php if( in_array("se_r", $permiso) ){ ?>
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-university" aria-hidden="true"></i> Sedes</label>
                        <?php } ?>
                        <?php if( in_array("zo_r", $permiso) ){ ?>
						<input id="tab1" type="radio" name="tabs" class="no-display" >
						<label for="tab1" class="label"><i class="fa fa-university" aria-hidden="true"></i> Zonas</label>
                        <?php } ?>
                        <?php if( in_array("se_r", $permiso) ){?>
						<!-- TAB SEDES -->
						<section id="content0" class="sectiontab">
							<!-- Accionista -->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<form class="form-horizontal">
													<div class="form-group row">
														<div class="col-sm-12">
															<input type="text" placeholder="Ingrese Nombre a Buscar o ID..." class="form-control"> </div>
													</div>
												</form>
											</div>
											<div class=" card-body col-lg-4">
												<div class="form-group row">
													<div class="col-sm-9">
														<input type="submit" value="Ejecutar" class="btn btn-primary">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Accionista ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
                                    <?php if( in_array("se_c", $permiso) ) { ?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalSedeCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php } ?>
                                    <?php $qry = "SELECT se_id id, se_nombre nombre, se_area area, se_principal principal, lu_nombre ubicacion, COUNT(zo_id) zonas FROM Sede LEFT JOIN Lugar on se_lugar=lu_id LEFT JOIN Zona on zo_sede=se_id GROUP BY se_id, se_nombre, se_area, se_principal, lu_nombre ORDER BY se_id";
								    $rs = pg_query( $conexion, $qry );
								    $howMany = pg_num_rows($rs);
								    if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
													<th class="text-center">Area</th>
													<th class="text-center">Principal</th>
													<th class="text-center">Ubicacion</th>
													<th class="text-center"># de Zonas</th>
													<th class="text-center">Acción</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $sede = pg_fetch_object($rs) ){?>
													<tr>
														<td class="text-center">
                                                            <?php print $sede->id;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $sede->nombre;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print number_format($sede->area, 0, ',', '.')." m";?><sup>2</sup>
                                                        </td>
														<td class="text-center">
                                                            <?php if($sede->principal == 't'){?>Si<?php } ?>
                                                            <?php if($sede->principal == 'f'){?>No<?php } ?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $sede->ubicacion;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $sede->zonas;?>
                                                        </td>
														<td class="text-center">
															<a class="click-sede-detalle" href="<?php print $sede->id;?>"> 
												                <i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
												            </a>
															<?php if( in_array("se_d", $permiso) ){?>&emsp;
												            <a href="sede-crud.php?delete=<?php print $sede->id;?>">
																<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
															</a>
												            <?php }?>
														</td>
													</tr>
                                                    <?php }?>
											</tbody>
										</table>
                                        <?php }else{?>
										<h4>&emsp;No se han encontrado resultados.</h4>
										<?php }?>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- Modal Sede Informacion -->
						<div id="ModalSede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION SEDE</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<!-- Columna Izquierda   -->

														<div class="card-body col-lg-6">
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Area</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Principal</h3> </div>
																<div class="col-lg-8"></div>
															</div>
														</div>	
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															
															<div class="row">
																<div class="col-lg-4">
																	<h3>Ubicacion</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nota</h3> </div>
																<div class="col-lg-8">  </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Tabla Zonas STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">ZONAS PERTENECIENTES A LA SEDE</h3>
												</div>
												<div class="card-body">
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th class="text-center">ID</th>
																<th class="text-center">NOMBRE</th>
																<th class="text-center">TIPO</th>
																<th class="text-center">Accion</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td class="text-center">Ensamble de Motor</td>
																<td class="text-center">Ensablaje</td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#ModalZonaEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
																	<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td class="text-center">1</td>
																<td class="text-center">Ensamble de Motor</td>
																<td class="text-center">Ensablaje</td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#ModalZonaEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
																	<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td class="text-center">1</td>
																<td class="text-center">Ensamble de Motor</td>
																<td class="text-center">Ensablaje</td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#ModalZonaEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
																	<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- Tabla Zonas ENDS -->
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
                                        <?php if(in_array("se_u", $permiso)){?>
										<button type="button" data-toggle="modal" data-target="#myModalSedeEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal SEDE Informacion ENDS -->
						<?php if( in_array("se_u", $permiso) ){ ?>
						<!-- Modal Sede Editar -->
						<div id="myModalSedeEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION SEDE</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Area</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Area" class="form-control"> </div>
															</div>
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																	<h3>PRINCIPAL</h3> 
																</label>
																<div class="col-sm-9">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> SI
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" checked="" name="tipo_pago" type="radio"> NO
																		</label>
																	</div>
																</div>
															</div>
														</div>	
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Ubicacion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Sede Editar ENDS -->
						<?php }?>
						<?php if( in_array("se_c", $permiso) ){ ?>
						<!-- Modal Sede Crear -->
						<div id="myModalSedeCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR SEDE</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Area</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Area" class="form-control"> </div>
															</div>
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																<h3>PRINCIPAL</h3> </label>
																<div class="col-sm-9">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> SI
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" checked="" name="tipo_pago" type="radio"> NO
																		</label>
																	</div>
																</div>
															</div>
														</div>	
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Ubicacion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Sede Crear ENDS -->
						<?php }?>
						<?php }?>
						<?php if( in_array("zo_r", $permiso) ){ ?>
						<!-- TAB ZONAS -->
						<section id="content1" class="sectiontab">
							<!-- Filtrador -->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">Filtrar Zona por:</h3>
													<form class="form-horizontal" method="post">
														<div class="row">
															<label class="col-sm-3 form-control-label">Sede</label>
															<div class="col-sm-9 select">
																<select name="rol" class="form-control">
																	<option value="NULL">Seleccionar</option>
																	
																</select>
															</div>
														</div>
													</form>
												</div>
												<div class=" card-body col-lg-4">
													<div class="form-group row">
														<div class="col-sm-9">
															<br>
															<input type="submit" value="Filtrar" class="btn btn-primary">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<!-- Accionista ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
                                    <?php if( in_array("zo_c", $permiso) ) {?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalZonaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php }?>
                                    <?php $qry = "SELECT zo_id id, zo_nombre nombre, zo_tipo tipo, se_nombre sede FROM Zona LEFT JOIN Sede on zo_sede=se_id GROUP BY zo_id, se_nombre ORDER BY zo_id";
								    $rs = pg_query( $conexion, $qry );
								    $howMany = pg_num_rows($rs);
								    if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
                                                    <th class="text-center">Sede</th>
													<th class="text-center">Tipo</th>													
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $zona = pg_fetch_object($rs) ){?>
													<tr>
														<td class="text-center">
                                                            <?php print $zona->id;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $zona->nombre;?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php print $zona->sede ?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $zona->tipo;?>
                                                        </td>														
														<td class="text-center">
															<a class="click-zona-detalle" href="<?php print $zona->id;?>"> 
												                <i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
												            </a>
															<?php if( in_array("zo_d", $permiso) ){?>&emsp;
												            <a href="zona-crud.php?delete=<?php print $zona->id;?>">
																<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
															</a>
												            <?php }?>
														</td>
													</tr>
                                                    <?php }?>
											</tbody>
										</table>
                                        <?php }else{?>
										<h4>&emsp;No se han encontrado resultados.</h4>
										<?php }?>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<?php if( in_array("zo_u", $permiso) ) {?>
						<!-- Modal Zona Editar -->
						<div id="ModalZonaEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION ZONA</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Tipo</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Sede P.</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Zona Editar ENDS -->
						<?php }?>
						<?php if( in_array("zo_c", $permiso) ) {?>
						<!-- Modal Zona Crear -->
						<div id="myModalZonaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR ZONA</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Tipo</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Sede P.</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Zona Crear ENDS -->
						<?php }?>
						<?php }?>
					</div>
				</section>
				<!-- Section de TABS ENDS -->
			</div>
		</div>
		<!-- Page Footer-->
		<footer class="main-footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<p>AirUCAB &copy; 2017-2018</p>
					</div>
					<div class="col-sm-6 text-right">
						<p>Diseño por <a href="" class="external">AK</a></p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- Javascript files-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="js/front.js"></script>
</body>

</html>