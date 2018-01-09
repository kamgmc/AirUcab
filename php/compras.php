<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("po_r", $permiso) && !in_array("fc_r", $permiso) && !in_array("m_r", $permiso) && !in_array("pa_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: sedes.php');
		exit;
    }
}?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Compras</title>
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
					<?php if( in_array("po_r", $permiso) && in_array("fc_r", $permiso) && in_array("m_r", $permiso) && in_array("pa_r", $permiso) ){ ?>
					<li class="active">
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
				<!-- Section de TABS-->
				<section>
					<div class="container-fluid">
                        <?php if( in_array("po_r", $permiso) && in_array("fc_r", $permiso) && in_array("m_r", $permiso) && in_array("pa_r", $permiso) ){ ?>
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-shopping-bag " aria-hidden="true"></i> Compras</label>
                        <?php } ?>
						<!-- TAB Compras -->
						<section id="content0" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h4 class="h4">Filtrar Compras por:</h4>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Proveedor</label>
														<div class="col-sm-9 select">
															<select name="filtro-proveedor" class="form-control">
																<option value="NULL">Seleccionar</option>
																<?php $qry = "SELECT po_id AS id, po_nombre AS nombre FROM Proveedor";
																$rs = pg_query( $conexion, $qry );
																while( $proveedor = pg_fetch_object($rs) ){?>
																<option value="<?php print $proveedor->id;?>">
																	<?php print $proveedor->nombre;?>
																</option>
																<?php }?>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Material</label>
														<div class="col-sm-9 select">
															<select name="filtro-material" class="form-control">
																<option value="NULL">Seleccionar</option>
																<?php $qry = "SELECT mt_id AS id, mt_nombre AS nombre FROM Tipo_material";
																$rs = pg_query( $conexion, $qry );
																while( $material = pg_fetch_object($rs) ){?>
																<option value="<?php print $material->id;?>">
																	<?php print $material->nombre;?>
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
                                    <?php if( in_array("po_r", $permiso) && in_array("fc_c", $permiso) && in_array("m_r", $permiso) && in_array("pa_c", $permiso) ){ ?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#ModalCompraCrear" class="btn btn-primary">
												<i class="fa fa-plus" aria-hidden="true"></i> Crear
											</button>
										</div>
									</div>
                                    <?php } if( in_array("po_r", $permiso) && in_array("fc_r", $permiso) && in_array("m_r", $permiso) && in_array("pa_r", $permiso) ){ ?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th>Proveedor</th>
													<th class="text-center">Fecha de Compra</th>
													<th class="text-center">Total</th>
													<th class="text-center">Status</th>
													<th class="text-center">Acción</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT fc_id AS id, po_nombre AS proveedor, fc_fecha AS fecha, (Select SUM(m_precio) From Material Where m_factura_compra=fc.fc_id) AS total, (Select SUM(pa_monto) from Pago WHERE pa_factura_compra=fc.fc_id) AS pagado FROM Factura_compra fc LEFT JOIN Proveedor ON fc_proveedor=po_id WHERE fc_id>0 ORDER BY fc_id";
												$rs = pg_query( $conexion, $qry );
												while( $compra = pg_fetch_object($rs) ){?>
												<tr>
													<td class="text-center"><?php print $compra->id;?></td>
													<td><?php print $compra->proveedor;?></td>
													<td class="text-center"><?php $date = new DateTime($compra->fecha); print $date->format('d/m/Y');?></td>
													<td class="text-center"><?php print number_format($compra->total, 2, ',', '.')." Bs";?></td>
													<td class="text-center"><?php if($venta->pagado >= $venta->total) print "Pagado"; else print "Pendiente de pago";?></td>
													<td class="text-center">
                                                        <?php } if( in_array("po_r", $permiso) && in_array("fc_r", $permiso) && in_array("m_r", $permiso) && in_array("pa_r", $permiso) && in_array("pt_r", $permiso) ){ ?>
														<a href="<?php print $compra->id;?>" title="Ver mas" class="click-compra-detalle">
															<i class="fa fa-file-text-o" aria-hidden="true"></i> 
														</a>
                                                        <? } php if( in_array("fc_d", $permiso) ){ ?>&emsp;
														<a href="compra-crud.php?delete=<?php print $compra->id;?>">
															<i class="fa fa-trash-o" aria-hidden="true"></i>
														</a>
                                                        <?php }?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
                                    <?php }else{?>
									<h3>&emsp;No se han encontrado resultados.</h3>
									<?php }?>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- TAB Compra ENDS -->
						<!-- Modal Compra Crear -->
						<div id="ModalCompraCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Crear Nueva Compra</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12">
															<h4>Información del Proveedor</h4>
														</div>
													</div>
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Proveedor</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista-proveedores" name="proveedor" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT po_id AS id, po_nombre AS nombre FROM Proveedor ORDER BY nombre";
																		$rs = pg_query( $conexion, $qry );
																		while( $proveedor = pg_fetch_object($rs) ){?>
																		<option value="<?php print $proveedor->id;?>">
																			<?php print $proveedor->nombre;?>
																		</option>
																		<?php }?>
																	</select>
																</div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>CI/RIF Proveedor</h4> </label>
																<div class="col-sm-9">
																	<input id="po_rif" type="text" disabled class="form-control"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12">
															<h4>Información de Material</h4>
														</div>
													</div>
													<div class="row form-material last-material">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Material</h3> </label>
																<!-- Traer de la tabla de materiales -->
																<div class="col-sm-9 select">
																	<select name="material[]" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT mt_id AS id, mt_nombre AS nombre FROM Tipo_material ORDER BY nombre";
																		$rs = pg_query( $conexion, $qry );
																		while( $material = pg_fetch_object($rs) ){?>
																		<option value="<?php print $material->id;?>">
																			<?php print $material->nombre;?>
																		</option>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3>
																</label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca cantidad" pattern="\d+" class="form-control" required> 
																</div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Precio Unitario</h3>
																</label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca precio por unidad" pattern="([0-9]+\.[0-9]+)|([0-9]+)" class="form-control" required>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<div class="col-sm-12 text-right">
															<i id="add-material" class="fa fa-plus"></i>&emsp;
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
						<!-- Modal Compra Crear ENDS -->
						<!-- Modal Detalle Compra  -->
						<div id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE COMPRA</h4>
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
                                        <?php if(in_array("fc_u", $permiso) ){ ?>
										<button type="button" data-toggle="modal" data-target="#myModalCompraEditar" class="btn btn-primary">Editar</button>
                                        <?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Venta ENDS -->
						<!-- Modal Compra Editar -->
						<div id="myModalCompraEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE COMPRA</h4>
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
																	<h3>Factura Compra</h3> </label>
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
																	<h3>Proveedor</h3> </label>
																<!-- Traer de la tabla de proveedor las opciones -->
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
																<!-- Se debe rellenar automaticamente despues de seleccionar al proveedor -->
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Material</h3> </label>
																<!-- Traer de la tabla de materiales las opciones -->
																<div class="col-sm-9 select">
																	<select name="account" class="form-control">
																		<option>Arena Blanca</option>
																		<option>Cal</option>
																		<option>Tornillos</option>
																	</select>
																</div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cantidad</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca cantidad de unidades" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Precio Unitario</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca precio por unidad" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Fecha</h3> </label>
																<!-- Esto podemos hacerlo automatizado, que salve la fecha de creacion como fecha inicio -->
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
						<!-- Modal Compra Editar ENDS -->
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
		$("#lista-proveedores").change(function() {
			var id = $( "#lista-proveedores option:selected" ).val();
			$.ajax({type: "POST",dataType: "html",url:"getter.php?get=po_rif&id="+id,success: function(data){$("#po_rif").val(data);}});
		});
		
		$("#add-material").click(function(){
			var $last = $(".last-material");
			$last.removeClass("last-material");
			$.ajax({
				type: "POST",
				dataType: "html",
				url: "getter.php?get=fieldAvion",
				success: function(data){
					$last.after(data);
				}
			});
		});
	</script>
</body>

</html>
