<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }?>
<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>AirUCAB - Empleados</title>
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
								<a href="empleados.php" class="navbar-brand">
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
						<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) ){ ?>
						<li>
							<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
						</li>
						<?php }?>
						<?php if( in_array("em_r", $permiso) || in_array("em_c", $permiso) ){ ?>
						<li class="active">
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
						<?php if( in_array("fv_r", $permiso) ){ ?>
						<li>
							<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
						</li>
						<?php }?>
						<?php if( in_array("fc_r", $permiso) ){ ?>
						<li>
							<a href="compras.php"> <i class="fa fa-cog" aria-hidden="true"></i>Compras </a>
						</li>
						<?php }?>
					</ul>
				</nav>
				<div class="content-inner">
					<?php if(isset($_GET['error'])){?>
					<!-- Alert -->
					<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
						<?php if($_GET['error']==1){?>Error al crear <strong>Empleado</strong>.<?php }?>
						<?php if($_GET['error']==2){?>Error al insertar <strong>Contacto</strong>.<?php }?>
						<?php if($_GET['error']==3){?>Error al insertar <strong>Beneficiario</strong>.<?php }?>
						<?php if($_GET['error']==4){?>Error al insertar <strong>Experiencia</strong>.<?php }?>
						<?php if($_GET['error']==5){?>Error al editar <strong>Empleado</strong>.<?php }?>
						<?php if($_GET['error']==6){?>Error al editar <strong>Contacto</strong>.<?php }?>
						<?php if($_GET['error']==7){?>Error al editar <strong>Beneficiario</strong>.<?php }?>
						<?php if($_GET['error']==8){?>Error al editar <strong>Experiencia</strong>.<?php }?>
						<?php if($_GET['error']==9){?>Error al eliminar <strong>Distribución de Avión</strong>.<?php }?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php }?>
					<!-- TABS SECTION-->
					<section>
						<div class="container-fluid">
							<?php if( in_array("em_r", $permiso) || in_array("em_c", $permiso) ){?>
							<input id="tab0" type="radio" name="tabs" class="no-display" <?php if( !isset($_GET['tab']) ) print "checked";?>>
							<label for="tab0" class="label"><i class="fa fa-id-card-o" aria-hidden="true"></i> Empleados</label>
							<?php }?>
							<?php if( in_array("sr_r", $permiso) || in_array("sr_c", $permiso) ){?>
							<input id="tab1" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "rol" ) print "checked";?>>
							<label for="tab1" class="label"><i class="fa fa-street-view" aria-hidden="true"></i> Roles</label>
							<?php }?>
							<?php if( in_array("rp_r", $permiso) ){?>
							<input id="tab2" type="radio" name="tabs" class="no-display" <?php if( $_GET['tab'] == "permiso" ) print "checked";?>>
							<label for="tab2" class="label"><i class="fa fa-university" aria-hidden="true"></i> Permisos</label>
							<?php }?>
							<!-- TAB ACTUALES -->
							<section id="content0" class="sectiontab">
								<!-- Filtrador-->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">Filtrar usuarios por:</h3>
													<form class="form-horizontal" method="post">
														<div class="row">
															<label class="col-sm-3 form-control-label">Rol</label>
															<div class="col-sm-9 select">
																<select name="rol" class="form-control">
																	<option value="NULL">Seleccionar</option>
																	<?php $qry = "SELECT sr_id id, sr_nombre nombre FROM Rol_sistema";
																	$rs = pg_query( $conexion, $qry );
																	while( $rol = pg_fetch_object($rs) ){?>
																	<option value="<?php print $rol->id;?>">
																		<?php print $rol->nombre;?>
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
										<?php if( in_array("em_c", $permiso) ){?>
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#ModalCrearEmpleado" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<?php }?>
										<?php if( in_array("em_r", $permiso) ){?>
										<?php $qry = "SELECT em_id id,em_nombre ||' '|| em_apellido AS nombre, em_nacionalidad nac, em_ci ci, em_fecha_ingreso fecha,COUNT(be_id) beneficiarios, er_nombre cargo, se_nombre sede, lu_nombre direccion FROM Empleado LEFT JOIN Beneficiario ON be_empleado=em_id LEFT JOIN Cargo ON er_id=em_cargo LEFT JOIN Zona ON em_zona=zo_id LEFT JOIN Sede ON se_id=zo_sede LEFT JOIN Lugar on em_direccion=lu_id GROUP BY em_id ,em_nombre, em_nacionalidad, em_ci, em_fecha_ingreso, er_nombre, se_nombre, lu_nombre ORDER BY em_id";
										$rs = pg_query( $conexion, $qry );
										$howMany = pg_num_rows($rs);
										if( $howMany > 0 ){?>
										<div class="card-body lpad-top">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th class="text-center">Nombre</th>
														<th class="text-center">CI</th>
														<th class="text-center">Cargo</th>
														<th class="text-center">Sede</th>
														<th class="text-center"># de Beneficiarios</th>
														<th class="text-center">Fecha de Ingreso</th>
														<th class="text-center">Dirección</th>
														<th class="text-center">Accion</th>
													</tr>
												</thead>
												<tbody>
													<?php while( $empleado = pg_fetch_object($rs) ){?>
														<tr>
															<td>
																<?php print $empleado->nombre;?>
															</td>
															<td class="text-center">
																<?php print $empleado->nac."-".number_format($empleado->ci, 0, ',', '.');?>
															</td>
															<td class="text-center">
																<?php print $empleado->cargo;?>
															</td>
															<td class="text-center">
																<?php print $empleado->sede;?>
															</td>
															<td class="text-center">
																<?php print $empleado->beneficiarios;?>
															</td>
															<td class="text-center">
																<?php $date = new DateTime($empleado->fecha); print $date->format('d-m-Y');?>
															</td>
															<td class="text-center">
																<?php print $empleado->direccion;?>
															</td>
															<td class="text-center">
																<a class="click-empleado-detalle" href="<?php print $empleado->id;?>"> 
																	<i class="fa fa-file-text-o" aria-hidden="true" title="Ver mas"></i> 
																</a>
																<?php if( in_array("em_d", $permiso) ){ ?>&emsp;
																<a href="empleado-crud.php?delete=<?php print $empleado->id;?>">
																	<i class="fa fa-trash-o" aria-hidden="true"></i> 
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
							<!-- Modal Empleado Crear -->
							<div id="ModalCrearEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<form action="empleado-crud?create=true" method="post">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">Crear Empleado</h4>
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
																			<h4>Apellido</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="apellido" type="text" placeholder="Introduzca Apellido" class="form-control" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>CI</h4> 
																		</label>
																		<div class="col-sm-2 select">
																			<select name="nacionalidad" class="form-control" required>
																				<option value="V">V</option>
																				<option value="E">E</option>
																				<option value="P">P</option>
																			</select>
																		</div>
																		<div class="col-sm-7">
																			<input name="ci" type="text" placeholder="Introduzca CI" class="form-control" pattern="\d+">
																			<span class="help-block-none">
																				<small>Introduzca unicamente el número.</small>
																			</span> 
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Usario</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="usuario" type="text" placeholder="Introduzca Usuario" class="form-control" required>
																			<span class="help-block-none"><small>El nombre de usuario debe ser unico.</small></span> 
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Clave</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="clave" id="new-user-pass" type="password" placeholder="Introduzca Clave de Ingreso" class="form-control" required>
																			<span class="help-block">
																				<i id="show-hide-pass" class="fa fa-eye" aria-hidden="true"></i>
																			</span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Titulación</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select name="titulacion" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT ti_id id, ti_nombre nombre FROM Titulacion ORDER BY ti_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $titulacion = pg_fetch_object($rs) ){?>
																				<option value="<?php print $titulacion->id;?>">
																					<?php print $titulacion->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Cargo</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select name="cargo" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT er_id id, er_nombre nombre FROM Cargo ORDER BY er_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $cargo = pg_fetch_object($rs) ){?>
																				<option value="<?php print $cargo->id;?>">
																					<?php print $cargo->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Rol</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select name="rol" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT sr_id id, sr_nombre nombre FROM Rol_sistema WHERE sr_nombre<>'Usuario Anónimo' ORDER BY sr_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $rol = pg_fetch_object($rs) ){?>
																				<option value="<?php print $rol->id;?>">
																					<?php print $rol->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Estado</h4> 
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-estados" name="estado" class="form-control">
																				<option value='NULL'>Seleccionar</option>
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
																			<h4>Municipio</h4> 
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-municipios" name="municipio" class="form-control" disabled>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Parroquia</h4> 
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-parroquias" name="parroquia" class="form-control" disabled>
																			</select>
																		</div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Sede</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-sedes" name="sede" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT se_id id, se_nombre nombre FROM Sede ORDER BY se_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $sede = pg_fetch_object($rs) ){?>
																				<option value="<?php print $sede->id;?>">
																					<?php print $sede->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																		<div class="col-sm-3"></div>
																		<div class="form-check col-sm-9">
																			<label class="form-check-label">
																				<input id="check-gerente" name="gerencia" type="checkbox" class="form-check-input">
																				Es gerente de esta sede
																			</label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Zona</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-zonas" name="zona" class="form-control" disabled required>
																			</select>
																		</div>
																		<div class="col-sm-3"></div>
																		<div class="form-check col-sm-9">
																			<label class="form-check-label">
																				<input id="check-supervisor" name="supervisa" type="checkbox" class="form-check-input">
																				Es supervisor de esta zona
																			</label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-12 form-control-label">
																			<h4>Contacto</h4> 
																		</label>
																	</div>
																	<div class="form-group row last-contacto">
																		<div class="col-sm-3"></div>
																		<div class="col-sm-3 select">
																			<select name="tipo_contacto[]" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $tipo_contacto = pg_fetch_object($rs) ){?>
																				<option value="<?php print $tipo_contacto->id;?>">
																					<?php print $tipo_contacto->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																		<div class="col-sm-6">
																			<input name="contacto[]" type="text" placeholder="Introduzca Contacto" class="form-control" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-sm-12 text-right">
																			<i id="add-contacto" class="fa fa-plus"></i>&emsp;
																		</div>
																	</div>
																	<div class="form-group row last-beneficiario">
																		<label class="col-sm-3 form-control-label">
																			<h4>Beneficiarios</h4> 
																		</label>
																	</div>
																	<div class="form-group row">
																		<div class="col-sm-12 text-right">
																			<i id="add-beneficiario" class="fa fa-plus"></i>&emsp;
																		</div>
																	</div>
																	<div class="form-group row last-experiencia">
																		<label class="col-sm-3 form-control-label">
																			<h4>Experiencia</h4>
																		</label>
																	</div>
																	<div class="form-group row">
																		<div class="col-sm-12 text-right">
																			<i id="add-experiencia" class="fa fa-plus"></i>&emsp;
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
							<!-- Modal Empleado Crear ENDS -->
							<!-- Modal Detalle Empleado -->
							<div id="ModalDetalleEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="detalleEmpleadoBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Detalle Empleado ENDS -->
							<!-- Modal Empleado Editar -->
							<div id="ModalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="editarEmpleadoBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Empleado Editar ENDS -->
							
							<section id="content1" class="sectiontab">
								<div class="pad-left">
									<!-- TABLE STARTS -->
									<div class="col-md-12">
										<div class="card">
											<div class="card-header d-flex align-items-center">
												<h3 class="h4">Roles de Usuario</h3> </div>
											<div class="card-body">
												<table class="table table-striped table-sm table-hover">
													<thead>
														<tr>
															<th>Nombre</th>
															<th class="text-center">Acciones</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Administrador</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#myModalNombre"> <i class="fa fa-cogs" aria-hidden="true"></i> </a>
																<a href="" data-toggle="modal" data-target="#myModalPermiso"> <i class="fa fa-university" aria-hidden="true"></i> </a>
															</td>
														</tr>
														<tr>
															<td>Gerente</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#myModalNombre"> <i class="fa fa-cogs" aria-hidden="true"></i> </a>
																<a href="" data-toggle="modal" data-target="#myModalPermiso"> <i class="fa fa-university" aria-hidden="true"></i> </a>
															</td>
														</tr>
														<tr>
															<td>Director Operaciones</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#myModalNombre"> <i class="fa fa-cogs" aria-hidden="true"></i> </a>
																<a href="" data-toggle="modal" data-target="#myModalPermiso"> <i class="fa fa-university" aria-hidden="true"></i> </a>
															</td>
														</tr>
													</tbody>
												</table>
												<!-- Boton para Modal -->
												<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-md pull-right">Nuevo Rol </button>
												<!-- Modal-->
												<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
													<div role="document" class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 id="exampleModalLabel" class="modal-title">Nuevo Rol</h4>
																<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
															</div>
															<div class="modal-body">
																<p>Introduzca los datos necesarios</p>
																<form>
																	<div class="form-group">
																		<input type="email" placeholder="Nombre de Rol" class="form-control"> </div>
																</form>
															</div>
															<div class="modal-footer">
																<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
																<button type="button" class="btn btn-primary">Crear</button>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal ENDS -->
												<!-- Modal Cambio Nombre-->
												<div id="myModalNombre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
													<div role="document" class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 id="exampleModalLabel" class="modal-title">Editar Nombre Rol</h4>
																<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
															</div>
															<div class="modal-body">
																<p>Introduzca los datos necesarios</p>
																<form>
																	<div class="form-group">
																		<input type="email" placeholder="Nombre de Rol" class="form-control"> </div>
																</form>
															</div>
															<div class="modal-footer">
																<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
																<button type="button" class="btn btn-primary">Editar</button>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal Cambio NombreENDS -->
												<!-- Modal Permisos-->
												<div id="myModalPermiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
													<div role="document" class="modal-dialog modal-xl">
														<div class="modal-content">
															<div class="modal-header">
																<h4 id="exampleModalLabel" class="modal-title">PERMISOS</h4>
																<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
															</div>
															<div class="modal-body">
																<!-- TABLE MODAL PERMISOS STARTS -->
																<div class="col-md-12">
																	<div class="card">
																		<div class="card-body">
																			<table class="table table-striped table-sm table-hover">
																				<thead>
																					<tr>
																						<th class="font-big text-center text-middle">Permiso</th>
																						<th class="font-big text-center text-middle">Administrador</th>
																					</tr>
																				</thead>
																				<tbody>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>BLOQUEO</strong></td>
																						<td></td>
																					</tr>
																					<tr>
																						<td>Administrar bloqueo a otros usuarios</td>
																						<td>
																							<div class="i-checks">
																								<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
																<!-- TABLE MODAL PERMISOS ENDS -->
															</div>
															<div class="modal-footer">
																<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
																<button type="button" class="btn btn-primary">Editar</button>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal Permisos ENDS -->
											</div>
										</div>
									</div>
									<!-- TABLE ENDS -->
								</div>
							</section>
							<!-- /TAB ACTUALES -->
							<!-- TAB RECICLADOS -->
							<section id="content2" class="sectiontab">
								<div class="pad-left">
									<!-- TABLE STARTS -->
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<table class="table table-striped table-sm table-hover">
													<thead>
														<tr>
															<th class="font-big text-center text-middle">Permiso</th>
															<th class="font-big text-center text-middle">Administrador</th>
															<th class="font-big text-center text-middle">Gerente</th>
															<th class="font-big text-center text-middle">Director
																<br>Operaciones</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
														<tr>
															<td><strong>BLOQUEO</strong></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>Administrar bloqueo a otros usuarios</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- TABLE ENDS -->
								</div>
							</section>
						</div>
					</section>
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
		<script src="vendor/popper.js/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="js/front.js"></script>
		<script>
		$("#list-sedes").change(function () {
			var href = $("#list-sedes option:selected").val();
			$("#list-zonas").removeAttr('disabled');
			$.ajax({
				type: "POST"
				, dataType: "html"
				, url: "getter.php?get=zonas&id=" + href
				, success: function (data) {
					$("#list-zonas").html(data);
				}
			});
		});
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
		$("#show-hide-pass").click(function () {
			if($(this).hasClass("fa-eye")){
				$("#new-user-pass").attr("type","text");
				$(this).removeClass("fa-eye");
				$(this).addClass("fa-eye-slash");
			}
			else{
				$("#new-user-pass").attr("type","password");
				$(this).removeClass("fa-eye-slash");
				$(this).addClass("fa-eye");
			}
		});
		$("#add-contacto").click(function(){
			var $last = $(".last-contacto");
			$last.removeClass("last-contacto");
			$.ajax({
				type: "POST",
				dataType: "html",
				url:"getter.php?get=fieldContacto",
				success: function(data){
					$last.after(data);
				}
			});
		});
		$("#add-beneficiario").click(function(){
			var $last = $(".last-beneficiario");
			$last.removeClass("last-beneficiario");
			$.ajax({
				type: "POST",
				dataType: "html",
				url:"getter.php?get=fieldBeneficiario",
				success: function(data){
					$last.after(data);
				}
			});
		});
		$("#add-experiencia").click(function(){
			var $last = $(".last-experiencia");
			$last.removeClass("last-experiencia");
			$.ajax({
				type: "POST",
				dataType: "html",
				url:"getter.php?get=fieldExperiencia",
				success: function(data){
					$last.after(data);
				}
			});
		});
		$('#check-gerente').click(function(){
			if($('#check-gerente').is(':checked'))
				$('#check-supervisor').prop('disabled', true);
			else
				$('#check-supervisor').prop('disabled', false);
		});
		$('#check-supervisor').click(function(){
			if($('#check-supervisor').is(':checked'))
				$('#check-gerente').prop('disabled', true);
			else
				$('#check-gerente').prop('disabled', false);
		});
		$( "a.click-empleado-detalle" ).click(function( event ) {
			event.preventDefault();
			var href = $(this).attr('href');
			$.ajax({type: "POST",dataType: "html",url:"empleado-detalle.php?id="+href,success: function(data){$("#detalleEmpleadoBody").html(data);}});
			$("#ModalDetalleEmpleado").modal('toggle');
		});
	</script>
	</body>

	</html>