<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("pr_r", $permiso) && !in_array("st_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
    else{
        header('Location: traslados.php');
		exit;
    }
}?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Pruebas</title>
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
					<?php if( in_array("em_r", $permiso) || in_array("sr_r", $permiso) || in_array("er_r", $permiso) || in_array("ti_r", $permiso) || in_array("pe_r", $permiso) || in_array("ct_r", $permiso) ){ ?>
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
					<?php if( in_array("pr_r", $permiso) || in_array("st_r", $permiso)){ ?>
					<li class="active">
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
                        <?php if( in_array("pr_r", $permiso) ){?>
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Pruebas</label>
                        <?php }?>			
						<!-- TAB Pruebas -->
						<section id="content0" class="sectiontab">
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
                                    <?php if( in_array("pr_c", $permiso) ){ ?>
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalPruebaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
                                    <?php } ?>
                                    <?php if( in_array("pr_r", $permiso) ){?>
									<?php $qry = "SELECT pr_id id, pr_nombre nombre, pm_nombre producto, em_nacionalidad ||'-'|| em_ci ||' | '|| em_nombre ||' '|| em_apellido AS responsable, pr_tipo tipo, 'pieza' as type, (SELECT MAX(st_nombre) FROM Status,Prueba_pieza WHERE pp_prueba=pr_id AND pp_status=st_id) status FROM Prueba LEFT JOIN Prueba_pieza ON pp_prueba=pr_id LEFT JOIN Pieza ON pp_pieza=p_id LEFT JOIN Modelo_pieza ON p_modelo_pieza=pm_id LEFT JOIN Empleado ON pr_empleado=em_id GROUP BY pr_id, nombre, producto, responsable UNION SELECT pr_id id, pr_nombre nombre, mt_nombre producto, em_nacionalidad ||'-'|| em_ci ||' | '|| em_nombre ||' '|| em_apellido AS responsable, pr_tipo tipo, 'material' as type, (SELECT MAX(st_nombre) FROM Status,Prueba_material WHERE prm_prueba=pr_id AND prm_status=st_id) status FROM Prueba LEFT JOIN Prueba_material ON prm_prueba=pr_id LEFT JOIN Material ON prm_material=m_id LEFT JOIN Tipo_material ON m_tipo_material=mt_id LEFT JOIN Empleado ON pr_empleado=em_id GROUP BY pr_id, nombre, producto, responsable ORDER BY nombre";
									$rs = pg_query( $conexion, $qry );
									$howMany = pg_num_rows($rs);
									if( $howMany > 0 ){?>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">Nombre</th>
                                                    <th class="text-center">Responsable</th>
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Status</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												<?php while( $prueba = pg_fetch_object($rs)){ ?>
                                                <?php if(isset($prueba->producto)){?>
												<tr>                                                    
                                                    <td class="text-center">
                                                        <?php print $prueba->nombre;?>
                                                    </td>
													<td class="text-center">
                                                        <?php print $prueba->responsable;?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php print $prueba->tipo;?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($prueba->status == "Aprobada") {?>
                                                        <span class="badge badge-success">
                                                            <?php print $prueba->status;?>
                                                        </span>                                                        
                                                        <?php } elseif($prueba->status == "Rechazado") {?>
                                                        <span class="badge badge-danger">
                                                            <?php print $prueba->status;?>
                                                        </span>                                                          
                                                        <?php } else {?>
                                                        <span class="badge badge-info">
                                                            <?php print $prueba->status;?>
                                                        </span>
                                                        <?php } ?>                                                       
                                                    </td>
													<td class="text-center">
                                                        <?php if(in_array("pr_u", $permiso)){?>
														<a href="<?php print $prueba->id;?>" data-toggle="modal" data-target="#myModalPrueba"> 
                                                            <i class="fa fa-pencil" aria-hidden="true" title="Editar"></i> 
                                                        </a>
                                                        <?php} if(in_array("pr_d", $permiso)){ ?>&emsp;
														<a href="
                                                            <?php 
                                                            if($prueba->type == "pieza")print "prueba_pieza-crud.php?delete=".$prueba->id;
                                                            if($prueba->type == "material")print "prueba_material-crud.php?delete=".$prueba->id;    
                                                            ?>
                                                        "> 
                                                            <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i> 
                                                        </a>
                                                        <?php }?>
													</td>
												</tr>													
												<?php }}?>
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


						<!-- TAB Pruebas -->
						<section id="content1" class="sectiontab">
							
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalStatusCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th>NOMBRE</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td><span class="badge badge-primary">EN TRAYECTO</span></td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalStatusEditar"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													
													
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						

						


						
						

												
						<!-- Modal Prueba Editar -->
						<div id="myModalPrueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDITAR PRUEBA</h4>
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
																	<h3>Tipo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo" class="form-control"> </div>
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
						<!-- Modal Prueba Editar ENDS -->


						<!-- Modal Status Editar -->
						<div id="myModalStatusEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDITAR STATUS</h4>
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
						<!-- Modal Status Editar ENDS -->

					

						

						<!-- Modal Prueba Crear -->
						<div id="myModalPruebaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR PRUEBA</h4>
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
																	<h3>Tipo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo" class="form-control"> </div>
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
						<!-- Modal Prueba Crear ENDS -->

						<!-- Modal Status Crear -->
						<div id="myModalStatusCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR STATUS</h4>
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
						<!-- Modal Status Crear ENDS -->

						






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
