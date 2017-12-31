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
					<li> <a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a></li>
					<li class="active"> <a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a></li>
					<li> <a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a></li>
					<li> <a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a></li>
					<li> <a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a></li>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS -->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-truck" aria-hidden="true"></i> Explorador Proveedores</label>
						<!-- TAB Proveedores -->
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
											<button type="button" data-toggle="modal" data-target="#myModalProveedorCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th class="text-center">CI / RIF</th>
													<th>NOMBRE</th>
													<th class="text-center">MONTO PAGADO</th>
													<th class="text-center">FECHA INICIO</th>
													<th class="text-center">N COMPRAS</th>
													<th class="text-center">UBICACION</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT po_id id, po_tipo_rif t_rif, po_rif rif, po_nombre nombre, SUM(m_precio) as monto, po_fecha_ini as fecha, COUNT(fc_id) as compras, lu_nombre direccion FROM proveedor LEFT JOIN Factura_compra ON fc_proveedor=po_id LEFT JOIN Material ON m_factura_compra=fc_id LEFT JOIN Lugar ON lu_id=po_direccion GROUP BY po_id, po_tipo_rif, po_rif, po_nombre, po_fecha_ini, lu_nombre ORDER BY po_id";
												$rs = pg_query( $conexion, $qry );
												while( $proveedor = pg_fetch_object($rs) ){?>
													<tr>
														<td class="text-center"><?php print $proveedor->id;?></td>
														<td class="text-center"><?php print $proveedor->t_rif."-".$proveedor->rif;?></td>
														<td><?php print $proveedor->nombre;?></td>
														<td class="text-center"><?php print number_format($proveedor->monto, 2,',','.')." Bs";?></td>
														<td class="text-center"><?php $date = new DateTime($proveedor->fecha); print $date->format('d/m/Y');?></td>
														<td class="text-center"><?php print $proveedor->compras;?></td>
														<td class="text-center"><?php print $proveedor->direccion;?></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#ModalProveedor<?php print $proveedor->id;?>"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
															<a href="proveedor-crud.php?delete=<?php print $proveedor->id;?>"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
						<?php 	
						$qry = "SELECT po_id id, po_tipo_rif t_rif, po_rif rif, po_nombre nombre, SUM(m_precio) as monto, po_fecha_ini as fecha, COUNT(fc_id) as compras, pa.lu_nombre parroquia, mu.lu_nombre municipio, es.lu_nombre estado, po_pagina_web web, po_nota nota FROM proveedor LEFT JOIN Factura_compra ON fc_proveedor=po_id LEFT JOIN Material ON m_factura_compra=fc_id LEFT JOIN Lugar pa ON pa.lu_id=po_direccion LEFT JOIN Lugar mu ON pa.lu_lugar=mu.lu_id LEFT JOIN Lugar es ON mu.lu_lugar=es.lu_id GROUP BY po_id, po_tipo_rif, po_rif, po_nombre, po_fecha_ini, pa.lu_nombre, mu.lu_nombre, es.lu_nombre, po_pagina_web ORDER BY po_id";
						$rs = pg_query( $conexion, $qry );
						while( $proveedor = pg_fetch_object($rs) ){?>
						<!-- Modal Proveedor Informacion -->
						<div id="ModalProveedor<?php print $proveedor->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION PROVEEDOR</h4>
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
																<div class="col-lg-8"><?php print $proveedor->nombre;?></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>CI/RIF</h3> </div>
																<div class="col-lg-8"><?php print $proveedor->t_rif."-".$proveedor->rif;?></div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Direccion</h3> </div>
																<div class="col-lg-8"><?php print $proveedor->parroquia.", ".$proveedor->municipio.", ".$proveedor->estado;?></div>
															</div>
															<?php  $qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_proveedor=".$proveedor->id;
															$answer = pg_query( $conexion, $qry );
															$num = pg_num_rows($answer);
															if($num > 0){?>
															<div class="row">
																<div class="col-lg-12">
																	<h3>Contacto</h3> 
																</div>
																<div class="col-lg-12">
																	<?php 
																	while( $contacto = pg_fetch_object($answer) ){?>
																	<?php print $contacto->tipo." - ".$contacto->valor."</br>";?> 
																	<?php }?>
																</div>
															</div>
															<?php }?>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Pagina Web</h3> </div>
																<div class="col-lg-8"> <a href="<?php print $proveedor->web;?>" class="external"><?php print $proveedor->web;?></a> </div>
															</div>
														</div>
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															<div class="row">
																<div class="col-lg-4">
																	<h3>Monto Pagado</h3> </div>
																<div class="col-lg-8"> <?php print number_format($proveedor->monto, 2, ',', '.')." Bs";?> </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Fecha Inicio</h3> </div>
																<div class="col-lg-8"> <?php print $date->format('d/m/Y');?> </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nota</h3> </div>
																<div class="col-lg-8"> <?php print $proveedor->nota;?> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Tabla Ventas Cliente STARTS -->
										<div class="col-md-12">
											<div class="card">
												<div class="card-header d-flex align-items-center">
													<h3 class="h4">COMPRAS PROVEEDOR</h3> </div>
												<div class="card-body">
													<?php 	$qry = "SELECT COUNT(fc_id) total FROM Factura_compra where fc_proveedor=".$proveedor->id;
														$answer = pg_query( $conexion, $qry );
														$venta = pg_fetch_object($answer); 
														if($venta->total <= 0)
															print "No se han registrado ventas.";
														else{?>
													<table class="table table-striped table-sm table-hover">
														<thead>
															<tr>
																<th>ID</th>
																<th>MATERIAL</th>
																<th>FECHA VENTA</th>
																<th>ESTATUS</th>
																<th>PRECIO</th>
																<th class="text-center">Accion</th>
															</tr>
														</thead>
														<tbody>
														<?php 	
															$qry = "SELECT fc_id AS id, fc_fecha AS fecha, mt_nombre AS material, st_nombre as status, m_precio AS precio FROM Factura_compra LEFT JOIN material ma ON fc_id=m_factura_compra LEFT JOIN Tipo_material ON mt_id=m_tipo_material LEFT JOIN Status_material ON sm_material=m_id LEFT JOIN Status ON sm_status=st_id WHERE sm_id=(SELECT MAX(sm_id) FROM Status_material WHERE sm_material=ma.m_id) AND fc_proveedor=".$proveedor->id;
															$answer = pg_query( $conexion, $qry );
															while( $compra = pg_fetch_object($answer) ){?>
															<tr>
																<td><?php print $compra->id;?></td>
																<td><?php print $compra->material;?></td>
																<td><?php $date = new DateTime($compra->fecha); print $date->format('d/m/Y');?></td>
																<td><span class="badge badge-info"><?php print $compra->status;?></span></td>
																<td><?php print number_format($compra->precio, 2, ',', '.')." Bs";?></td>
																<td class="text-center">
																	<a href="" data-toggle="modal" data-target="#myModalProveedor"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																	<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
																</td>
															</tr>
															<?php }?>
														</tbody>
													</table>
													<?php }?>
												</div>
											</div>
										</div>
										<!-- Tabla Ventas Cliente ENDS -->
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalProveedorEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Proveedor Informacion ENDS -->
						<?php }?>
						<!-- Modal Proveedor Editar -->
						<div id="myModalProveedorEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION PERSONAL</h4>
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
																	<h3>Direccion</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca la Direccion asociada" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>CI/RIF</h3> </label>
																<div class="col-sm-9">
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Contacto</h3> </label>
																<div class="col-sm-9">
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																	<br>
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																	<br>
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																</div>
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
						<!-- Modal Proveedor Editar ENDS -->
						<!-- Modal Proveedor Crear -->
						<div id="myModalProveedorCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">INFORMACION PERSONAL</h4>
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
																	<h3>Direccion</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca la Direccion asociada" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>CI/RIF</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca CI/RIF" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Contacto</h3> </label>
																<div class="col-sm-9">
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																	<br>
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																	<br>
																	<div class="input-group">
																		<div class="input-group-btn">
																			<button data-toggle="dropdown" type="button" class="btn btn-white dropdown-toggle"><i class="fa fa-facebook" aria-hidden="true"></i><span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
																				<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
																			</ul>
																		</div>
																		<input type="text" class="form-control"> </div>
																</div>
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
						<!-- Modal Proveedor Crear ENDS -->
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