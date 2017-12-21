<!DOCTYPE html>
<?php include 'conexion.php'?>
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
								<a href="empleados.php" class="navbar-brand">
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
						<li class="active"> <a href="empleados.php"><i class="icon-man-people-streamline-user"></i>Empleados</a></li>
						<li> <a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a></li>
						<li> <a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a></li>
						<li> <a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a></li>
						<li> <a href="compras.php"> <i class="fa fa-cog" aria-hidden="true"></i>Compras </a></li>
						<li> <a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a></li>
					</ul>
				</nav>
				<div class="content-inner">
					<!-- TABS SECTION-->
					<section>
						<div class="container-fluid">
							<input id="tab0" type="radio" name="tabs" class="no-display" checked>
							<label for="tab0" class="label"><i class="fa fa-id-card-o" aria-hidden="true"></i> Empleados</label>
							<input id="tab1" type="radio" name="tabs" class="no-display">
							<label for="tab1" class="label"><i class="icon-map-streamline-user" aria-hidden="true"></i> Roles</label>
							<input id="tab2" type="radio" name="tabs" class="no-display">
							<label for="tab2" class="label"><i class="fa fa-university" aria-hidden="true"></i> Permisos</label>
							<!-- TAB ACTUALES -->
							<section id="content0" class="sectiontab">
								<!-- Filtrador-->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">MOSTRAR SOLO LOS USUARIOS QUE</h3>
													<form class="form-horizontal">
														<div class="row">
															<label class="col-sm-3 form-control-label">rol</label>
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
															<label class="col-sm-3 form-control-label">permiso</label>
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
															<label class="col-sm-3 form-control-label">estado</label>
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
								<!-- ACCIONISTA -->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<h3 class="h4">ACCIONAR OPCIONES</h3>
													<form class="form-horizontal">
														<div class="row">
															<div class="col-sm-12 select">
																<select name="account" class="form-control">
																	<option>Desbloquear a los usuarios seleccionados</option>
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
															<input type="submit" value="Ejecutar" class="btn btn-primary"> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- TABLE STARTS -->
								<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
												<button type="button" data-toggle="modal" data-target="#myModalEmpleadoCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
											</div>
										</div>
										<div class="card-body lpad-top">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<td>
															<div class="i-checks">
																<input id="checkboxCustom1" type="checkbox" value="" class="pad-top checkbox-template"> </div>
														</td>
														<th>NOMBRE</th>
														<th class="text-center">CI</th>
														<th class="text-center">FECHA INGRESO</th>
														<th class="text-center">BENEFICIARIOS</th>
														<th class="text-center">CARGO</th>
														<th class="text-center">ZONA</th>
														<th class="text-center">DIRECCION</th>
														<th class="text-center">Accion</th>
													</tr>
												</thead>
												<tbody>
													<?php 	
							$qry = "SELECT em_id id,em_nombre nombre, em_apellido apellido, em_nacionalidad nac, em_ci ci, em_fecha_ingreso fecha, COUNT(be_id) beneficiarios, er_nombre cargo, zo_nombre zona, lu_nombre direccion FROM Empleado left join Beneficiario ON be_empleado=em_id LEFT JOIN Cargo ON er_id=em_cargo LEFT JOIN Zona ON em_zona=zo_id LEFT JOIN Lugar on em_direccion=lu_id GROUP BY em_id ,em_nombre, em_nacionalidad, em_ci, em_fecha_ingreso, er_nombre, zo_nombre, lu_nombre ORDER BY em_id";
							$rs = pg_query( $conexion, $qry );
							while( $empleado = pg_fetch_object($rs) ){?>
														<tr>
															<td>
																<div class="i-checks">
																	<input id="checkboxCustom1" type="checkbox" value="" class="checkbox-template"> </div>
															</td>
															<td>
																<?php print $empleado->nombre." ".$empleado->apellido;?>
															</td>
															<td>
																<?php print $empleado->nac."-".number_format($empleado->ci, 0, ',', '.');?>
															</td>
															<td class="text-center">
																<?php $date = new DateTime($empleado->fecha); print $date->format('d-m-Y');?>
															</td>
															<td class="text-center">
																<?php print $empleado->beneficiarios;?>
															</td>
															<td class="text-center">
																<?php print $empleado->cargo;?>
															</td>
															<td class="text-center">
																<?php print $empleado->zona;?>
															</td>
															<td class="text-center">
																<?php print $empleado->direccion;?>
															</td>
															<td class="text-center">
																<a href="" data-toggle="modal" data-target="#ModalEmpleado<?php print $empleado->id;?>"> <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>&emsp;
																<a href="empleado-crud.php?delete=<?php print $empleado->id;?>"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
							$qry = "SELECT em_id id,em_nombre nombre, em_apellido apellido, em_nacionalidad nac, em_ci ci, em_fecha_ingreso fecha, em_usuario usuario, ti_nombre titulacion, sr_nombre rol, er_nombre cargo, se.se_nombre sede, zo.zo_nombre zona, pa.lu_nombre parroquia, mu.lu_nombre municipio, es.lu_nombre estado, zos.zo_nombre zona_s, seg.se_nombre sede_g, em_nota nota FROM Empleado left join Titulacion ON ti_id=em_titulacion LEFT JOIN Rol_sistema ON sr_id=em_rol LEFT JOIN Zona zo ON em_zona=zo.zo_id LEFT JOIN Zona zos ON em_supervisa=zos.zo_id LEFT JOIN Sede se on zo.zo_sede=se.se_id LEFT JOIN Sede seg on em_gerencia=seg.se_id LEFT JOIN Cargo ON er_id=em_cargo LEFT JOIN Lugar pa ON pa.lu_id=em_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar ORDER BY em_id";
							$rs = pg_query( $conexion, $qry );
							while( $empleado = pg_fetch_object($rs) ){?>
							<!-- Modal Empleado -->
							<div id="ModalEmpleado<?php print $empleado->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Nombre</h3> </div>
																	<div class="col-lg-8"><?php print $empleado->nombre;?></div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Apellido</h3> </div>
																	<div class="col-lg-8"><?php print $empleado->apellido;?></div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>CI</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->nac."-".number_format($empleado->ci, 0, ',', '.');?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Direccion</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->parroquia.", ".$empleado->municipio.", ".$empleado->estado;?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Fecha Ingreso</h3> </div>
																	<div class="col-lg-8"><?php $date = new DateTime($empleado->fecha); print $date->format('d-m-Y');?></div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Usuario</h3> </div>
																	<div class="col-lg-8"><?php print "@".$empleado->usuario;?></div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Titulacion</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->titulacion;?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Cargo</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->cargo;?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Rol de sistema</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->rol;?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Sede</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->sede;?> </div>
																</div>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Zona</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->zona;?> </div>
																</div>
																<?php if(!is_null($empleado->zona_s)){?>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Supervisa:</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->zona_s;?> </div>
																</div>
																<?php }?>
																<?php if(!is_null($empleado->sede_g)){?>
																<div class="row">
																	<div class="col-lg-4">
																		<h3>Gerencia:</h3> </div>
																	<div class="col-lg-8"> <?php print $empleado->sede_g;?> </div>
																</div>
																<?php }?>
															</div>
															<div class=" card-body col-lg-6">
																<?php  $qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_empleado=".$empleado->id;
																$answer = pg_query( $conexion, $qry );
																$num = pg_num_rows($answer);
																if($num > 0){?>
																<div class="row">
																	<div class="col-lg-12">
																		<h3>Contacto</h3> 
																	</div>
																	<?php 
																	while( $contacto = pg_fetch_object($answer) ){?>
																	<div class="col-lg-12 text-left"><?php print $contacto->tipo." - ".$contacto->valor;?></div> 
																	<?php }?>
																</div>
																<?php }?>
																<?php  $qry = "SELECT be_nombre AS nombre, be_apellido AS apellido, be_nacionalidad AS nac, be_ci AS ci FROM Beneficiario WHERE be_empleado=".$empleado->id;
																$answer = pg_query( $conexion, $qry );
																$num = pg_num_rows($answer);
																if($num > 0){?>
																<div class="row">
																	<div class="col-lg-12">
																		<h3>Beneficiarios</h3> </div>
																	<?php
																	while( $beneficiario = pg_fetch_object($answer) ){?>
																	<div class="col-lg-12 text-left"><?php print $beneficiario->nombre." ".$beneficiario->apellido." / ".$beneficiario->nac."-".number_format($beneficiario->ci, 0, ',', '.');?></div> 
																	<?php }?>
																</div>
																<?php }?>
																<?php $qry = "SELECT ex_descripcion AS desc, ex_years AS years FROM Experiencia WHERE ex_empleado=".$empleado->id;
																$answer = pg_query( $conexion, $qry );
																$num = pg_num_rows($answer);
																if($num > 0){?>
																<div class="row">
																	<div class="col-lg-12">
																		<h3>Experiencia</h3> 
																	</div>
																	<?php 
																	while( $experiencia = pg_fetch_object($answer) ){?>
																	<div class="col-lg-12 text-left"><?php print $experiencia->desc." / ".$experiencia->years." años.";?></div> 
																	<?php }?>
																</div>
																<?php }?>
																<?php if(!is_null($empleado->nota)){?>
																<div class="row">
																	<div class="col-lg-3">
																		<h3>Nota</h3> </div>
																	<div class="col-lg-9"> <?php print $empleado->nota;?> </div>
																</div>
																<?php }?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>&emsp;
											<button type="button" data-toggle="modal" data-target="#myModalEmpleadoEditar" class="btn btn-primary">Editar</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal Empleado ENDS -->
							<?php }?>
							<!-- Modal Empleado Editar -->
							<div id="myModalEmpleadoEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
																		<h3>Apellido</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Apellido" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Fecha Ingreso</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Fecha de Ingreso" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Usario</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Clave</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Clave de Ingreso" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Titulacion</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Titulacion" class="form-control"><span class="help-block-none"><small>Si posee mas de una, separar con ' ; ' ejemplo: PhD; Doctorado; Bachiller...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Cargo</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Cargo que ocupa" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Rol</h3> </label>
																	<div class="col-sm-9 select">
																		<select name="account" class="form-control">
																			<option>Gerente</option>
																			<option>Obrero</option>
																			<option>Secretario</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Zona</h3> </label>
																	<div class="col-sm-9 select">
																		<select name="account" class="form-control">
																			<option>Ensamblaje de Alas</option>
																			<option>Ensamblaje de Motores</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Direccion</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca la Direccion de vivienda" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Supervisado por</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Nombre de Supervisor" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Gerencia a</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca nombre de quien gerencia" class="form-control"><span class="help-block-none"><small>Si posee mas de un empleado, separar con ' ; ' ejemplo: Jonatha Calcuta; Micky Mouse; Carrillo Peruano...</small></span> </div>
																</div>
															</div>
															<div class=" card-body col-lg-6">
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>CI</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" disabled="" placeholder="No modificable" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Contacto</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Contacto" class="form-control"><span class="help-block-none"><small>Si posee mas de un contacto, separar con ' ; ' ejemplo: contacto1; contacto2; contacto3...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Beneficiarios</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca nombre de Beneficiario" class="form-control"><span class="help-block-none"><small>Si posee mas de un Beneficiario, separar con ' ; ' ejemplo: Pablito Picado; Raul Contreras; Fanny Lu...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Experiencia</h3> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
																	<label class="col-sm-3 form-control-label"> <small>extra</small> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
																	<label class="col-sm-3 form-control-label"> <small>extra</small> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
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
							<!-- Modal Empleado Editar ENDS -->
							<!-- Modal Empleado Crear -->
							<div id="myModalEmpleadoCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
																		<h3>Apellido</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Apellido" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Fecha Ingreso</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Fecha de Ingreso" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Usario</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Usuario" class="form-control"><span class="help-block-none"><small>El nombre de usuario debe ser unico.</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Clave</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Clave de Ingreso" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Titulacion</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Titulacion" class="form-control"><span class="help-block-none"><small>Si posee mas de una, separar con ' ; ' ejemplo: PhD; Doctorado; Bachiller...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Cargo</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Cargo que ocupa" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Rol</h3> </label>
																	<div class="col-sm-9 select">
																		<select name="account" class="form-control">
																			<option>Gerente</option>
																			<option>Obrero</option>
																			<option>Secretario</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Zona</h3> </label>
																	<div class="col-sm-9 select">
																		<select name="account" class="form-control">
																			<option>Ensamblaje de Alas</option>
																			<option>Ensamblaje de Motores</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Direccion</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca la Direccion de vivienda" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Supervisado por</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Nombre de Supervisor" class="form-control"> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Gerencia a</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca nombre de quien gerencia" class="form-control"><span class="help-block-none"><small>Si posee mas de un empleado, separar con ' ; ' ejemplo: Jonatha Calcuta; Micky Mouse; Carrillo Peruano...</small></span> </div>
																</div>
															</div>
															<div class=" card-body col-lg-6">
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>CI</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca CI" class="form-control"><span class="help-block-none"><small>Usar formato: V-24888584 o E-01523487</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Contacto</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca Contacto" class="form-control"><span class="help-block-none"><small>Si posee mas de un contacto, separar con ' ; ' ejemplo: contacto1; contacto2; contacto3...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Beneficiarios</h3> </label>
																	<div class="col-sm-9">
																		<input type="text" placeholder="Introduzca nombre de Beneficiario" class="form-control"><span class="help-block-none"><small>Si posee mas de un Beneficiario, separar con ' ; ' ejemplo: Pablito Picado; Raul Contreras; Fanny Lu...</small></span> </div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-3 form-control-label">
																		<h3>Experiencia</h3> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
																	<label class="col-sm-3 form-control-label"> <small>extra</small> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
																	<label class="col-sm-3 form-control-label"> <small>extra</small> </label>
																	<div class="col-sm-7">
																		<input type="text" placeholder="Descripcion de Experiencia" class="form-control"> </div>
																	<div class="col-md-2">
																		<input type="text" placeholder="Años" class="form-control"> </div>
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
							<!-- Modal Empleado Crear ENDS -->
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
		<script src="vendor/popper.js/umd/popper.min.js">
		</script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/jquery.cookie/jquery.cookie.js">
		</script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="js/front.js"></script>
	</body>

	</html>