<!DOCTYPE html>
<?php include 'conexion.php';?>
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
					<li>
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
					<li> 
						<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
					</li>
					<li>
						<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
					</li>
					<li>
						<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
					</li>
					<li>
						<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
					</li>
					<li class="active">
						<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
					</li>
					<li>
						<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
					</li>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS-->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-shopping-bag " aria-hidden="true"></i> Compras</label>
						<!-- TAB Compras -->
						<section id="content0" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">MOSTRAR SOLO COMRPAS QUE</h3>
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
													<div class="row">
														<label class="col-sm-3 form-control-label">Material</label>
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
											<button type="button" data-toggle="modal" data-target="#myModalCompraCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>PROVEEDOR</th>
													<th>MATERIAL</th>
													<th>FECHA</th>
													<th>PRECIO UNITARIO</th>
													<th>STATUS</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT fc_id id, po_nombre proveedor, mt_nombre material, fc_fecha fecha, m_precio precio,  st_nombre status FROM Factura_compra LEFT JOIN Proveedor ON fc_proveedor=po_id LEFT JOIN Material ma ON m_factura_compra=fc_id LEFT JOIN Tipo_material ON m_tipo_material=mt_id LEFT JOIN Status_material ON sm_material=m_id LEFT JOIN Status ON st_id=sm_status WHERE sm_id=(SELECT MAX(sm_id) FROM Status_material WHERE sm_material=ma.m_id) ORDER BY fc_id";
												$rs = pg_query( $conexion, $qry );
												while( $compra = pg_fetch_object($rs) ){?>
												<tr>
													<td><?php print $compra->id;?></td>
													<td><?php print $compra->proveedor;?></td>
													<td><?php print $compra->material;?></td>
													<td><?php $date = new DateTime($compra->fecha); print $date->format('d/m/Y');?></td>
													<td><?php print number_format($compra->precio, 2, ',', '.')." Bs";?></td>
													<td><span class="badge badge-primary"><?php print $compra->status;?></span></td>
													<td class="text-center">
														<a href="" data-toggle="modal" data-target="#myModalDetalle"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
														<a href="" data-toggle="modal" data-target="#myModalBorrarVenta"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
						<!-- TAB Compra ENDS -->
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
										<button type="button" data-toggle="modal" data-target="#myModalCompraEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Venta ENDS -->
						<!-- Modal Borrar Venta -->
						<div id="myModalBorrarVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Esta seguro que desea borrar la Venta?</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
										<button type="button" class="btn btn-primary">Borrar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Borrar Venta ENDS -->
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
						<!-- Modal Compra Crear -->
						<div id="myModalCompraCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">COMPRA</h4>
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
																<!-- Traer de la tabla de materiales -->
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
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Fecha" class="form-control"> </div>
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
						<!-- Modal Compra Crear ENDS -->
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