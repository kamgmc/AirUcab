<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("m_r", $permiso) && !in_array("mt_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: ventas.php');
		exit;
    }
}?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>AirUCAB - Materiales</title>
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
						<li class="active">
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
						<li>
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
					<!-- Section de TABS-->
					<section>
						<div class="container-fluid">
                            <?php if( in_array("m_r", $permiso) ){?>
							<input id="tab0" type="radio" name="tabs" class="no-display" <?php if( !isset($_GET['tab']) ) print "checked";?>>
							<label for="tab0" class="label"><i class="fa fa-server " aria-hidden="true"></i> Materiales</label>
                            <?php }?>
                            <?php if( in_array("mt_r", $permiso) ){?>
							<input id="tab1" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "inventario" || !in_array("m_r", $permiso) ) print "checked";?>>
							<label for="tab1" class="label"><i class="fa fa-server " aria-hidden="true"></i> Tipo de Materiales</label>
                            <?php }?>
                            <?php if( in_array("m_r", $permiso) && in_array("mt_r", $permiso) ){?>
							<input id="tab2" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "inventario" || !in_array("m_r", $permiso) ) print "checked";?>>
							<label for="tab2" class="label"><i class="fa fa-server " aria-hidden="true"></i> Inventario</label>
                            <?php }?>
                            <?php if( in_array("m_r", $permiso) ){?>
							<!-- TAB Materiales -->
							<section id="content0" class="sectiontab">
								<!-- Filtrador-->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">Filtrar Materiales por:</h3>
													<form class="form-horizontal">
														<div class="row">
															<label class="col-sm-3 form-control-label">Proveedor</label>
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
									   <?php $qry = "SELECT m_id id, mt_nombre nombre, m_fecha fecha, st_nombre status, pm_nombre ||' ID '|| p_id AS pieza FROM Material ma LEFT JOIN Tipo_material ON m_tipo_material=mt_id LEFT JOIN Status_material ON sm_material=m_id LEFT JOIN Status ON sm_status=st_id LEFT JOIN Pieza ON m_pieza=p_id LEFT JOIN Modelo_pieza ON p_modelo_pieza=pm_id Where (SELECT MAX(sm_id) FROM Status,Status_material WHERE sm_material=ma.m_id AND sm_status=st_id)=sm_id And m_pieza is not null ORDER BY p_id Desc";
									   $rs = pg_query( $conexion, $qry );
									   $howMany = pg_num_rows($rs);
									   if( $howMany > 0 ){?>
										<div class="card-body">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th>Nombre</th>
														<th class="text-center">Fecha</th>
														<th class="text-center">Pieza</th>
														<th class="text-center">Status</th>
														<th class="text-center">Acción</th>												
													</tr>
												</thead>
												<tbody>
                                                    <?php while( $material = pg_fetch_object($rs)){ 
													$fecha = new DateTime($material->fecha);?>
													<tr>
														<td class="text-center">
                                                            <?php print $material->id;?>
                                                        </td>
														<td>
                                                            <?php print $material->nombre;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $fecha->format('d/m/Y');?>
                                                        </td>	
														<td class="text-center">
                                                            <?php print $material->pieza;?>
                                                        </td>
														<td class="text-center">
                                                            <?php if($material->status == "Listo") {?>
															<span class="badge badge-success">
															<?php print $material->status;?>
															</span>                                                        
															<?php } elseif($material->status == "Rechazado") {?>
															<span class="badge badge-danger">
																<?php print $pieza->status;?>
															</span>                                                          
															<?php } else {?>
															<span class="badge badge-info">
																<?php print $material->status;?>
															</span>
															<?php } ?> 
                                                        </td>	
														<td class="text-center">
                                                            <a href="<?php print $material->id ?>" data-toggle="modal" data-target="#ModalPieza"> 
																<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
															</a>
															<?php if( in_array("m_d", $permiso) ){ ?>&emsp;
															<a href="material-crud.php?delete=<?php print $material->id ?>"> 
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
									   <h4>&emsp;No se han encontrado resultados.</h4>
									   <?php }?>
									</div>
								</div>
								<!-- TABLE ENDS -->
							</section>
							<!-- TAB Material ENDS -->
							<!-- Modal Detalle Materiales  -->
							<div id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h4 id="exampleModalLabel" class="modal-title">DETALLE MATERIAL</h4>
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
																		<h3>Factura Compra</h3> </div>
																	<div class="col-lg-8"> 001 </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>ESTATUS</h3> </div>
																	<div class="col-lg-8"> <span class="badge badge-primary font-big">Evaluacion</span> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Tipo Material</h3> </div>
																	<div class="col-lg-8"> LEX FDZ CORP. S.A. </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Proveedor</h3> </div>
																	<div class="col-lg-8"> LEX FDZ CORP. S.A. </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>CI/RIF Proveedor</h3> </div>
																	<div class="col-lg-8"> J-79698576-7 </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Material</h3> </div>
																	<div class="col-lg-8"> Arena Blanca </div>
																</div>
															</div>
															<!-- Columna izquierda ENDS -->
															<!-- Columna derecha -->
															<div class=" card-body col-lg-6">
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Cantidad</h3> </div>
																	<div class="col-lg-8"> 50 u </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Monto Unitario</h3> </div>
																	<div class="col-lg-8"> 15 $ </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Monto Total</h3> </div>
																	<div class="col-lg-8"> 750 $ </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Fecha</h3> </div>
																	<div class="col-lg-8"> 14/12/2017 </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Tipo de Pago</h3> </div>
																	<div class="col-lg-8"> Transfencia </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Nota</h3> </div>
																	<div class="col-lg-8"> Proveedor enviara los camiones despues de acreditado el pago, con 1 semana de tiempo estimado de llegada. </div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
											<button type="button" data-toggle="modal" data-target="#myModalMaterialEditar" class="btn btn-primary">Editar</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal Detalle Venta ENDS -->
							<?php }?>
							<?php if( in_array("mt_r", $permiso) ){?>
							<!-- TAB Materiales -->
							<section id="content1" class="sectiontab">
								<!-- TABLE STARTS -->
								<div class="col-md-12">
									<div class="card">
									   <?php $qry = "select mt_id id, mt_nombre nombre from tipo_material Order By mt_nombre";
									   $rs = pg_query( $conexion, $qry );
									   $howMany = pg_num_rows($rs);
									   if( $howMany > 0 ){?>
										<div class="card-body">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th>Nombre</th>
														<th class="text-center">Acción</th>												
													</tr>
												</thead>
												<tbody>
                                                    <?php while( $material = pg_fetch_object($rs)){ ?>
													<tr>
														<td class="text-center">
                                                            <?php print $material->id;?>
                                                        </td>
														<td>
                                                            <?php print $material->nombre;?>
                                                        </td>
														<td class="text-center">
                                                            <a href="<?php print $material->id ?>" data-toggle="modal" data-target="#ModalPieza"> 
																<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
															</a>
															<?php if( in_array("mt_d", $permiso) ){ ?>&emsp;
															<a href="material-crud.php?delete=<?php print $material->id ?>"> 
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
									   <h4>&emsp;No se han encontrado resultados.</h4>
									   <?php }?>
									</div>
								</div>
								<!-- TABLE ENDS -->
							</section>
							<!-- TAB Material ENDS -->
							<?php }?>
							<?php if( in_array("m_r", $permiso) && in_array("mt_r", $permiso) ){?>
							<!-- TAB Materiales -->
							<section id="content2" class="sectiontab">
								<!-- TABLE STARTS -->
								<div class="col-md-12">
									<div class="card">
									   <?php $qry = "Select nombre, Count(*) cantidad From(SELECT mt_nombre nombre FROM Material, Tipo_material, Status_material, Status Where m_tipo_material=mt_id AND m_pieza is null AND sm_material=m_id AND sm_status=st_id AND st_nombre<>'Rechazado' Group By m_id, mt_nombre) AS Materiales Group By nombre";
									   $rs = pg_query( $conexion, $qry );
									   $howMany = pg_num_rows($rs);
									   if( $howMany > 0 ){?>
										<div class="card-body">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th>Nombre</th>
														<th class="text-center">Cantidad</th>												
													</tr>
												</thead>
												<tbody>
                                                    <?php while( $material = pg_fetch_object($rs)){ ?>
													<tr>
														<td>
                                                            <?php print $material->nombre;?>
                                                        </td>
														<td class="text-center">
                                                            <?php print $material->cantidad;?>
                                                        </td>												
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
                                        <?php }else{?>
									   <h4>&emsp;Sin inventario.</h4>
									   <?php }?>
									</div>
								</div>
								<!-- TABLE ENDS -->
							</section>
							<!-- TAB Material ENDS -->
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