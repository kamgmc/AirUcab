<?php include 'conexion.php'
?>
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
						<li> <a href="empleados.php"><i class="icon-man-people-streamline-user"></i>Empleados</a></li>
						<li class="active">
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
						<li>
							<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
						</li>
					</ul>
				</nav>
				<div class="content-inner">
					<!-- Seccion de diferentes TABS -->
					<section>
						<div class="container-fluid">
							<input id="tab0" type="radio" name="tabs" class="no-display" checked>
							<label for="tab0" class="label"><i class="icon-map-streamline-user" aria-hidden="true"></i> Explorador Clientes</label>
							<!-- TAB Explorador Clientes -->
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
												<button type="button" data-toggle="modal" data-target="#myModalClienteCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<div class="card-body">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th class="text-center">CI / RIF</th>
														<th>NOMBRE</th>
														<th class="text-center">MONTO ACREDITADO</th>
														<th class="text-center">FECHA INICIO</th>
														<th class="text-center">N VENTAS</th>
														<th class="text-center">UBICACION</th>
														<th class="text-center">Accion</th>
													</tr>
												</thead>
												<tbody>
													<?php 	
												$qry = "SELECT cl_id, cl_tipo_rif, cl_rif, cl_nombre, SUM(a_precio) as monto, cl_fecha_inicio as fecha, COUNT(fv_id) as ventas, lu_nombre FROM Cliente left join Factura_venta ON fv_cliente=cl_id LEFT JOIN Avion ON a_factura_venta=fv_id LEFT JOIN Lugar ON lu_id=cl_direccion GROUP BY cl_id, cl_tipo_rif, cl_rif, cl_nombre,cl_fecha_inicio,lu_nombre ORDER BY cl_id";
												$rs = pg_query( $conexion, $qry );
												while( $cliente = pg_fetch_object($rs) ){?>
														<tr>
															<td class="text-center">
																<?php print $cliente->cl_id;?>
															</td>
															<td class="text-center">
																<?php print $cliente->cl_tipo_rif."-".$cliente->cl_rif;?>
															</td>
															<td>
																<?php print $cliente->cl_nombre;?>
															</td>
															<td class="text-center">
																<?php print number_format($cliente->monto, 2, ',', '.')." Bs";?>
															</td>
															<td class="text-center">
																<?php $date = new DateTime($cliente->fecha); print $date->format('d-m-Y');?>
															</td>
															<td class="text-center">
																<?php print $cliente->ventas;?>
															</td>
															<td class="text-center">
																<?php print $cliente->lu_nombre;?>
															</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#ModalCliente<?php print $cliente->cl_id;?>"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																<a href="cliente-crud.php?delete=<?php print $cliente->cl_id;?>"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
							<!-- Tab Explorador Clientes ENDS -->
							<?php 	
						$qry = "SELECT cl_id, cl_tipo_rif, cl_rif, cl_nombre, SUM(a_precio) as monto, cl_fecha_inicio, COUNT(a_id) as ventas, pa.lu_nombre as parroquia, pa.lu_id as id_parroquia, mu.lu_nombre as municipio, mu.lu_id as id_municipio, es.lu_nombre as estado, es.lu_id as id_estado, cl_pagina_web AS web, cl_nota FROM Cliente left join Factura_venta ON fv_cliente=cl_id LEFT JOIN Avion ON a_factura_venta=fv_id LEFT JOIN Lugar pa ON lu_id=cl_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar GROUP BY cl_id, cl_tipo_rif, cl_rif, cl_nombre,cl_fecha_inicio,pa.lu_nombre, mu.lu_nombre, es.lu_nombre, pa.lu_id, mu.lu_id, es.lu_id ORDER BY cl_id";
						$rs = pg_query( $conexion, $qry );
						while( $cliente = pg_fetch_object($rs) ){?>
								<!-- Modal Cliente Informacion -->
								<div id="ModalCliente<?php print $cliente->cl_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
									<div role="document" class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">INFORMACION CLIENTE</h4>
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
																		<div class="col-lg-8">
																			<?php print $cliente->cl_nombre;?>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-4">
																			<h3>CI/RIF</h3> </div>
																		<div class="col-lg-8">
																			<?php print $cliente->cl_tipo_rif."-".$cliente->cl_rif;?>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-4">
																			<h3>Direccion</h3> </div>
																		<div class="col-lg-8">
																			<?php print $cliente->parroquia.", ".$cliente->municipio.", ".$cliente->estado;?>
																		</div>
																	</div>
																	<?php  $qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_cliente=".$cliente->cl_id;
																$answer = pg_query( $conexion, $qry );
																$num = pg_num_rows($answer);
																if($num > 0){?>
																		<div class="row">
																			<div class="col-lg-12">
																				<h3>Contacto</h3> </div>
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
																				<div class="col-lg-8">
																					<a href="<?php print $cliente->web;?>" class="external">
																						<?php print $cliente->web;?>
																					</a>
																				</div>
																			</div>
																</div>
																<!-- Columna izquierda ENDS -->
																<!-- Columna derecha -->
																<div class=" card-body col-lg-6">
																	<div class="row">
																		<div class="col-lg-4">
																			<h3>Monto Acreditado</h3> </div>
																		<div class="col-lg-8">
																			<?php print number_format($cliente->monto, 2, ',', '.')." Bs";?>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-4">
																			<h3>Fecha Inicio</h3> </div>
																		<div class="col-lg-8">
																			<?php print $date->format('d/m/Y');?>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-4">
																			<h3>Nota</h3> </div>
																		<div class="col-lg-8">
																			<?php print $cliente->cl_nota;?>
																		</div>
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
															<h3 class="h4">VENTAS CLIENTE</h3> </div>
														<div class="card-body">
															<?php 	$qry = "SELECT COUNT(fv_id) total FROM Factura_venta where fv_cliente=".$cliente->cl_id;
														$answer = pg_query( $conexion, $qry );
														$venta = pg_fetch_object($answer); 
														if($venta->total <= 0)
															print "No se han registrado ventas.";
														else{?>
																<table class="table table-striped table-sm table-hover">
																	<thead>
																		<tr>
																			<th>FACTURA</th>
																			<th>FECHA VENTA</th>
																			<th>AVION</th>
																			<th>ESTATUS</th>
																			<th>PRECIO</th>
																			<th class="text-center">Accion</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 	
																$qry = "SELECT fv_id AS id, fv_fecha AS fecha, am_nombre AS avion, a_id AS id_avion, st_nombre as status, a_precio AS precio FROM Factura_venta LEFT JOIN Avion av ON fv_id=a_factura_venta LEFT JOIN Status_avion ON sa_avion=a_id LEFT JOIN Status ON sa_status=st_id LEFT JOIN Submodelo_avion ON a_submodelo_avion=as_id LEFT JOIN Modelo_avion ON as_modelo_avion=am_id WHERE sa_id=(SELECT MAX(sa_id) FROM Status_avion WHERE sa_avion=av.a_id) AND fv_cliente=".$cliente->cl_id;
																$answer = pg_query( $conexion, $qry );
																while( $venta = pg_fetch_object($answer) ){?>
																			<tr>
																				<td>
																					<?php print $venta->id;?>
																				</td>
																				<td>
																					<?php $date = new DateTime($venta->fecha); print $date->format('d-m-Y');?>
																				</td>
																				<td>
																					<?php print $venta->avion." - ".$venta->id_avion;?>
																				</td>
																				<td><span class="badge badge-success"><?php print $venta->status;?></span></td>
																				<td>
																					<div class="col-lg-8">
																						<?php print number_format($venta->precio, 2, ',', '.')." Bs";?>
																					</div>
																				</td>
																				<td class="text-center">
																					<a href="" data-toggle="modal" data-target="#myModalEmpleado"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
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
												<button type="button" data-toggle="modal" data-target="#ModalClienteEditar<?php print $cliente->cl_id;?>" class="btn btn-primary">Editar</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Modal Cliente Informacion ENDS -->
								<!-- Modal Cliente Editar -->
								<div id="ModalClienteEditar<?php print $cliente->cl_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
																			<input type="text" value="<?php print $cliente->cl_nombre;?>" class="form-control"> </div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Fecha Inicio</h3> </label>
																		<div class="col-sm-9">
																			<input type="text" disabled value="<?php print $cliente->cl_fecha_inicio;?>" class="form-control"> </div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Estado</h3> </label>
																		<div class="col-sm-9 select">
																			<select id="list-estados-up" name="account" class="form-control">
																				<?php $qry="SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar where lu_tipo='Estado' ORDER BY lu_nombre";
																	$answer = pg_query( $conexion, $qry );
																	while( $estado = pg_fetch_object($answer) ){?>
																					<option value="<?php print $estado->id;?>" <?php if($estado->id==$cliente->id_estado) print "selected";?>>
																						<?php print $estado->nombre;?>
																					</option>
																					<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Municipio</h3> </label>
																		<div class="col-sm-9 select">
																			<select id="list-municipios-up" name="account" class="form-control">
																				<?php $qry="SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar where lu_tipo='Municipio' AND lu_lugar=".$cliente->id_estado." ORDER BY lu_nombre";
																	$answer = pg_query( $conexion, $qry );
																	while( $municipio = pg_fetch_object($answer) ){?>
																					<option value="<?php print $municipio->id;?>" <?php if($municipio->id==$cliente->id_municipio) print "selected";?>>
																						<?php print $municipio->nombre;?>
																					</option>
																					<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Parroquia</h3> </label>
																		<div class="col-sm-9 select">
																			<select id="list-parroquias-up" name="account" class="form-control">
																				<?php $qry="SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar where lu_tipo='Parroquia' AND lu_lugar=".$cliente->id_municipio." ORDER BY lu_nombre";
																	$answer = pg_query( $conexion, $qry );
																	while( $parroquia = pg_fetch_object($answer) ){?>
																					<option value="<?php print $parroquia->id;?>" <?php if($parroquia->id==$cliente->id_parroquia) print "selected";?>>
																						<?php print $parroquia->nombre;?>
																					</option>
																					<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Tipo Rif</h3> </label>
																		<div class="col-sm-2 select">
																			<select name="account" class="form-control">
																				<option value="J">J</option>
																				<option value="G">G</option>
																				<option value="V">V</option>
																				<option value="E">E</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>CI/RIF</h3> </label>
																		<div class="col-sm-9">
																			<input type="text" value="<?php print $cliente->cl_rif;?>" class="form-control"> </div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>PAGINA WEB</h3> </label>
																		<div class="col-sm-9">
																			<input type="text" value="<?php print $cliente->web;?>" class="form-control"> </div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Contacto</h3> </label>
																		<div class="col-sm-9">
																			<?php $qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_cliente=".$cliente->cl_id;
																	$answer = pg_query( $conexion, $qry );
																	while( $contacto = pg_fetch_object($answer) ){?>
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
																					<input type="text" value="<?php print $contacto->valor;?>" class="form-control"> </div>
																				<br>
																				<?php }?>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h3>Nota</h3> </label>
																		<div class="col-sm-9">
																			<input type="text" value="<?php print $cliente->cl_nota;?>" class="form-control form-control-lg" rows="4" cols="50"> </div>
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
								<!-- Modal Cliente Editar ENDS -->
								<?php }?>
									<!-- Modal Cliente Crear -->
									<div id="myModalClienteCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
										<div role="document" class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h4 id="exampleModalLabel" class="modal-title">INFORMACION PERSONAL</h4>
													<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
												</div>
												<form method="post" action="cliente-crud.php?create=true">
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
																					<input name="nombre" type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Estado</h3> </label>
																				<div class="col-sm-9 select">
																					<select id="list-estados" name="account" class="form-control">
																						<?php $qry="SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar where lu_tipo='Estado' ORDER BY lu_nombre";
																		$answer = pg_query( $conexion, $qry );
																		while( $estado = pg_fetch_object($answer) ){?>
																							<option value="<?php print $estado->id;?>">
																								<?php print $estado->nombre;?>
																							</option>
																							<?php }?>
																					</select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Municipio</h3> </label>
																				<div class="col-sm-9 select">
																					<select id="list-municipios" disabled name="account" class="form-control"> </select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Parroquia</h3> </label>
																				<div class="col-sm-9 select">
																					<select id="list-parroquias" disabled name="parroquia" class="form-control"> </select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Tipo Rif</h3> </label>
																				<div class="col-sm-2 select">
																					<select name="tipo_rif" class="form-control">
																						<option value="J">J</option>
																						<option value="G">G</option>
																						<option value="V">V</option>
																						<option value="E">E</option>
																					</select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>CI/RIF</h3> </label>
																				<div class="col-sm-9">
																					<input name="rif" type="text" placeholder="Introduzca Rif" class="form-control"> </div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>PAGINA WEB</h3> </label>
																				<div class="col-sm-9">
																					<input name="web" type="text" placeholder="Introduzca Pagina Web" class="form-control"> </div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Tipo de Contacto</h3> </label>
																				<div class="col-sm-5 select">
																					<select name="tipo_contacto" class="form-control">
																						<option value="NULL">Seleccionar</option>
																						<?php $qry="SELECT ct_id AS id, ct_nombre AS nombre FROM Tipo_contacto ORDER BY ct_nombre";
																			$answer = pg_query( $conexion, $qry );
																			while( $contacto = pg_fetch_object($answer) ){?>
																							<option value="<?php print $contacto->id;?>">
																								<?php print $contacto->nombre;?>
																							</option>
																							<?php }?>
																					</select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Contacto</h3> </label>
																				<div class="col-sm-9">
																					<input name="contacto" type="text" placeholder="Introduzca Contacto" class="form-control"> </div>
																			</div>
																		</div>
																		<div class=" card-body col-lg-6">
																			<div class="form-group row">
																				<label class="col-sm-3 form-control-label">
																					<h3>Nota</h3> </label>
																				<div class="col-sm-9">
																					<input name="nota" type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
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
									<!-- Modal Cliente Crear ENDS -->
						</div>
					</section>
					<!-- Section de tabs ENDS -->
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
			$(document).ready(function () {
				$("#list-estados").change(function () {
					var iden = $("#list-estados option:selected").val();
					$("#list-municipios").removeAttr('disabled');
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=municipios&id=" + iden
						, success: function (data) {
							$("#list-municipios").html(data);
						}
					});
				});
				$("#list-municipios").change(function () {
					var iden = $("#list-municipios option:selected").val();
					$("#list-parroquias").removeAttr('disabled');
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=parroquias&id=" + iden
						, success: function (data) {
							$("#list-parroquias").html(data);
						}
					});
				});
				$("#list-estados-up").change(function () {
					var municipio = $(this).closest(".form-group").siblings(".form-group").children("#list-municipios-up");
					var iden = $("#list-estados-up option:selected").val();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=municipios&id=" + iden
						, success: function (data) {
							municipio.html(data);
						}
					});
				});
				$("#list-municipios-up").change(function () {
					var iden = $("#list-municipios-up option:selected").val();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=parroquias&id=" + iden
						, success: function (data) {
							$("#list-parroquias-up").html(data);
						}
					});
				});
			});
		</script>
	</body>

	</html>