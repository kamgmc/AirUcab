<!DOCTYPE html><?php include 'conexion.php';?>
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
					<li> <a href="empleados.php"><i class="icon-man-people-streamline-user"></i>Empleados</a></li>
					<li>
						<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
					</li>
					<li>
						<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
					</li>
					<li>
						<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
					</li>
					<li>
						<a href="compras.php"> <i class="fa fa-cog" aria-hidden="true"></i>Compras </a>
					</li>
					<li class="active">
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS-->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-plane" aria-hidden="true"></i> Modelos Aviones</label>
						<input id="tab1" type="radio" name="tabs" class="no-display">
						<label for="tab1" class="label"><i class="fa fa-rocket" aria-hidden="true"></i> Submodelos Aviones</label>
						<input id="tab2" type="radio" name="tabs" class="no-display">
						<label for="tab2" class="label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Distribucion</label>
						<!-- TAB Modelos Aviones -->
						<section id="content0" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">MOSTRAR SOLO AVIONES QUE</h3>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Modelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Submodelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Distribucion</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
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
							<!-- Filtrador ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalModeloCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body table-overflow">
										<table class="table table-striped table-sm table-hover pad-right">
											<thead>
												<tr>
													<th class="text-center text-middle">ID</th>
													<th class="text-center text-middle">NOMBRE</th>
													<th class="text-center text-middle">LONGITUD</th>
													<th class="text-center text-middle">ALTURA</th>
													<th class="text-center text-middle">ENVERGADURA</th>
													<th class="text-center text-middle">VELOCIDAD MAX</th>
													<th class="text-center text-middle">VOLUMEN CARGA</th>
													<th class="text-center text-middle">CAPACIDAD PILOTOS</th>
													<th class="text-center text-middle">CAPACIDAD ASISTENTES</th>
													<th class="text-center text-middle">TIEMPO ESTIMADO</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT am_id id, am_nombre nombre, am_longitud longitud, am_altura altura, am_envergadura envergadura, am_velocidad_max velocidad, am_carga_volumen carga, am_capacidad_pilotos pilotos, am_capacidad_asistentes asistentes, am_tiempo_estimado tiempo FROM Modelo_avion ORDER BY am_id";
												$rs = pg_query( $conexion, $qry );
												while( $avion = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center text-middle"><?php print $avion->id;?></td>
													<td class="text-center text-middle"><?php print $avion->nombre;?></td>
													<td class="text-center text-middle"><?php print $avion->longitud." m";?></td>
													<td class="text-center text-middle"><?php print $avion->altura." m";?></td>
													<td class="text-center text-middle"><?php print $avion->envergadura." m";?></td>
													<td class="text-center text-middle"><?php print $avion->velocidad." km/h";?></td>
													<td class="text-center text-middle"><?php print $avion->carga." m<sup>3</sup>";?></td>
													<td class="text-center text-middle"><?php print $avion->pilotos;?></td>
													<td class="text-center text-middle"><?php print $avion->asistentes;?></td>
													<td><?php $dias = $avion->tiempo;$meses = 0; while($dias > 31){$meses+=1; $dias-=30;} print $meses." meses y ".$dias." dias"; ?></td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalDetalleModelo"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
														<a href="modeloavion-crud.php?delete=<?php print $avion->id;?>"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- TAB Modelos Aviones ENDS -->
						<!-- TAB Submodelos Aviones -->
						<section id="content1" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">MOSTRAR SOLO AVIONES QUE</h3>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Modelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Submodelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Distribucion</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
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
							<!-- Filtrador ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalSubmodeloCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body table-overflow">
										<table class="table table-striped table-sm table-hover pad-right">
											<thead>
												<tr>
													<th class="text-center text-middle">ID</th>
													<th class="text-center text-middle">NOMBRE</th>
													<th class="text-center text-middle">PESO MAXIMO DESPEGUE</th>
													<th class="text-center text-middle">PESO VACIO</th>
													<th class="text-center text-middle">VELOCIDAD CRUCERO</th>
													<th class="text-center text-middle">CARRERA DESPEGUE PESO MAX</th>
													<th class="text-center text-middle">AUTONO. PESO MAX DESPEGUE</th>
													<th class="text-center text-middle">CAPACIDAD COMBUSTIBLE</th>
													<th class="text-center text-middle">ALCANCE CARGA MAXIMA</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT as_id id, am_nombre modelo, as_nombre nombre, as_peso_maximo_despegue peso_max, as_peso_vacio peso_vacio, as_velocidad_crucero crucero, as_carrera_despegue_peso_maximo carrera, as_autonomia_peso_maximo_despegue autonomia, as_capacidad_combustible combustible, as_alcance_carga_maxima alcance FROM Submodelo_avion, Modelo_avion where as_modelo_avion=am_id ORDER BY am_id, as_id";
												$rs = pg_query( $conexion, $qry );
												while( $avion = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center text-middle"><?php print $avion->id;?></td>
													<td class="text-center text-middle"><?php print $avion->modelo." - ".$avion->nombre;?></td>
													<td class="text-center text-middle"><?php print $avion->peso_max." Kg";?></td>
													<td class="text-center text-middle"><?php print $avion->peso_vacio." Kg";?></td>
													<td class="text-center text-middle"><?php print $avion->crucero." Nudos";?></td>
													<td class="text-center text-middle"><?php print $avion->carrera." m";?></td>
													<td class="text-center text-middle"><?php print $avion->autonomia;?></td>
													<td class="text-center text-middle"><?php print $avion->combustible." Lts";?></td>
													<td class="text-center text-middle"><?php print $avion->alcance." m";?></td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalDetalleSubmodelo"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
														<a href="" data-toggle="modal" data-target="#myModalBorrarSubmodelo"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- TAB Submodelos Aviones ENDS -->
						<!-- TAB Distribuciones Aviones -->
						<section id="content2" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">MOSTRAR SOLO AVIONES QUE</h3>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Modelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Submodelo</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Distribucion</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option>option 1</option>
																<option>option 2</option>
																<option>option 3</option>
																<option>option 4</option>
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
							<!-- Filtrador ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalDistribucionCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body table-overflow">
										<table class="table table-striped table-sm table-hover pad-right">
											<thead>
												<tr>
													<th class="text-center text-middle">ID</th>
													<th class="text-center text-middle">MODELO AVION</th>
													<th class="text-center text-middle">DISTRIBUCIÓN</th>
													<th class="text-center text-middle">N CLASES</th>
													<th class="text-center text-middle">CAPACIDAD PASAJEROS</th>
													<th class="text-center text-middle">DISTANCIA ASIENTOS</th>
													<th class="text-center text-middle">ANCHO ASIENTOS</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT di_id id, am_nombre modelo, di_nombre distribucion, di_numero_clases clases, di_capacidad_pasajeros capacidad, di_distancia_asientos d_asientos, di_ancho_asientos a_asientos FROM Distribucion, Modelo_avion where di_modelo_avion=am_id ORDER BY am_id, di_id";
												$rs = pg_query( $conexion, $qry );
												while( $avion = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center text-middle"><?php print $avion->id;?></td>
													<td class="text-center text-middle"><?php print $avion->modelo;?></td>
													<td class="text-center text-middle"><?php print $avion->distribucion;?></td>
													<td class="text-center text-middle"><?php print $avion->clases;?></td>
													<td class="text-center text-middle"><?php print $avion->capacidad;?></td>
													<td class="text-center text-middle"><?php print $avion->d_asientos." cm";?></td>
													<td class="text-center text-middle"><?php print $avion->a_asientos." cm";?></td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalDetalleDistribucion"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
														<a href="" data-toggle="modal" data-target="#myModalBorrarDistribucion"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- TAB Distribuciones Aviones ENDS -->
						<!-- Modal Detalle Modelo Avion -->
						<div id="myModalDetalleModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE MODELO AVION</h4>
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
																	<h3>ID</h3> </div>
																<div class="col-lg-8"> 001 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"> AU80 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Longitud</h3> </div>
																<div class="col-lg-8"> 20 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Envergadura</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Altura</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Superficie Ala</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Flecha Ala</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Peso Maximo Aterrizaje</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Alcance</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Velocidad Maxima</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Servicio Techo</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Regimen Ascenso</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
														</div>
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															<div class="row">
																<div class="col-lg-4">
																	<h3>Numero Pasillos</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Tipo Fuselaje</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Altura Fuselaje</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Ancho Fuselaje</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Altura Cabina</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Ancho Cabina</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Volumen Carga</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Capacidad Pilotos</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Capacidad Asientos</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Carrera Despegue</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Tiempo Estimado</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nota</h3> </div>
																<div class="col-lg-8"> Emlpeado destacado en desarrollo y busqueda.
																	<br> Leal a la compania. </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalModeloEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Modelo Avion ENDS -->
						<!-- Modal Detalle Submodelo Avion -->
						<div id="myModalDetalleSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE SUBMODELO AVION</h4>
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
																	<h3>Modelo Avion</h3> </div>
																<div class="col-lg-8"> AU80 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>ID</h3> </div>
																<div class="col-lg-8"> 001 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"> LW </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Peso Maximo Despegue</h3> </div>
																<div class="col-lg-8"> 20 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Peso Vacio</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Velocidad Crucero</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Carrera Despegue Peso Maximo</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Autonomia Peso Maximo Despegue</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Capacidad Combustible</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Alcance Carga Maxima</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
														</div>
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															<div class="row">
																<div class="col-lg-3">
																	<h3>Nota</h3> </div>
																<div class="col-lg-9"> Emlpeado destacado en desarrollo y busqueda.
																	<br> Leal a la compania. </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalSubmodeloEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Submodelo Avion ENDS -->
						<!-- Modal Detalle Ditribucion Avion -->
						<div id="myModalDetalleDistribucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE DISTRIBUCION AVION</h4>
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
																	<h3>Modelo Avion</h3> </div>
																<div class="col-lg-8"> AU80 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>ID</h3> </div>
																<div class="col-lg-8"> 001 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nombre</h3> </div>
																<div class="col-lg-8"> LW </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Numero Clases</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Capacidad Pasajeros</h3> </div>
																<div class="col-lg-8"> 20 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Distancia Asientos</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Ancho Asientos</h3> </div>
																<div class="col-lg-8"> 15 </div>
															</div>
														</div>
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															<div class="row">
																<div class="col-lg-3">
																	<h3>Nota</h3> </div>
																<div class="col-lg-9"> Emlpeado destacado en desarrollo y busqueda.
																	<br> Leal a la compania. </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalDistribucionEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Distribucion Avion ENDS -->
						<!-- Modal Borrar Modelo Avion -->
						<div id="myModalBorrarModeloAvion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Esta seguro que desea borrar el Modelo de Avion?</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
										<button type="button" class="btn btn-primary">Borrar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Borrar Modelo Avion ENDS -->
						<!-- Modal Borrar Submodelo -->
						<div id="myModalBorrarSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Esta seguro que desea borrar el Submodelo de Avion?</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
										<button type="button" class="btn btn-primary">Borrar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Borrar Submodelo ENDS -->
						<!-- Modal Borrar Distribucion -->
						<div id="myModalBorrarDistribucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Esta seguro que desea borrar la Distribucion de Avion?</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
										<button type="button" class="btn btn-primary">Borrar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Borrar Distribucion ENDS -->
						<!-- Modal Modelo Avion Editar -->
						<div id="myModalModeloEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">MODELO AVION</h4>
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
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Longitud</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Longitud" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Envergadura</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Envergadura" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Altura</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Altura" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Superficie Ala</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Superficie Ala" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Flecha Ala</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Flecha Ala" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Maximo Aterrizaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Maximo Aterrizaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Alcance</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Alcance" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Velocidad Maxima</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Velocidad Maxima" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Servicio Techo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Servicio Techo" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Regimen Ascenso</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Regimen Ascenso" class="form-control"> </div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Numero Pasillos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Numero Pasillos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Altura Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Altura Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Ancho Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Ancho Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Volumen Carga</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Volumen Carga" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Pilotos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Pilotos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Asientos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Carrera Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Carrera Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tiempo Estimado</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tiempo Estimado" class="form-control"> </div>
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
						<!-- Modal Modelo Avion Editar ENDS -->
						<!-- Modal Submodelo Avion Editar -->
						<div id="myModalSubmodeloEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">SUBMODELO AVION</h4>
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
																	<h3>Modelo Avion</h3> </label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>AU80</option>
																		<option>AU90</option>
																		<option>AU98</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Maximo Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Maximo Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Vacio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Vacio" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Velocidad Crucero</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Velocidad Crucero" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Carrera Despegue Peso Maximo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Carrera Despegue Peso Maximo" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Autonomia Peso Maximo Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Autonomia Peso Maximo Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Combustible</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Combustible" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Alcance Carga Maxima</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Alcance Carga Maxima" class="form-control"> </div>
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
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Submodelo Avion Editar ENDS -->
						<!-- Modal Distribucion Avion Editar -->
						<div id="myModalDistribucionEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DISTRIBUCION AVION</h4>
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
																	<h3>Modelo Avion</h3> </label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>AU80</option>
																		<option>AU90</option>
																		<option>AU98</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Numero Clases</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Numero Clases" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Pasajeros</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Pasajeros" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Distancia Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Distancia Asientos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Acho Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Ancho Asientos" class="form-control"> </div>
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
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Distribucion Avion Editar ENDS -->
						<!-- Modal Crear Submodelo Avion -->
						<div id="myModalSubmodeloCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">SUBMODELO AVION</h4>
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
																	<h3>Modelo Avion</h3> </label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>AU80</option>
																		<option>AU90</option>
																		<option>AU98</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Maximo Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Maximo Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Vacio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Vacio" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Velocidad Crucero</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Velocidad Crucero" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Carrera Despegue Peso Maximo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Carrera Despegue Peso Maximo" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Autonomia Peso Maximo Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Autonomia Peso Maximo Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Combustible</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Combustible" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Alcance Carga Maxima</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Alcance Carga Maxima" class="form-control"> </div>
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
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Crear Submodelo Avion ENDS -->
						<!-- Modal Crear Modelo Avion -->
						<div id="myModalModeloCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">MODELO AVION</h4>
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
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Longitud</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Longitud" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Envergadura</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Envergadura" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Altura</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Altura" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Superficie Ala</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Superficie Ala" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Flecha Ala</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Flecha Ala" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Peso Maximo Aterrizaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Peso Maximo Aterrizaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Alcance</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Alcance" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Velocidad Maxima</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Velocidad Maxima" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Servicio Techo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Servicio Techo" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Regimen Ascenso</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Regimen Ascenso" class="form-control"> </div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Numero Pasillos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Numero Pasillos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Altura Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Altura Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Ancho Fuselaje</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Ancho Fuselaje" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Volumen Carga</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Volumen Carga" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Pilotos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Pilotos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Asientos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Carrera Despegue</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Carrera Despegue" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tiempo Estimado</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tiempo Estimado" class="form-control"> </div>
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
						<!-- Modal Crear Modelo Avion ENDS -->
						<!-- Modal Distribucion Avion Crear -->
						<div id="myModalDistribucionCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DISTRIBUCION AVION</h4>
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
																	<h3>Modelo Avion</h3> </label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>AU80</option>
																		<option>AU90</option>
																		<option>AU98</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>ID</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Numero Clases</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Numero Clases" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Capacidad Pasajeros</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Capacidad Pasajeros" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Distancia Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Distancia Asientos" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Acho Asientos</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Ancho Asientos" class="form-control"> </div>
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
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Distribucion Avion Crear ENDS -->
						<!-- Modal Venta Crear -->
						<div id="myModalVentaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">VENTA</h4>
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
																	<h3>Factura Venta</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>ESTATUS</h3> </label>
																<!-- Traer de la tabla de Status las opciones -->
																<!-- Creo que su seleccion deberia ser automatica por parte del sistema solo en este caso porque este pasa a -->
																<!-- finalizado cuando los otros STATUS de cada material y cada avion comprado pasan a Finalizado -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>En Progreso</option>
																		<option>Evaluacion</option>
																		<option>Distribucion</option>
																		<option>Finalizado</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cliente</h3> </label>
																<!-- Traer de la tabla de clientes las opciones -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Lex Fdz</option>
																		<option>Alexander K</option>
																		<option>Kevin M</option>
																		<option>Boris Tor</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>CI/RIF Cliente</h3> </label>
																<!-- Se debe rellenar automaticamente despues de seleccionar al cliente -->
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Modelo Avion</h3> </label>
																<!-- Traer de la tabla de modelo avion las opciones -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>AU80</option>
																		<option>Au808</option>
																		<option>AU988</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Submodelo Avion</h3> </label>
																<!-- Traer de la tabla de submodelo avion las opciones -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>LW</option>
																		<option>Standar</option>
																		<option>Big</option>
																	</select> <span class="help-block-none"><small>Seleccionar Modelo Avion primero.</small></span> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Distribucion</h3> </label>
																<!-- Traer de la tabla de distribucion avion las opciones -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Civil</option>
																		<option>Militar</option>
																		<option>Empresarial</option>
																	</select> <span class="help-block-none"><small>Seleccionar Modelo Avion primero.</small></span> </div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca cantidad de Aviones" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Precio Unitario</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca precio por Avion" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Inicio</h3> </label>
																<!-- Esto podemos hacerlo automatizado, que salve la fecha de creacion como fecha inicio -->
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha Inicio" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Final</h3> </label>
																<!-- Esto es OBLIGATORIAMENTE AUTOMATICO cuando el STATUS cambie a finalizado -->
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo de Pago</h3> </label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Transfencia</option>
																		<!-- La opcion TDC deberia expandir otros requerimientos, pero esto lo dejare para cuando implementemos el -->
																		<!-- hardcore de JS y PHP (2da entrega)-->
																		<option>TDC</option>
																	</select> <span class="help-block-none"><small>Seleccionar Modelo Avion primero.</small></span> </div>
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
						<!-- Modal Venta Crear ENDS -->
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