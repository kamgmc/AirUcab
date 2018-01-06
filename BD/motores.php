<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Main</title>
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
	<link rel="shortcut icon" href="favicon.png"> </head>

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
							<!-- Logout    -->
							<li class="nav-item"><a href="login.html" class="nav-link logout">Cerrar Sesion<i class="fa fa-sign-out"></i></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="page-content d-flex align-items-stretch">
			<!-- Side Navbar -->
			<nav class="side-navbar">
				<!-- Sidebar Header-->
				<div class="sidebar-header d-flex align-items-center">
					<div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
					<div class="title">
						<h1 class="h4">Abuelo Fdz</h1>
						<p>Director Operaciones</p>
					</div>
				</div>
				<!-- Sidebar Navidation Menus-->
				<ul class="list-unstyled">
					<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) || in_array("am_c", $permiso) || in_array("as_c", $permiso) || in_array("di_c", $permiso) ){ ?>
					<li>
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
					<?php }?>
					<?php if( in_array("em_r", $permiso) || in_array("em_c", $permiso) ){ ?>
					<li>
						<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
					</li>
					<?php }?>
					<?php if( in_array("fv_r", $permiso) || in_array("fv_c", $permiso) ){ ?>
					<li>
						<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
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
					<?php if( in_array("fc_r", $permiso) ){ ?>
					<li>
						<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
					</li>
					<?php }?>
					<li>
						<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
					</li>
					<li>
						<a href="piezas.php"> <i class="fa fa-puzzle-piece " aria-hidden="true"></i>Piezas </a>
					</li>
					<li class="active">
						<a href="motores.php"> <i class="fa fa-tachometer " aria-hidden="true"></i>Motores </a>
					</li>
					<li>
						<a href="pruebas.php"> <i class="fa fa-check-square-o " aria-hidden="true"></i>Pruebas </a>
					</li>
					<li>
						<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
					</li>
					<li>
						<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
					</li>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS -->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Motores</label>
						<input id="tab1" type="radio" name="tabs" class="no-display" >
						<label for="tab1" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Modelo Motores</label>
						<input id="tab2" type="radio" name="tabs" class="no-display" >
						<label for="tab2" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Marca Motores</label>
						
						<!-- TAB Piezas -->
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
														<input type="submit" value="Ejecutar" class="btn btn-primary"> </div>
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
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalMotorCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<!-- Modelo Motor -->
													<th class="text-center">NOMBRE</th>
													<th class="text-center">FECHA FINAL</th>
													<th class="text-center">FECHA INICIO</th>
													<th class="text-center">STATUS</th>
													<th class="text-center">AVION P.</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Winston C</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center">14/11/2018</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">Hawk 421</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						<!-- TAB MODELO MOTOR -->
						<section id="content1" class="sectiontab">
							<!-- Filtrador -->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">Filtrar Modelo Motor por:</h3>
													<form class="form-horizontal" method="post">
														<div class="row">
															<label class="col-sm-3 form-control-label">Marca</label>
															<div class="col-sm-9 select">
																<select name="rol" class="form-control">
																	<option value="NULL">Seleccionar</option>
																	
																</select>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-3 form-control-label">Tipo</label>
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
															<input type="submit" value="Filtrar" class="btn btn-primary"> </div>
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
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalModeloMotorCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">NOMBRE</th>
													<th class="text-center">MARCA</th>
													<th class="text-center">TIPO</th>
													<th class="text-center">EMPUJE MAX</th>
													<th class="text-center">EMPUJE NORMA</th>
													<th class="text-center">EMPUJE CRUCERO</th>
													<th class="text-center">LONGITUD</th>
													<th class="text-center">DIAMETRO ASPA</th>
													<th class="text-center">STATUS</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">Modelo A</td>
														<td class="text-center">Oxford</td>
														<td class="text-center">Reactor</td>
														<td class="text-center">15</td>
														<td class="text-center">11</td>
														<td class="text-center">8</td>
														<td class="text-center">35 m</td>
														<td class="text-center">78 m</td>
														<td class="text-center"><span class="badge badge-info">Listo</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalModeloMotor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>

						
						<!-- TAB MARCA MOTOR -->
						<section id="content2" class="sectiontab">
							
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalMarcaMotorCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">NOMBRE</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td class="text-center">Pratt & Whitney</td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalMarcaMotor"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
														<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<tr>
													<td class="text-center">Pratt & Whitney</td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalMarcaMotor"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
														<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<tr>
													<td class="text-center">Pratt & Whitney</td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalMarcaMotor"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
														<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<tr>
													<td class="text-center">Pratt & Whitney</td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalMarcaMotor"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
														<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<tr>
													<td class="text-center">Pratt & Whitney</td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalMarcaMotor"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
														<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
													
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						<!-- Modal Motor Informacion -->
						<div id="ModalMotor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION MOTOR</h4>
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
																	<h3>ESTATUS</h3> </div>
																<div class="col-lg-8"> <span class="badge badge-primary font-big">Disponible</span> </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"></div>
															</div>
														</div>	
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															
															<div class="row">
																<div class="col-lg-4">
																	<h3>Fecha Inicio</h3> </div>
																<div class="col-lg-8">  </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Fecha Final</h3> </div>
																<div class="col-lg-8">  </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Avion P.</h3> </div>
																<div class="col-lg-8">  </div>
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
										
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalMotorEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Motor Informacion ENDS -->

						
						<!-- Modal Modelo Motor Informacion -->
						<div id="ModalModeloMotor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION MODELO MOTOR</h4>
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
																	<h3>ESTATUS</h3> </div>
																<div class="col-lg-8"> <span class="badge badge-primary font-big">Disponible</span> </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Marca</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Tipo</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Empuje Max</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Empuje Norma</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Empuje Crucero</h3> </div>
																<div class="col-lg-8"></div>
															</div>
														</div>	
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															
															<div class="row">
																<div class="col-lg-4">
																	<h3>Longitud</h3> </div>
																<div class="col-lg-8"></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Diametro Aspa</h3> </div>
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
										<!-- Tabla Piezas STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">AVIONES QUE LO USAN</h3> </div>
												<div class="card-body">
													
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th class="text-center text-middle">ID</th>
																<th class="text-center text-middle">Nombre</th>
																<th class="text-center text-middle">Longitud</th>
																<th class="text-center text-middle">Altura</th>
																<th class="text-center text-middle">Envergadura</th>
																<th class="text-center text-middle">Velocidad Max</th>
																<th class="text-center text-middle">Volumen Carga</th>
																<th class="text-center text-middle">Capacidad Pilotos</th>
																<th class="text-center text-middle">Capacidad Asistentes</th>
																<th class="text-center text-middle">Tiempo Estimado</th>
																<th class="text-center">Acción</th>
															</tr>
														</thead>
														<tbody>
														
															<tr>
																<td>3</td>
																<td>AU808</td>
																<td>2.00</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalPieza"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td>3</td>
																<td>AU808</td>
																<td>2.00</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td>24</td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalPieza"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															
															
														</tbody>
													</table>
													
												</div>
											</div>
										</div>
										<!-- Tabla Piezas ENDS -->
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalModeloMotorEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Modelo Motor Informacion ENDS -->

						

												
						<!-- Modal Motor Editar -->
						<div id="myModalMotorEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MOTOR</h4>
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
																	<h3>Fecha Inicio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha de Inicio" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															
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
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Posible uso en:</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Modelo Avion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
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
						<!-- Modal Motor Editar ENDS -->

						<!-- Modal Modelo Motor Editar -->
						<div id="myModalModeloMotorEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MODELO MOTOR</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Informacion Modelo Motor</h4>
														</div>
														
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Marca</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																	</select>
																</div>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Max</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Max" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Norma</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Norma" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Crucero</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Longitud</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Diametro Aspa</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
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

										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Posible uso en:</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Modelo Avion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
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
						<!-- Modal Modelo Motor Editar ENDS -->

						
						<!-- Modal Marca Motor Editar  -->
						<div id="myModalMarcaMotor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDITAR MARCA MOTOR</h4>
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
						<!-- Modal Marca Motor Editar ENDS -->



						<!-- Modal Motor Crear -->
						<div id="myModalMotorCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MOTOR</h4>
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
																	<h3>Fecha Inicio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha de Inicio" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															
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
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Posible uso en:</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Modelo Avion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
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
						<!-- Modal Motor Crear ENDS -->

						<!-- Modal Modelo Motor Crear -->
						<div id="myModalModeloMotorCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MODELO MOTOR</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Informacion Modelo Motor</h4>
														</div>
														
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Marca</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																	</select>
																</div>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Max</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Max" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Norma</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Norma" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Empuje Crucero</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Longitud</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Diametro Aspa</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Empuje Crucero" class="form-control"> </div>
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

										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Posible uso en:</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Modelo Avion</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		
																	</select>
																</div>
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
						<!-- Modal Modelo Motor Crear ENDS -->

						<!-- Modal Marca Motor Crear  -->
						<div id="myModalMarcaMotorCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MARCA MOTOR</h4>
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
						<!-- Modal Marca Motor Crear ENDS -->






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
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js">
	</script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery.cookie/jquery.cookie.js">
	</script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="js/front.js"></script>
</body>

</html>