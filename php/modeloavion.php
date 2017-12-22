<?php session_start(); date_default_timezone_set('America/Port_of_Spain'); error_reporting('E_ALL ^ E_NOTICE'); include 'conexion.php';?>
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
								<a href="modeloavion.php" class="navbar-brand">
									<div class="brand-text brand-big"><span>Air</span><strong>UCAB</strong></div>
									<div class="brand-text brand-small"><strong>AU</strong></div>
								</a>
								<!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a> </div>
							<!-- Navbar Menu -->
							<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
								<?php if( isset($_SESSION['code']) ){ ?>
									<!-- Logout    -->
									<li class="nav-item"><a href="close.php" class="nav-link logout">Cerrar Sesión<i class="fa fa-sign-out"></i></a></li>
									<?php }else{ ?>
										<!-- Login -->
										<li class="nav-item"><a href="login.php" class="nav-link logout">Iniciar Sesión<i class="fa fa-sign-in"></i></a></li>
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
								<li class="active">
									<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
								</li>
								<?php if( isset($_SESSION['code']) ){ ?>
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
								<?php }?>
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
														<h3 class="h4">Filtrar Aviones por:</h3>
														<form class="form-horizontal">
															<div class="row">
																<label class="col-sm-4 form-control-label">Submodelo</label>
																<div class="col-sm-8 select">
																	<select id="filtro_submodelo" name="submodelo" class="form-control">
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT DISTINCT as_nombre nombre FROM Submodelo_avion";
																		$rs = pg_query( $conexion, $qry );
																		while( $avion = pg_fetch_object($rs) ){?>
																		<option value="<?php print $avion->nombre;?>">
																			<?php print $avion->nombre;?>
																		</option>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="row">
																<label class="col-sm-4 form-control-label">Distribucion</label>
																<div class="col-sm-8 select">
																	<select id="filtro_distribucion" name="distribucion" class="form-control">
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT DISTINCT di_nombre nombre FROM Distribucion";
																$rs = pg_query( $conexion, $qry );
																while( $avion = pg_fetch_object($rs) ){?>
																			<option value="<?php print $avion->nombre;?>">
																				<?php print $avion->nombre;?>
																			</option>
																			<?php }?>
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
										<?php if( isset($_SESSION['code']) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#ModalCrearModelo" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<div class="card-body table-overflow">
											<table class="table table-striped table-sm table-hover pad-right">
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
													<?php 	
										$qry = "SELECT am_id id, am_nombre nombre, am_longitud longitud, am_altura altura, am_envergadura envergadura, am_velocidad_max velocidad, am_carga_volumen carga, am_capacidad_pilotos pilotos, am_capacidad_asistentes asistentes, am_tiempo_estimado tiempo FROM Modelo_avion ORDER BY am_id";
										$rs = pg_query( $conexion, $qry );
										while( $avion = pg_fetch_object($rs) ){?>
														<tr>
															<td class="text-center text-middle">
																<?php print $avion->id;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->nombre;?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->longitud, 2, ',', '.')." m";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->altura, 1, ',', '.')." m";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->envergadura, 2, ',', '.')." m";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->velocidad, 0, ',', '.')." km/h";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->carga, 1, ',', '.')." m<sup>3</sup>";?></td>
															<td class="text-center text-middle">
																<?php print $avion->pilotos;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->asistentes;?>
															</td>
															<td>
																<?php $dias = $avion->tiempo;$meses = 0; while($dias > 31){$meses+=1; $dias-=30;} print $meses." meses y ".$dias." dias"; ?>
															</td>
															<td class="text-center">
																<a class="click-detalle" href="<?php print $avion->id;?>"> 
																	<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
																</a>&emsp;
																<a href="modeloavion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
																</a>
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
													<h3 class="h4">Filtrar Aviones por:</h3>
													<form class="form-horizontal">
														<div class="row">
															<label class="col-sm-4 form-control-label">Modelo</label>
															<div class="col-sm-8 select">
																<select id="filtro_modelo" name="modelo" class="form-control">
																	<option value="NULL">Seleccionar</option>
																	<?php $qry = "SELECT am_nombre nombre FROM Modelo_avion";
																	$rs = pg_query( $conexion, $qry );
																	while( $avion = pg_fetch_object($rs) ){?>
																	<option value="<?php print $avion->nombre;?>">
																		<?php print $avion->nombre;?>
																	</option>
																	<?php }?>
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
										<?php if( isset($_SESSION['code']) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#myModalSubmodeloCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<div class="card-body table-overflow">
											<table class="table table-striped table-sm table-hover pad-right">
												<thead>
													<tr>
														<th class="text-center text-middle">ID</th>
														<th class="text-center text-middle">Nombre</th>
														<th class="text-center text-middle">Peso Max Despegue</th>
														<th class="text-center text-middle">Peso Vacio</th>
														<th class="text-center text-middle">Velocidad Crucero</th>
														<th class="text-center text-middle">Carrera Despegue Peso Max</th>
														<th class="text-center text-middle">Autono. Peso Max Despegue</th>
														<th class="text-center text-middle">Capacidad Combustible</th>
														<th class="text-center text-middle">Alcance Carga Max</th>
														<th class="text-center">Acción</th>
													</tr>
												</thead>
												<tbody>
													<?php 	
												$qry = "SELECT as_id id, am_nombre ||' - '|| as_nombre as modelo, as_peso_maximo_despegue peso_max, as_peso_vacio peso_vacio, as_velocidad_crucero crucero, as_carrera_despegue_peso_maximo carrera, as_autonomia_peso_maximo_despegue autonomia, as_capacidad_combustible combustible, as_alcance_carga_maxima alcance FROM Submodelo_avion, Modelo_avion where as_modelo_avion=am_id ORDER BY am_id, as_id";
												$rs = pg_query( $conexion, $qry );
												while( $avion = pg_fetch_object($rs) ){?>
														<tr>
															<td class="text-center text-middle">
																<?php print $avion->id;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->modelo;?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->peso_max, 0, ',', '.')." Kg";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->peso_vacio, 0, ',', '.')." Kg";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->crucero, 0, ',', '.')." Km/h";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->carrera, 0, ',', '.')." m";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->autonomia, 0, ',', '.')." Km";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->combustible, 0, ',', '.')." Lts";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->alcance, 0, ',', '.')." m";?>
															</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#myModalDetalleSubmodelo"> 
																	<i title="Ver Mas" class="fa fa-file-text-o" aria-hidden="true"></i> 
																</a>&emsp;
																<a href="submodeloavion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i title="Eliminar" class="fa fa-trash-o" aria-hidden="true"></i> 
																</a>
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
													<h3 class="h4">Filtrar Aviones por:</h3>
													<form class="form-horizontal">
														<div class="row">
															<label class="col-sm-4 form-control-label">Modelo</label>
															<div class="col-sm-8 select">
																<select id="filtro_modelo" name="modelo" class="form-control">
																	<option value="NULL">Seleccionar</option>
																	<?php $qry = "SELECT am_nombre nombre FROM Modelo_avion";
																	$rs = pg_query( $conexion, $qry );
																	while( $avion = pg_fetch_object($rs) ){?>
																	<option value="<?php print $avion->nombre;?>">
																		<?php print $avion->nombre;?>
																	</option>
																	<?php }?>
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
										<?php if( isset($_SESSION['code']) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#myModalDistribucionCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<div class="card-body table-overflow">
											<table class="table table-striped table-sm table-hover pad-right">
												<thead>
													<tr>
														<th class="text-center text-middle">ID</th>
														<th class="text-center text-middle">Modelo Avion</th>
														<th class="text-center text-middle">Distribución</th>
														<th class="text-center text-middle"># Clases</th>
														<th class="text-center text-middle">Capacidad de Pasajeros</th>
														<th class="text-center text-middle">Distancia entre Asientos</th>
														<th class="text-center text-middle">Ancho Asientos</th>
														<th class="text-center">Acción</th>
													</tr>
												</thead>
												<tbody>
													<?php 	
												$qry = "SELECT di_id id, am_nombre modelo, di_nombre distribucion, di_numero_clases clases, di_capacidad_pasajeros capacidad, di_distancia_asientos d_asientos, di_ancho_asientos a_asientos FROM Distribucion, Modelo_avion where di_modelo_avion=am_id ORDER BY am_id, di_id";
												$rs = pg_query( $conexion, $qry );
												while( $avion = pg_fetch_object($rs) ){?>
														<tr>
															<td class="text-center text-middle">
																<?php print $avion->id;?>
															</td>
															<td>
																<?php print $avion->modelo;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->distribucion;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->clases;?>
															</td>
															<td class="text-center text-middle">
																<?php print $avion->capacidad;?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->d_asientos, 1, ',', '.')." cm";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->a_asientos, 1, ',', '.')." cm";?>
															</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#myModalDetalleDistribucion"> 
																	<i title="Ver mas" class="fa fa-file-text-o" aria-hidden="true"></i> 
																</a>&emsp;
																<a href="distribucion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i title="Eliminar" class="fa fa-trash-o" aria-hidden="true"></i> 
																</a>
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
							<!-- Modal Crear Modelo Avion -->
							<div id="ModalCrearModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<form action="modeloavion-crud.php?create=true" method="post">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">Crear Modelo de Avión</h4>
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
																			<h4>Nombre</h4> 
																		</label>
																		<div class="col-sm-9">
																			<input name="nombre" type="text" placeholder="Introduzca Nombre" class="form-control" required> 
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Longitud</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="longitud" type="text" placeholder="Introduzca Longitud" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Envergadura</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="envergadura" type="text" placeholder="Introduzca Envergadura" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Altura</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="altura" type="text" placeholder="Introduzca Altura" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Superficie Alar</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="superficie_alar" type="text" placeholder="Introduzca Superficie Alar" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Flecha Alar</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="flecha_alar" type="text" placeholder="Introduzca Flecha Alar" class="form-control"  pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Peso Maximo de Aterrizaje</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="peso_max_aterrizaje" type="text" placeholder="Introduzca Peso Maximo de Aterrizaje" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Alcance</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="alcance" type="text" placeholder="Introduzca Alcance" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Velocidad Máxima</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="velocidad_max" type="text" placeholder="Introduzca Velocidad Máxima" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Techo de Servicio</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="techo_servicio" type="text" placeholder="Introduzca Techo de Servicio" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Regimen de Ascenso</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="regimen_ascenso" type="text" placeholder="Introduzca Regimen de Ascenso" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Numero de Pasillos</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="numero_pasillos" type="text" placeholder="Introduzca Numero de Pasillos" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class=" form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Tipo de Fuselaje</h4> 
																		</label>
																		<div class="col-sm-9 select">
																			<select name="tipo_fuselaje" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<option value="Ancho">Ancho</option>
																				<option value="Normal">Normal</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Altura de la Cabina</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="altura_cabina" type="text" placeholder="Introduzca Altura de la Cabina" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Ancho de la Cabina</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="ancho_cabina" type="text" placeholder="Introduzca Ancho de la Cabina" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Altura del Fuselaje</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="altura_fuselaje" type="text" placeholder="Introduzca Altura del Fuselaje" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Ancho del Fuselaje</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="ancho_fuselaje" type="text" placeholder="Introduzca Ancho del Fuselaje" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Volumen de Carga</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="volumen_carga" type="text" placeholder="Introduzca Volumen de Carga" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Capacidad de Pilotos</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="capacidad_pilotos" type="text" placeholder="Introduzca Capacidad de Pilotos" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Capacidad de Asistentes de Vuelo</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="capacidad_asistentes" type="text" placeholder="Introduzca Numero de Asistentes" class="form-control" pattern="\d+\.?\d{0,2}" required> 
																		</div>
																	</div>

																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Carrera de Despegue</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="carrera_despegue" type="text" placeholder="Introduzca Carrera de Despegue" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Tiempo Estimado de Elaboración</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="tiempo_estimado" type="text" placeholder="Introduzca Tiempo Estimado" class="form-control" pattern="\d+\.?\d{0,2}" required> 
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
												<button type="submit" class="btn btn-primary">Guardar Cambios</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Modal Crear Modelo Avion ENDS -->
							<!-- Modal Detalle Modelo Avion -->
							<div id="ModalDetalleModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="detalleModeloBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Detalle Modelo Avion ENDS -->
							<!-- Modal Modelo Avion Editar -->
							<div id="ModalEditarModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="editarModeloBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Modelo Avion Editar ENDS -->
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
							<div id="ModalSubmodeloCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="vendor/popper.js/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="js/front.js"></script>
		<script>
			$( "a.click-detalle" ).click(function( event ) {
			  	event.preventDefault();
			  	var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"modeloavion-detalle.php?id="+href,success: function(data){$("#detalleModeloBody").html(data);}});
				$("#ModalDetalleModelo").modal('toggle');
			});
		</script>
	</body>

	</html>