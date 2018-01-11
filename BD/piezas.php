<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("p_r", $permiso) && !in_array("pm_r", $permiso) && !in_array("wt_r", $permiso) && !in_array("et_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: materiales.php');
		exit;
    }
}?>
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
							<li class="nav-item"><a href="login.php" class="nav-link logout">Cerrar Sesion<i class="fa fa-sign-out"></i></a></li>
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
						<a href="index.php"> <i class="fa fa-space-shuttle" aria-hidden="true"></i> Reportes </a>
					</li>
				    <?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) ){ ?>
				    <li>
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
					<?php } ?>
                    <?php if (in_array("mb_r", $permiso) || in_array("mm_r", $permiso) || in_array("mo_r", $permiso) ) { ?>
                    <li>
						<a href="motores.php"> <i class="fa fa-tachometer " aria-hidden="true"></i>Motores </a>
					</li>
                    <?php } ?>
                    <?php if( in_array("p_r", $permiso) || in_array("pm_r", $permiso) || in_array("wt_r", $permiso) || in_array("et_r", $permiso) ) { ?>
                    <li class="active">
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
					<?php if( in_array("em_r", $permiso) || in_array("sr_r", $permiso) || in_array("er_r", $permiso) || in_array("ti_r", $permiso) || in_array("pe_r", $permiso) ){ ?>
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
				<!-- Section de TABS -->
				<section>
					<div class="container-fluid">
                        <?php if( in_array("p_r", $permiso) ){?>
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Piezas</label>
                        <?} php if( in_array("pm_r", $permiso) ){?>
						<input id="tab1" type="radio" name="tabs" class="no-display" >
						<label for="tab1" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Modelo Piezas</label>
                        <?} php if( in_array("wt_r", $permiso) ){?>
						<input id="tab2" type="radio" name="tabs" class="no-display" >
						<label for="tab2" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Tipo Ala</label>
                        <?} php if( in_array("et_r", $permiso) ){?>
						<input id="tab3" type="radio" name="tabs" class="no-display" >
						<label for="tab3" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Tipo Estabilizador</label>
                        <?php }?>
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
                                    <?php if( in_array("p_c", $permiso) ){?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalPiezaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php } if( in_array("p_r", $permiso) ){?>
								    <?php $qry = "SELECT p_id id, pm_nombre nombre, p_fecha_fin fin, (SELECT MAX(st_nombre) FROM Status,Status_pieza WHERE spi_pieza=p_id AND spi_status=st_id) status, a_id ||' - '|| am_nombre ||'/'|| as_nombre AS avion FROM Pieza LEFT JOIN Modelo_pieza ON p_modelo_pieza=pm_id LEFT JOIN Status_pieza ON spi_pieza=p_id LEFT JOIN Avion ON p_avion=a_id LEFT JOIN Submodelo_avion ON a_submodelo_avion=as_id LEFT JOIN Modelo_avion ON as_modelo_avion=am_id GROUP BY id, nombre, avion ORDER BY p_id";
									$rs = pg_query( $conexion, $qry );
									$howMany = pg_num_rows($rs);
									if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
													<th class="text-center">Status</th>
													<th class="text-center">Tiempo Estimado</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $pieza = pg_fetch_object($rs) ){
                                                $dias = $pieza->tiempo + 1;
												$hoy = new DateTime();
                                                $fin = new DateTime($pieza->fin);
												$interval = $hoy->diff($fin);?>
												<tr>
													<td class="text-center">
                                                        <?php print $pieza->id;?>
                                                    </td>
													<td class="text-center">
                                                        <?php print $pieza->nombre;?>
                                                    </td>
													<td class="text-center">
                                                        <?php if($pieza->status == "Listo") {?>
                                                            <span class="badge badge-success">
                                                                <?php print $pieza->status;?>
                                                            </span>                                                        
                                                            <?php } elseif($pieza->status == "Rechazado") {?>
                                                            <span class="badge badge-danger">
                                                                <?php print $pieza->status;?>
                                                            </span>                                                          
                                                            <?php } else {?>
                                                            <span class="badge badge-info">
                                                                <?php print $pieza->status;?>
                                                            </span>
                                                            <?php } ?>    
                                                    </td>
													<td class="text-center">
                                                        <?php print $interval->format('%m meses y %d días');?>
                                                    </td>
													<td class="text-center">
														<a href="<?php print $pieza->id ?>" data-toggle="modal" data-target="#ModalPieza"> 
                                                            <i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
                                                        </a>
                                                        <?php if( in_array("p_d", $permiso) ){ ?>&emsp;
														<a href="pieza-crud.php?delete=<?php print $pieza->id ?>"> 
                                                            <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
                                                        </a>
                                                        <?php }?>
													</td>
												</tr>
												<?php }?>													
											</tbody>
                                            
										</table>
									</div>
                                    <?php }}?>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						<!-- TAB MODELO PIEZAS -->
						<section id="content1" class="sectiontab">
							<!-- Filtrador -->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">Filtrar Pieza por:</h3>
													<form class="form-horizontal" method="post">
														<div class="row">
															<label class="col-sm-3 form-control-label">Modelo</label>
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
                                    <?php if( in_array("pm_c", $permiso) ){?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalModeloPiezaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php } if( in_array("pm_r", $permiso) ){
                                    $qry="SELECT pm.pm_id id, pm.pm_nombre nombre, wt_nombre ala, et_nombre estabilizador, count(pm2.pm_modelo_pieza) subcomponente, pm.pm_tiempo_estimado tiempo FROM modelo_pieza pm2 FULL JOIN Modelo_pieza pm ON pm2.pm_modelo_pieza = pm.pm_id LEFT JOIN Tipo_ala ON pm.pm_tipo_ala=wt_id LEFT JOIN Tipo_estabilizador ON pm.pm_tipo_estabilizador=et_id GROUP BY pm.pm_id, ala, estabilizador ORDER BY pm.pm_id";
                                    $rs = pg_query($conexion, $qry);
                                    $howMany = pg_num_rows($rs);
                                    if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
													<th class="text-center"># de Subcomponentes</th>
													<th class="text-center">Tiempo estimado</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $modelo_pieza = pg_fetch_object( $rs) ){
                                                $dias = $modelo_pieza->tiempo + 1;
												$hoy = new DateTime();
												$fin = new DateTime(date('Y-m-d', strtotime($hoy->format("Y-m-d"). ' + '.$dias.' days')));
												$interval = $hoy->diff($fin);?>
												<tr>
													<td class="text-center">
                                                        <?php print $modelo_pieza->id;?>
                                                    </td>
													<td class="text-center">
                                                        <?php 
                                                        print $modelo_pieza->nombre;
                                                        if( isset($modelo_pieza->ala) || isset($modelo_pieza->estabilizador)){
                                                            print " - $modelo_pieza->ala $modelo_pieza->estabilizador";
                                                        }?>
                                                    </td>
													<td class="text-center">
                                                        <?php if($modelo_pieza->subcomponente > 0)print $modelo_pieza->subcomponente;?>
                                                    </td>
													<td class="text-center">
                                                        <?php print $interval->format('%m meses y %d días'); ?>
                                                    </td>
													<td class="text-center">
                                                        <?php if( $modelo_pieza->subcomponente > 0){?>
														<a href="<?php print $modelo_pieza->id;?>" data-toggle="modal" data-target="#ModalModeloPieza"> 
                                                            <i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
                                                        </a>
                                                        <?php }?>
                                                        <?php if( in_array("pm_d", $permiso) ){?> &emsp;
														<a href="modelo_pieza.php?delete=<?php print $modelo_pieza->id;?>"> 
                                                            <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
                                                        </a>
                                                        <?php }?>
													</td>
												</tr>													
												<?php }?>
											</tbody>
										</table>
									</div>
                                    <?php }}?>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>

						<!-- TAB Tipo Ala -->
						<section id="content2" class="sectiontab">
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
                                    <?php if( in_array("wt_c", $permiso)){?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalTipoAlaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php }?>
                                    <?php if( in_array("wt_r", $permiso) ){
                                    $qry="SELECT wt_id id, wt_nombre nombre FROM Tipo_ala";
                                    $rs = pg_query($conexion, $qry);
                                    $howMany = pg_num_rows($rs);
                                    if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
													<th class="text-right">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $ala = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center">
                                                        <?php print $ala->id;?>
                                                    </td>
													<td class="text-center">
                                                        <?php print $ala->nombre;?>
                                                    </td>
													<td class="text-right">
														<a href="<?php print $ala->id;?>" data-toggle="modal" data-target="#ModalTipoAla">
                                                            <i class="fa fa-pencil" aria-hidden="true" title="Editar"></i>
                                                        </a>
                                                        <?php if( in_array("wt_d", $permiso)){?> &emsp;
														<a href="tipo_ala-crud.php?delete=<?php print $ala->id;?>"> 
                                                            <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i>
                                                        </a>
                                                        <?php }?>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
                                    <?php }}?>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>

						<!-- TAB Tipo Estabilizador -->
						<section id="content3" class="sectiontab">
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
                                    <?php if( in_array("et_r", $permiso) ){?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalTipoEstabilizadorCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php }?>
                                    <?php if( in_array("et_r", $permiso) ){?>
									<?php $qry = "SELECT et_id id, et_nombre nombre FROM Tipo_estabilizador";
									$rs = pg_query( $conexion, $qry );
									$howMany = pg_num_rows($rs);
									if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">Nombre</th>
													<th class="text-right">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $estabilizador = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center">
                                                        <?php print $estabilizador->id;?>
                                                    </td>
													<td class="text-center">
                                                        <?php print $estabilizador->nombre;?>
                                                    </td>
													<td class="text-right">
														<a href="<?php print $estabilizador->id;?>" data-toggle="modal" data-target="#ModalTipoEstabilizador"> 
                                                            <i class="fa fa-pencil" aria-hidden="true" title="Editar"></i> 
                                                        </a>
                                                        <?php if( in_array("et_d", $permiso)){?> &emsp;
														<a href="tipo_estabilizador-crud.php?delete=<?php print $estabilizador->id;?>"> 
                                                            <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
                                                        </a>
                                                        <?php }?>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
                                    <?php }}?>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						<!-- Modal Pieza Informacion -->
						<div id="ModalPieza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION PIEZA</h4>
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
																	<h3>Cantidad</h3> </div>
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
                                        <?php if( in_array("p_u", $permiso)){?>
										<button type="button" data-toggle="modal" data-target="#myModalPiezaEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Piezas Informacion ENDS -->

						
						<!-- Modal Modelo Pieza Informacion -->
						<div id="ModalModeloPieza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION PIEZA</h4>
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
																	<h3>Cantidad</h3> </div>
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
										<!-- Tabla Piezas STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">MATERIALES NECESARIOS</h3> </div>
												<div class="card-body">
													
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th>ID</th>
																<th>MATERIAL</th>
																<th>PRECIO UNITARIO</th>
																<th>CANTIDAD</th>
																<th>ESTATUS</th>
																<th class="text-center">Accion</th>
															</tr>
														</thead>
														<tbody>
														
															<tr>
																<td>3</td>
																<td>Arena</td>
																<td>2.00</td>
																<td>24</td>
																<td><span class="badge badge-info">DISPONIBLE</span></td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalPieza"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td>7</td>
																<td>Plomo</td>
																<td>5.00</td>
																<td>7</td>
																<td><span class="badge badge-danger">EN TRAYECTO</span></td>
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
                                        <?php if( in_array("pm_u", $permiso)){?>
										<button type="button" data-toggle="modal" data-target="#myModalModeloPiezaEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Modelo Piezas Informacion ENDS -->

						<!-- Modal Tipo Ala Informacion -->
						<div id="ModalTipoAla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION TIPO ALA</h4>
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
																	<h3>Cantidad</h3> </div>
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
										<!-- Tabla Piezas STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">MATERIALES NECESARIOS</h3> </div>
												<div class="card-body">
													
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th>ID</th>
																<th>MATERIAL</th>
																<th>PRECIO UNITARIO</th>
																<th>CANTIDAD</th>
																<th>ESTATUS</th>
																<th class="text-center">Accion</th>
															</tr>
														</thead>
														<tbody>
														
															<tr>
																<td>3</td>
																<td>Arena</td>
																<td>2.00</td>
																<td>24</td>
																<td><span class="badge badge-info">DISPONIBLE</span></td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalPieza"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td>7</td>
																<td>Plomo</td>
																<td>5.00</td>
																<td>7</td>
																<td><span class="badge badge-danger">EN TRAYECTO</span></td>
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
                                        <?php if( in_array("wt_u", $permiso)){?>
										<button type="button" data-toggle="modal" data-target="#myModalTipoAlaEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Tipo Ala Informacion ENDS -->

						<!-- Modal Tipo Estabilizador Informacion -->
						<div id="ModalTipoEstabilizador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION TIPO ESTABILIZADOR</h4>
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
																	<h3>Cantidad</h3> </div>
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
										<!-- Tabla Piezas STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">MATERIALES NECESARIOS</h3> </div>
												<div class="card-body">
													
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th>ID</th>
																<th>MATERIAL</th>
																<th>PRECIO UNITARIO</th>
																<th>CANTIDAD</th>
																<th>ESTATUS</th>
																<th class="text-center">Accion</th>
															</tr>
														</thead>
														<tbody>
														
															<tr>
																<td>3</td>
																<td>Arena</td>
																<td>2.00</td>
																<td>24</td>
																<td><span class="badge badge-info">DISPONIBLE</span></td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalPieza"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<tr>
																<td>7</td>
																<td>Plomo</td>
																<td>5.00</td>
																<td>7</td>
																<td><span class="badge badge-danger">EN TRAYECTO</span></td>
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
                                        <?php if(in_array("et_u", $permiso)){?>
										<button type="button" data-toggle="modal" data-target="#myModalTipoEstabilizadorEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Tipo Estabilizador Informacion ENDS -->

												
						<!-- Modal Piezas Editar -->
						<div id="myModalPiezaEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION PIEZA</h4>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Final</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha Final" class="form-control"> </div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
						<!-- Modal Piezas Editar ENDS -->

						<!-- Modal Modelo Piezas Editar -->
						<div id="myModalModeloPiezaEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION PIEZA</h4>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Final</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha Final" class="form-control"> </div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Modelo Piezas Editar ENDS -->

						<!-- Modal Tipo Ala Editar -->
						<div id="myModalTipoAlaEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION TIPO ALA</h4>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Final</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha Final" class="form-control"> </div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Tipo Ala Editar ENDS -->

						<!-- Modal Tipo Estabilizador Editar -->
						<div id="myModalTipoEstabilizadorEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDICION TIPO ESTABILIZADOR</h4>
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
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha Final</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha Final" class="form-control"> </div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Tipo Estabilizador Editar ENDS -->

						<!-- Modal Piezas Crear -->
						<div id="myModalPiezaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR PIEZA</h4>
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
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																	<h3>Parte de:</h3> </label>
																<div class="card-body col-lg-12">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> Ala
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" name="tipo_pago" type="radio"> Submodelo Avion 
																		</label>
																	</div>
																	<div class="pago-space row">
																	</div>
																</div>
																<label class="col-sm-3 form-control-label">Ala</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Ala cuadrada 1</option>
																		<option>Ala redonda 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
																<label class="col-sm-3 form-control-label">Submodelo Avion</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>4515 1</option>
																		<option>54578 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
						<!-- Modal Piezas Crear ENDS -->

						<!-- Modal Modelo Piezas Crear -->
						<div id="myModalModeloPiezaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR MODELO PIEZA</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Informacion Modelo Pieza</h4>
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
																	<h3>Fecha Inicio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha de Inicio" class="form-control"> </div>
															</div>
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																	<h3>Parte de:</h3> </label>
																<div class="card-body col-lg-12">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> Ala
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" name="tipo_pago" type="radio"> Submodelo Avion 
																		</label>
																	</div>
																	<div class="pago-space row">
																	</div>
																</div>
																<label class="col-sm-3 form-control-label">Ala</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Ala cuadrada 1</option>
																		<option>Ala redonda 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
																<label class="col-sm-3 form-control-label">Submodelo Avion</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>4515 1</option>
																		<option>54578 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Modelo Piezas Crear ENDS -->

						<!-- Modal Tipo Ala Crear -->
						<div id="myModalTipoAlaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR TIPO ALA</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Informacion Tipo Ala</h4>
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
																	<h3>Fecha Inicio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha de Inicio" class="form-control"> </div>
															</div>
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																	<h3>Parte de:</h3> </label>
																<div class="card-body col-lg-12">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> Ala
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" name="tipo_pago" type="radio"> Submodelo Avion 
																		</label>
																	</div>
																	<div class="pago-space row">
																	</div>
																</div>
																<label class="col-sm-3 form-control-label">Ala</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Ala cuadrada 1</option>
																		<option>Ala redonda 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
																<label class="col-sm-3 form-control-label">Submodelo Avion</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>4515 1</option>
																		<option>54578 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Tipo Ala Crear ENDS -->


						<!-- Modal Tipo Estabilizador Crear -->
						<div id="myModalTipoEstabilizadorCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR TIPO ESTABILIZADOR</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12 pad-top">
															<h4>Informacion Tipo Estabilizador</h4>
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
																	<h3>Fecha Inicio</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha de Inicio" class="form-control"> </div>
															</div>
															<div id="last" data-num="1" class="row last-pago">
																<label class="col-sm-3 form-control-label">
																	<h3>Parte de:</h3> </label>
																<div class="card-body col-lg-12">
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input transferencia" name="tipo_pago" type="radio"> Ala
																		</label>
																	</div>
																	<div class="form-check form-check-inline">
																		<label class="form-check-label">
																			<input class="form-check-input tarjeta-credito" name="tipo_pago" type="radio"> Submodelo Avion 
																		</label>
																	</div>
																	<div class="pago-space row">
																	</div>
																</div>
																<label class="col-sm-3 form-control-label">Ala</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Ala cuadrada 1</option>
																		<option>Ala redonda 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
																<label class="col-sm-3 form-control-label">Submodelo Avion</label>
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>4515 1</option>
																		<option>54578 2</option>
																		<option>option 3</option>
																		<option>option 4</option>
																	</select>
																</div>
															</div>
														</div>	
															
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Cantidad Disponible" class="form-control"> </div>
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
															<h4>Materiales Requeridos</h4>
														</div>

														<div class="card-body col-lg-6">
															<div class="form-group row">

																<label class="col-sm-3 form-control-label">
																	<h4>Material</h4>
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
						<!-- Modal Tipo Estabilizador Crear ENDS -->






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
