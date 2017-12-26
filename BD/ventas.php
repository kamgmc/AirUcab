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
					<li> <a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a></li>
					<li> <a href="empleados.php"><i class="icon-man-people-streamline-user"></i>Empleados</a></li>
					<li> <a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a></li>
					<li> <a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a></li>
					<li class="active"> <a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a></li>
					<li> <a href="compras.php"> <i class="fa fa-cog" aria-hidden="true"></i>Compras </a></li>
					
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS-->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Ventas</label>
						<!-- TAB Ventas -->
						<section id="content0" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">MOSTRAR SOLO VENTAS QUE</h3>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Cliente</label>
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
														<label class="col-sm-3 form-control-label">Avion</label>
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
											<button type="button" data-toggle="modal" data-target="#ModalVentaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th>CLIENTE</th>
													<th class="text-center">MODELO AVION</th>
													<th class="text-center">SUBMODELO</th>
													<th class="text-center">DISTRIBUCION</th>
													<th class="text-center">FECHA VENTA</th>
													<th class="text-center">FECHA FINAL</th>
													<th class="text-center">PRECIO UNITARIO</th>
													<th class="text-center">ESTATUS</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT fv_id id, cl_nombre cliente, am_nombre modelo, as_nombre submodelo, di_nombre distribucion, fv_fecha fecha_ini, a_fecha_fin fecha_fin, a_precio precio, st_nombre status FROM Factura_venta LEFT JOIN Cliente ON fv_cliente=cl_id LEFT JOIN Avion av ON a_factura_venta=fv_id LEFT JOIN Submodelo_avion ON as_id=a_submodelo_avion LEFT JOIN Modelo_avion ON as_modelo_avion=am_id LEFT JOIN Distribucion ON a_distribucion=di_id LEFT JOIN Status_avion ON sa_avion=a_id LEFT JOIN Status ON st_id=sa_status WHERE sa_id=(SELECT MAX(sa_id) FROM Status_avion WHERE sa_avion=av.a_id) ORDER BY fv_id";
												$rs = pg_query( $conexion, $qry );
												while( $venta = pg_fetch_object($rs) ){?>
													<tr>
														<td class="text-center"><?php print $venta->id;?></td>
														<td><?php print $venta->cliente;?></td>
														<td class="text-center"><?php print $venta->modelo;?></td>
														<td class="text-center"><?php print $venta->submodelo;?></td>
														<td class="text-center"><?php print $venta->distribucion;?></td>
														<td class="text-center"><?php $date = new DateTime($venta->fecha_ini); print $date->format('d-m-Y');?></td>
														<td class="text-center"><?php $date = new DateTime($venta->fecha_ini); print $date->format('d-m-Y');?></td>
														<td class="text-center"><?php print number_format($venta->precio, 2, ',', '.')." Bs";?></td>
														<td class="text-center"><span class="badge badge-primary"><?php print $venta->status;?></span></td>
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
						<!-- TAB Ventas ENDS -->
						<!-- Modal Detalle Venta  -->
						<div id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE VENTA</h4>
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
																	<h3>Factura Venta</h3> </div>
																<div class="col-lg-8"> 001 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>ESTATUS</h3> </div>
																<div class="col-lg-8"> <span class="badge badge-primary font-big">Evaluacion</span> </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Cliente</h3> </div>
																<div class="col-lg-8"> LEX FDZ CORP. S.A. </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>CI/RIF Cliente</h3> </div>
																<div class="col-lg-8"> J-79698576-7 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Modelo Avion</h3> </div>
																<div class="col-lg-8"> AU80 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Submodelo Avion</h3> </div>
																<div class="col-lg-8"> LW </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Distribucion</h3> </div>
																<div class="col-lg-8"> Civil </div>
															</div>
														</div>
														<!-- Columna izquierda ENDS -->
														<!-- Columna derecha -->
														<div class=" card-body col-lg-6">
															<div class="row">
																<div class="col-lg-4">
																	<h3>Cantidad</h3> </div>
																<div class="col-lg-8"> 3 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Monto por Avion</h3> </div>
																<div class="col-lg-8"> 1800 $ </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Monto Total</h3> </div>
																<div class="col-lg-8"> 5400 $ </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Fecha Inicio</h3> </div>
																<div class="col-lg-8"> 14/12/2017 </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Fecha Final</h3> </div>
																<div class="col-lg-8"> null </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Tipo de Pago</h3> </div>
																<div class="col-lg-8"> Transfencia </div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<h3>Nota</h3> </div>
																<div class="col-lg-8"> Cliente requiere fotos de supervision en el ensamblaje de Ala derecha. </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" data-toggle="modal" data-target="#myModalVentaEditar" class="btn btn-primary">Editar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Detalle Venta ENDS -->
						<!-- Modal Venta Editar -->
						<div id="myModalVentaEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">DETALLE VENTA</h4>
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
																	<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
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
						<!-- Modal Venta Editar ENDS -->
						<!-- Modal Venta Crear -->
						<div id="ModalVentaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">VENTA</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
									<form action="ventas-crud.php?create=true" method="post">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Cliente</h3> </label>
																<!-- Traer de la tabla de clientes las opciones -->
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control">
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT cl_id id, cl_nombre nombre FROM Cliente";
																		$rs = pg_query( $conexion, $qry );
																		while( $cliente = pg_fetch_object($rs) ){?>
																		<option value="<?php print $cliente->id;?>"><?php print $cliente->nombre;?></option>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>CI/RIF Cliente</h3> </label>
																<!-- Se debe rellenar automaticamente despues de seleccionar al cliente -->
																<div class="col-sm-9">
																	<input id="cl_rif" type="text" disabled="" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Modelo Avion</h3> </label>
																<!-- Traer de la tabla de modelo avion las opciones -->
																<div class="col-sm-9 select">
																	<select id="lista_modelos" name="modelo_avion" class="form-control">
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT am_id id, am_nombre nombre FROM Modelo_avion";
																		$rs = pg_query( $conexion, $qry );
																		while( $avion = pg_fetch_object($rs) ){?>
																		<option value="<?php print $avion->id;?>"><?php print $avion->nombre;?></option>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Submodelo Avion</h3> </label>
																<!-- Traer de la tabla de submodelo avion las opciones -->
																<div class="col-sm-9 select">
																	<select id="lista_submodelos" name="submodelo" class="form-control">
																	</select> 
																	<span class="help-block-none">
																		<small>Seleccionar Modelo Avion primero.</small>
																	</span> 
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Distribucion</h3> </label>
																<!-- Traer de la tabla de distribucion avion las opciones -->
																<div class="col-sm-9 select">
																	<select id="lista_distribuciones" name="distribucion" class="form-control">
																	</select> 
																	<span class="help-block-none">
																		<small>Seleccionar Modelo Avion primero.</small>
																	</span> 
																</div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Precio</h3> </label>
																<div class="col-sm-9">
																	<input name="precio" type="text" placeholder="Introduzca precio por Avion" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo de Pago</h3> </label>
																<div class="col-sm-9 select">
																	<select name="tipo_pago" class="form-control">
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
	<script>
		$( document ).ready(function() {
    		$("#lista_clientes").change(function() {
				var id = $( "#lista_clientes option:selected" ).val();
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=cl_rif&id="+id,success: function(data){$("#cl_rif").val(data);}});
			});
			$("#lista_modelos").change(function() {
				var id = $( "#lista_modelos option:selected" ).val();
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=submodelos&id="+id,success: function(data){$("#lista_submodelos").html(data);}});
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=distribuciones&id="+id,success: function(data){$("#lista_distribuciones").html(data);}});
			});
		});
	</script>
</body>

</html>