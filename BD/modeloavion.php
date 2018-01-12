<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("am_r", $permiso) && !in_array("as_r", $permiso) && !in_array("di_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: motores.php');
        exit;
    }
}?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>AirUCAB - Avión</title>
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
		<link rel="shortcut icon" href="img/airucab.ico"> </head>

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
						<li>
							<a href="index.php"> <i class="fa fa-space-shuttle" aria-hidden="true"></i> Reportes</a>
						</li>
						<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) ){ ?>
						<li class="active">
							<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
						</li>
						<?php } ?>
                        <?php if (in_array("mb_r", $permiso) || in_array("mm_r", $permiso) || in_array("mo_r", $permiso) ) { ?>
                        <li>
							<a href="motores.php"> <i class="fa fa-tachometer " aria-hidden="true"></i>Motores </a>
						</li>
                        <?php } ?>
                        <?php if( in_array("p_r", $permiso) || in_array("pm_r", $permiso) || in_array("wt_r", $permiso) || in_array("et_r", $permiso) ) { ?>
                        <li>
							<a href="piezas.php"> <i class="fa fa-puzzle-piece " aria-hidden="true"></i>Piezas </a>
						</li>
                        <?php } ?>
                        <?php if( in_array("m_r", $permiso) || in_array("tm_r", $permiso) ) { ?>
                        <li>
							<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
						</li>
                        <?php } ?>
                        <?php if( in_array("fv_r", $permiso) ){ ?>
						<li>
							<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
						</li>
						<?php } ?>
                        <?php if( in_array("fc_r", $permiso) ){ ?>
						<li>
							<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
						</li>
						<?php } ?>
                        <?php if( in_array("se_r", $permiso) || in_array("zo_r", $permiso) ){ ?>
                        <li>
							<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
						</li>
                        <?php } ?>
						<?php if( in_array("em_r", $permiso) || in_array("sr_r", $permiso) || in_array("er_r", $permiso) || in_array("ti_r", $permiso) || in_array("pe_r", $permiso) || in_array("rp_r", $permiso) || in_array("ct_r", $permiso) ){ ?>
						<li>
							<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
						</li>
						<?php } ?>
						<?php if( in_array("cl_r", $permiso) ){ ?>
						<li>
							<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
						</li>
						<?php } ?>
						<?php if( in_array("po_r", $permiso) ){ ?>
						<li>
							<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
						</li>
						<?php } ?>
						<?php if( in_array("pr_r", $permiso) ){ ?>
						<li>
							<a href="pruebas.php"> <i class="fa fa-check-square-o " aria-hidden="true"></i>Pruebas </a>
						</li>
                        <?php } ?>
                        <?php if( in_array("tr_r", $permiso) ){ ?>
						<li>
							<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
						</li>
						<?php } ?>
					</ul>
				</nav>
				<div class="content-inner">
					<?php if(isset($_GET['error'])){?>
					<!-- Alert -->
					<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
						<?php if($_GET['error']==1){?>Error al crear <strong>Modelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==2){?>Error al editar <strong>Modelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==3){?>Error al eliminar <strong>Modelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==4){?>Error al crear <strong>Submodelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==5){?>Error al editar <strong>Submodelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==6){?>Error al eliminar <strong>Submodelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==60){?>Debe existir al menos un <strong>Submodelo de Avión</strong> por cada <strong>Modelo de Avión</strong>.<?php }?>
						<?php if($_GET['error']==7){?>Error al crear <strong>Distribución de Avión</strong>.<?php }?>
						<?php if($_GET['error']==8){?>Error al editar <strong>Distribución de Avión</strong>.<?php }?>
						<?php if($_GET['error']==9){?>Error al eliminar <strong>Distribución de Avión</strong>.<?php }?>
						<?php if($_GET['error']==90){?>Debe existir al menos una <strong>Distribución de Avión</strong> por cada <strong>Modelo de Avión</strong>.<?php }?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php }?>
					<!-- Section de TABS-->
					<section>
						<div class="container-fluid">
							<?php if( in_array("am_r", $permiso) ){?>
							<input id="tab0" type="radio" name="tabs" class="no-display" <?php if( !isset($_GET['tab']) ) print "checked";?>>
							<label for="tab0" class="label"><i class="fa fa-plane" aria-hidden="true"></i> Modelos Aviones</label>
							<?php }?>
							<?php if( in_array("as_r", $permiso) ){?>
							<input id="tab1" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "submodelo" || ( !in_array("di_r", $permiso) && !in_array("am_r", $permiso) ) ) print "checked";?>>
							<label for="tab1" class="label"><i class="fa fa-rocket" aria-hidden="true"></i> Submodelos Aviones</label>
							<?php }?>
							<?php if( in_array("di_r", $permiso) ){?>
							<input id="tab2" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "distribucion" || ( !in_array("as_r", $permiso) && !in_array("am_r", $permiso) ) ) print "checked";?>>
							<label for="tab2" class="label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Distribucion</label>
							<?php }?>
							<?php if( in_array("am_r", $permiso) && in_array("as_r", $permiso) && in_array("di_r", $permiso) ){?>
							<input id="tab3" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "reporte") print "checked";?>>
							<label for="tab3" class="label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Modelos - Reporte</label>
							<?php }?>
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
															<input type="submit" value="Filtrar" class="btn btn-primary">
														</div>
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
										<?php if( in_array("am_c", $permiso) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#ModalCrearModelo" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<?php if( in_array("am_r", $permiso) ){?>
										<?php $qry = "SELECT am_id id, am_nombre nombre, am_longitud longitud, am_altura altura, am_envergadura envergadura, am_velocidad_max velocidad, am_carga_volumen carga, am_capacidad_pilotos pilotos, am_capacidad_asistentes asistentes, am_tiempo_estimado tiempo FROM Modelo_avion ORDER BY am_id";
										$rs = pg_query( $conexion, $qry );
										$howMany = pg_num_rows($rs);
										if( $howMany > 0 ){?>
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
														
														while( $avion = pg_fetch_object($rs) ){
															$dias = $avion->tiempo + 1;
															$hoy = new DateTime();
															$fin = new DateTime(date('Y-m-d', strtotime($hoy->format("Y-m-d"). ' + '.$dias.' days')));
															$interval = $hoy->diff($fin);?>
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
																<?php print $interval->format('%m meses y %d días'); ?>
															</td>
															<td class="text-center">
																<a class="click-modelo-detalle" href="<?php print $avion->id;?>"> 
																	<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
																</a>
																<?php if( in_array("am_d", $permiso) ){ ?>&emsp;
																<a href="modeloavion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
																</a>
																<?php }?>
															</td>
														</tr>
														<?php }?>
												</tbody>
											</table>
										</div>
										<?php }else{?>
										<h3>&emsp;No se han encontrado resultados.</h3>
										<?php }}?>
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
										<?php if( in_array("as_c", $permiso) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#ModalCrearSubmodelo" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<?php if( in_array("as_r", $permiso) ){?>
										<?php $qry = "SELECT as_id id, am_nombre ||' - '|| as_nombre as modelo, as_peso_maximo_despegue peso_max, as_peso_vacio peso_vacio, as_velocidad_crucero crucero, as_carrera_despegue_peso_maximo carrera, as_capacidad_combustible combustible, as_alcance_carga_maxima alcance FROM Submodelo_avion, Modelo_avion where as_modelo_avion=am_id ORDER BY am_id, as_id";
										$rs = pg_query( $conexion, $qry );
										$howMany = pg_num_rows($rs);
										if( $howMany > 0 ){?>
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
														<th class="text-center text-middle">Capacidad Combustible</th>
														<th class="text-center text-middle">Alcance Carga Max</th>
														<th class="text-center">Acción</th>
													</tr>
												</thead>
												<tbody>
													<?php while( $avion = pg_fetch_object($rs) ){?>
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
																<?php print number_format($avion->combustible, 0, ',', '.')." Lts";?>
															</td>
															<td class="text-center text-middle">
																<?php print number_format($avion->alcance, 0, ',', '.')." m";?>
															</td>
															<td class="text-center">
                                                                <?php if( in_array("p_r", $permiso) ) { ?>&nbsp;
																<a class="click-submodelo-piezas" href="<?php print $avion->id;?>"> 
																	<i class="fa fa-cogs" aria-hidden="true" title="Ver piezas"></i> 
																</a><?php }?>&nbsp;
																<a class="click-submodelo-detalle" href="<?php print $avion->id;?>"> 
																	<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
																</a>
																<?php if( in_array("as_d", $permiso) ){ ?>&nbsp;
																<a href="submodeloavion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i title="Eliminar" class="fa fa-trash-o" aria-hidden="true"></i> 
																</a>
																<?php }?>
															</td>
														</tr>
														<?php }?>
												</tbody>
											</table>
										</div>
										<?php }else{?>
										<h3>&emsp;No se han encontrado resultados.</h3>
										<?php }}?>
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
										<?php if( in_array("di_c", $permiso) ){ ?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#ModalCrearDistribucion" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php } ?>
										<?php if( in_array("di_r", $permiso) ){?>
										<?php $qry = "SELECT di_id id, am_nombre modelo, di_nombre distribucion, di_numero_clases clases, di_capacidad_pasajeros capacidad, di_distancia_asientos d_asientos, di_ancho_asientos a_asientos FROM Distribucion, Modelo_avion where di_modelo_avion=am_id ORDER BY am_id, di_id";
										$rs = pg_query( $conexion, $qry );
										$howMany = pg_num_rows($rs);
										if( $howMany > 0 ){?>
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
													<?php while( $avion = pg_fetch_object($rs) ){?>
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
																<a class="click-distribucion-detalle" href="<?php print $avion->id;?>"> 
																	<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
																</a>
																<?php if( in_array("di_d", $permiso) ){ ?>&emsp;
																<a href="distribucion-crud.php?delete=<?php print $avion->id;?>"> 
																	<i title="Eliminar" class="fa fa-trash-o" aria-hidden="true"></i> 
																</a>
																<?php }?>
															</td>
														</tr>
														<?php }?>
												</tbody>
											</table>
										</div>
										<?php }else{?>
										<h3>&emsp;No se han encontrado resultados.</h3>
										<?php }}?>
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
												<button type="submit" class="btn btn-primary">Crear</button>
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
							<!-- Modal Crear Submodelo Avion -->
							<div id="ModalCrearSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<form action="submodeloavion-crud.php?create=true" method="post">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">Crear Submodelo de Avión</h4>
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
																			<h4>Modelo de Avión</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select name="modelo" class="form-control">
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT am_id AS id, am_nombre AS nombre FROM Modelo_avion";
																				$rs = pg_query( $conexion, $qry );
																				while( $modelo = pg_fetch_object($rs) ){?>
																				<option value="<?php print $modelo->id;?>">
																					<?php print $modelo->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
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
																			<h4>Peso Máximo de Despegue</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="peso_max" type="text" placeholder="Introduzca Peso Maximo de Despegue" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Peso Vacio</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="peso_vacio" type="text" placeholder="Introduzca Peso Vacio" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Carrera de Despegue con Peso Máximo</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="carrera_despegue" type="text" placeholder="Introduzca Carrera de Despegue con Peso Máximo" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4># de Motores</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="n_motores" type="text" placeholder="Introduzca Numero de motores" class="form-control" pattern="\d+" required>
																		</div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Velocidad Crucero</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="velocidad_crucero" type="text" placeholder="Introduzca Velocidad Crucero" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Autonomia de Despegue con Peso Máximo</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="autonomia" type="text" placeholder="Introduzca Autonomia de Despegue con Peso Máximo" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Capacidad de Combustible</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="capacidad_combustible" type="text" placeholder="Introduzca Capacidad de Combustible" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Alcance con Carga Maxima</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="alcance" type="text" placeholder="Introduzca Alcance con Carga Maxima" class="form-control" pattern="\d+\.?\d{0,2}" required>
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
												<button type="submit" class="btn btn-primary">Crear</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Modal Crear Submodelo Avion ENDS -->
							<!-- Modal Detalle Submodelo Avion -->
							<div id="ModalDetalleSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="detalleSubmodeloBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Detalle Submodelo Avion ENDS -->
							<!-- Modal Piezas Submodelo Avion -->
							<div id="ModalPiezaSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="piezaSubmodeloBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Piezas Submodelo Avion ENDS -->
							<!-- Modal Submodelo Avion Editar -->
							<div id="ModalEditarSubmodelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="editarSubmodeloBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Submodelo Avion Editar ENDS -->
							<!-- Modal Distribucion Avion Crear -->
							<div id="ModalCrearDistribucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<form action="distribucion-crud.php?create=true" method="post">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">Crear Distribución de Avión</h4>
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
																			<h4>Modelo de Avión</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select name="modelo" class="form-control">
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT am_id AS id, am_nombre AS nombre FROM Modelo_avion";
																				$rs = pg_query( $conexion, $qry );
																				while( $modelo = pg_fetch_object($rs) ){?>
																				<option value="<?php print $modelo->id;?>">
																					<?php print $modelo->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
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
																			<h4>Capacidad de Pasajeros</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="capacidad_pasajeros" type="text" placeholder="Introduzca Capacidad de Pasajeros" class="form-control" pattern="\d+" required>
																		</div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Numero de Clases</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="numero_clases" type="text" placeholder="Introduzca Numero de Clases" class="form-control" pattern="\d+" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Distancia entre Asientos</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="distancia_asientos" type="text" placeholder="Introduzca Distancia entre Asientos" class="form-control" pattern="\d+\.?\d{0,2}" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Acho de Asientos</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="ancho_asientos" type="text" placeholder="Introduzca Ancho de Asientos" class="form-control" pattern="\d+\.?\d{0,2}" required>
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
												<button type="submit" class="btn btn-primary">Crear</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Modal Distribucion Avion Crear ENDS -->
							<!-- Modal Detalle Ditribucion Avion -->
							<div id="ModalDetalleDistribucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="detalleDistribucionBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Detalle Distribucion Avion ENDS -->
							<!-- Modal Distribucion Avion Editar -->
							<div id="ModalEditarDistribucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="editarDistribucionBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Distribucion Avion Editar ENDS -->
							<section id="content3" class="sectiontab">
								<!-- TABLE STARTS -->
								<div class="col-md-12">
									<div class="card">
										<?php if( in_array("di_r", $permiso) ){?>
										<?php $qry = "Select am_id id, am_nombre nombre, am_longitud longitud, am_envergadura envergadura, am_altura altura, am_ala_superficie superficie_alar, am_ala_flecha flecha_alar, am_peso_aterrizaje_max peso_maximo_aterrizaje, am_alcance alcance, am_velocidad_max velocidad_max, am_techo_servicio techo_servicio, am_regimen_ascenso regimen_ascenso, am_numero_pasillos numero_pasillos, am_fuselaje_tipo tipo_fuselaje, am_fuselaje_altura altura_fuselaje, am_fuselaje_ancho ancho_fuselaje, am_cabina_altura altura_cabina, am_cabina_ancho ancho_cabina, am_carga_volumen volumen_carga, am_capacidad_pilotos capacidad_pilotos, am_capacidad_asistentes capacidad_asistentes, am_carrera_despegue carrera_despegue, am_tiempo_estimado tiempo_estimado from modelo_avion Order by am_nombre";
										$rs = pg_query( $conexion, $qry );
										$howMany = pg_num_rows($rs);
										if( $howMany > 0 ){?>
										<div class="card-body">
											<div class="table-responsive-md">
												<table class="table table-bordered table-striped table-sm table-hover pad-right">
													<thead>
														<tr>
															<th class="text-center text-middle">Medidas</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<th class="text-center text-middle"><?php print $avion->nombre;?></th>
															<?php }?>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th class="text-center text-middle">Longitud</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->longitud, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Envergadura</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->envergadura, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Altura</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->altura, 1, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Superficie Alar</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->superficie_alar, 0, ',', '.')." m<sup>2</sup>";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Flecha Alar</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->flecha_alar, 2, ',', '.')."°";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Peso Maximo de Aterrizaje</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->peso_maximo_aterrizaje, 0, ',', '.')." Kg";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Alcance</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->alcance, 0, ',', '.')." Km";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Velocidad Maxima</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->velocidad_max, 0, ',', '.')." Km/h";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Techo de Servicio</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->techo_servicio, 0, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Regimen de Ascenso</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->regimen_ascenso, 1, ',', '.')." m/s";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Numero de Pasillos</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->numero_pasillos, 0, ',', '.');?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Tipo de Fuselaje</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print $avion->tipo_fuselaje;?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Altura de Fuselaje</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->altura_fuselaje, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Ancho de Fuselaje</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->ancho_fuselaje, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Altura de Cabina</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->altura_cabina, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Ancho de Cabina</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->ancho_cabina, 2, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Volumen de Carga</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->volumen_carga, 1, ',', '.')." m<sup>3</sup>";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Tripulación</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print $avion->capacidad_pilotos.$avion->capacidad_asistentes;?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Carrera de Despegue</th>
															<?php $rs = pg_query( $conexion, $qry );
															   while( $avion = pg_fetch_object($rs) ){?>
															<td class="text-center text-middle"><?php print number_format($avion->carrera_despegue, 0, ',', '.')." m";?></td>
															<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Peso Maximo de Despegue</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->peso_maximo_despegue, 0, ',', '.')." Kg <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->peso_maximo_despegue, 0, ',', '.')." Kg";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Peso Vacio</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->peso_vacio, 0, ',', '.')." Kg <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->peso_vacio, 0, ',', '.')." Kg";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Velocidad Crucero</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->velocidad_crucero, 0, ',', '.')." Km/h <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->velocidad_crucero, 0, ',', '.')." Km/h";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Carrera de despegue con Peso Max</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->carrera_despegue, 0, ',', '.')." m <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->carrera_despegue, 0, ',', '.')." m";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Autonomia de Peso Max de Despegue</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->autonomia_peso_max, 0, ',', '.')." Km <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->autonomia_peso_max, 0, ',', '.')." Km";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Capacidad de Combustible</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->capacidad_combustible, 0, ',', '.')." Lts <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->capacidad_combustible, 0, ',', '.')." Lts";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Alcance con Carga Maxima</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->alcance_carga_maxima, 0, ',', '.')." Km <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->alcance_carga_maxima, 0, ',', '.')." Km";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Cantidad de Motores</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "select as_nombre nombre, as_peso_maximo_despegue peso_maximo_despegue, as_peso_vacio peso_vacio, as_velocidad_crucero velocidad_crucero, as_carrera_despegue_peso_maximo carrera_despegue, as_autonomia_peso_maximo_despegue autonomia_peso_max, as_capacidad_combustible capacidad_combustible, as_alcance_carga_maxima alcance_carga_maxima, as_cantidad_motor cantidad_motores From submodelo_avion Where as_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print "<strong>".$submodelo->nombre.":</strong> ".number_format($submodelo->cantidad_motores, 0, ',', '.')." <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->cantidad_motores, 0, ',', '.');
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Numero de Clases</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "Select di_nombre nombre, di_numero_clases numero_clases, di_capacidad_pasajeros capacidad_pasajeros, di_distancia_asientos distancia_asientos, di_ancho_asientos ancho_asientos from Distribucion Where di_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print $submodelo->nombre.": ".number_format($submodelo->numero_clases, 0, ',', '.')." <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->numero_clases, 0, ',', '.');
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Capacidad de Pasajeros</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "Select di_nombre nombre, di_numero_clases numero_clases, di_capacidad_pasajeros capacidad_pasajeros, di_distancia_asientos distancia_asientos, di_ancho_asientos ancho_asientos from Distribucion Where di_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print $submodelo->nombre.": ".number_format($submodelo->capacidad_pasajeros, 0, ',', '.')." <br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->capacidad_pasajeros, 0, ',', '.');
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Distancia entre Asientos</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "Select di_nombre nombre, di_numero_clases numero_clases, di_capacidad_pasajeros capacidad_pasajeros, di_distancia_asientos distancia_asientos, di_ancho_asientos ancho_asientos from Distribucion Where di_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print $submodelo->nombre.": ".number_format($submodelo->distancia_asientos, 1, ',', '.')." cm<br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->distancia_asientos, 1, ',', '.')." cm";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Ancho de Asientos</th>
															<?php $qry2 = "Select am_id id From modelo_avion Order by am_nombre";
														   		$ids = pg_query( $conexion, $qry2 );
															   	while( $avion = pg_fetch_object($ids) ){?>
																<td class="text-center text-middle">
																	<?php
																	$qry3 = "Select di_nombre nombre, di_numero_clases numero_clases, di_capacidad_pasajeros capacidad_pasajeros, di_distancia_asientos distancia_asientos, di_ancho_asientos ancho_asientos from Distribucion Where di_modelo_avion=".$avion->id;
																	$sub = pg_query( $conexion, $qry3 );
																	if(pg_num_rows($sub)>1){
																		while( $submodelo = pg_fetch_object($sub) )
																			print $submodelo->nombre.": ".number_format($submodelo->ancho_asientos, 1, ',', '.')." cm<br/>";
																	}
																	else{
																		$submodelo = pg_fetch_object($sub);
																		print number_format($submodelo->ancho_asientos, 1, ',', '.')." cm";
																	}
																	?>
																</td>
																<?php }?>
														</tr>
														<tr>
															<th class="text-center text-middle">Tiempo de Fabricación (Aprox)</th>
															<?php $rs = pg_query( $conexion, $qry );
																while( $avion = pg_fetch_object($rs) ){
																$dias = $avion->tiempo_estimado + 1;
																$hoy = new DateTime();
																$fin = new DateTime(date('Y-m-d', strtotime($hoy->format("Y-m-d"). ' + '.$dias.' days')));
																$interval = $hoy->diff($fin);?>
															<td class="text-center text-middle"><?php print $interval->format('%m meses y %d días');?></td>
															<?php }?>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<?php }else{?>
										<h3>&emsp;No se han encontrado resultados.</h3>
										<?php }}?>
									</div>
								</div>
								<!-- TABLE ENDS -->
							</section>
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
			$( "a.click-modelo-detalle" ).click(function( event ) {
			  	event.preventDefault();
			  	var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"modeloavion-detalle.php?id="+href,success: function(data){$("#detalleModeloBody").html(data);}});
				$("#ModalDetalleModelo").modal('toggle');
			});
			$( "a.click-submodelo-detalle" ).click(function( event ) {
			  	event.preventDefault();
			  	var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"submodeloavion-detalle.php?id="+href,success: function(data){$("#detalleSubmodeloBody").html(data);}});
				$("#ModalDetalleSubmodelo").modal('toggle');
			});
			$( "a.click-submodelo-piezas" ).click(function( event ) {
			  	event.preventDefault();
			  	var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"submodeloavion-piezas.php?id="+href,success: function(data){$("#piezaSubmodeloBody").html(data);}});
				$("#ModalPiezaSubmodelo").modal('toggle');
			});
			$( "a.click-distribucion-detalle" ).click(function( event ) {
			  	event.preventDefault();
			  	var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"distribucion-detalle.php?id="+href,success: function(data){$("#detalleDistribucionBody").html(data);}});
				$("#ModalDetalleDistribucion").modal('toggle');
			});
		</script>
	</body>

	</html>