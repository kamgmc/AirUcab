<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("am_r", $permiso) && !in_array("as_r", $permiso) && !in_array("di_r", $permiso) ){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
	else{
		header('Location: motores.php');
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
								<a href="modeloavion.php" class="navbar-brand">
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
						<li class="active">
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

					<section>
						<div class="container-fluid">
							<div class="card-columns">
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Producción anual</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Promedio de producción mensual</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Los mejores 10 clientes en base a la cantidad de compras por año.</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Modelos de aviones</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Cantidad media de aviones producida mensualmente según el modelo</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">El modelo mas vendido</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">El equipo mas eficiente</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Inventario Mensual</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Producto mas pedido al inventario</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">El tipo de alas mas utilizado en los aviones</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Cuales fueron los aviones mas rentables en base al cumplimiento de las fechas durante a su producción</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Especificaciones de modelo</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Cantidad de productos que no cumplieron con las pruebas de calidad</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Promedio de traslados entre las sedes</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Listado de Proveedores</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Planta mas eficiente en base al cumplimiento de las fechas</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
								<div class="card">
									
									<div class="card-body">
										<h5 class="blockquote card-title">Descripción de piezas</h5>
										<p class="card-text">Aqui ponemos lo que se necesita mostrar</p>
									</div>
								</div>
							</div>
							<div class="card-columns1">
							<div class="card p-3">
									
									<div class="card-body">
										<h5 class=" blockquote card-title">Historia de la Aviación en Venezuela</h5>
										<p class="card-text">
											Después del 29 de septiembre de 1912, cuando el célebre vuelo de Frank Boland sobre Caracas, estábamos en el umbral
											de la I Guerra Mundial y será en ese conflicto cuando la aviación pasa a convertirse en un arma poderosa. A comienzos del año
											1920 el empresario caraqueño Eloy Pérez suscribe un contrato con el teniente italiano Cosme Renella, con el fin de ofrecer en la
											capital y otras ciudades del interior del país, una serie de espectáculos que prácticamente eran maniobras ejecutadas por el
											referido piloto.
											A partir de este momento recobra una gran importancia la necesidad de contar con una aviación militar para el país.
											Por lo que el Presidente de la República, General Juan Vicente Gómez, ordena preparar un decreto creando la Escuela de
											Aviación Militar de Venezuela, lo cual ocurrió el 17 de abril de 1920. Venezuela ya está en el umbral de la naciente aeronáutica.
											En la década del 20 suceden interesantes acontecimientos
											tanto en la naciente aviación militar como en lo civil. Ya para el 14 de
											junio de 1920, la fábrica francesa de aviones entregó al Agregado
											Comercial de Venezuela en París, Emilio Posse Rivas los primeros
											aviones –Caudron G3para
											la naciente Escuela de Aviación.
											Posteriormente, el 19 de diciembre el General Gómez inaugura
											solemnemente la Escuela de Aviación Militar.
											Para 1929, la aviación comercial europea y estadounidense
											estaban interesadas en incursionar en nuestro país para incluirlo en
											sus rutas internacionales. Así el 26 de septiembre de ese año, regresa Lindbergh, pero esta vez en un vuelo experimental de la
											Pan American. Luego de un corto análisis, solicitan permiso para iniciar sus vuelos que comenzaron el 6 de mayo de 1930, desde
											Maiquetía donde arrendaron a la Familia Luy una franja de terreno para construir un campo de aterrizaje y una pequeña oficina
											para atender a los arriesgados pasajeros, hoy Aeropuerto Internacional de Maiquetía.
											También a fines de 1929 la Compagnie Generales Aeropostale FrancesCGAFque
											estaba ya operando en Brasil, manda
											por barco un avión Potez de 8 puestos el cual es armado en Maracay cuya finalidad era igualmente estudiar las posibilidades de
											establecerse aquí, pero desde la capital aragüeña. La empresa es autorizada a volar en las rutas MaracayBarquisimeto,
											Barinas, San Fernando de Apure, Coro, Maracaibo y Ciudad Bolívar, con el nombre de Aviación Nacional Venezolana.
											Para 1931, el gobierno había concluido la construcción del campo de Boca de Río para la
											aviación comercial. El 1 de enero de 1934, ya el país contaba con la Línea Aeropostal
											Venezolana (LAV), pasando a depender directamente del Ministerio de Guerra y Marina,
											siendo todos sus pilotos militares. Entre 19401945
											Pan American hace entrega de los
											aeropuertos de Maiquetía, Maturín y Maracaibo. En junio de 1943, con el apoyo de Pan
											American Airways Inc. y Mexicana de Aviación, firmaron el contrato para la explotación
											del transporte aéreo de servicio general entre Aerovías Venezolanas S.A., AVENSA, y el
											Gobierno Nacional. Se funda también la empresa Taca.
											Entre 19451950,
											a raíz del golpe de Estado del 18 de octubre de 1945, significativos cambios se producen en la vida
											2
											UCABIngeniería
											Informática Sist.
											De Base de Datos I – Prof. Ana K Fernandes
											política, social, económica y militar venezolanas. Así tenemos que el Ministerio del Trabajo y Comunicaciones se divide en dos, y
											este último abarcó entre sus áreas el sector aéreo. De la misma manera, el 17 de junio de 1946 es decretada la creación de la
											Fuerza Aérea Venezolana.
											LAV compra una flota de DC3,
											cuatro DC4
											y dos Martin 202, los cuales
											son vendidos ya reformados para uso civil. Asimismo, se planifica extender sus
											vuelos al exterior para lo cual negocia la adquisición de dos Constellation 049,
											primeras y modernas aeronaves cuatrimotores de la posguerra, con los cuales crea
											la División Internacional e inicia sus vuelos a Nueva York, Curazao, y Trinidad.
											Asimismo, el Gobierno nacionaliza todos los aeropuertos que estaban administrados
											por la LAV. Como no existía aun una buena red de carreteras en el país, LAV se encarga de conectar a los sitios mas apartados
											de nuestra geografía con la capital.
											En 1948 se funda RANSA, una empresa dedicada al transporte de carga. Es importante señalar que para 1952 los
											ingleses habían
											iniciado los
											vuelos con
											aviones a
											reacción, los
											Comets.
											Entre 19551959,
											el anuncio de BOEING de sacar al mercado una aeronave comercial a reacción, creó una
											expectativa en casi todas las aerolíneas del mundo. En Maiquetía aterrizó el primer B707
											en vuelo de demostración de PANAM
											en 1958 e inició sus vuelos comerciales Nueva YorkCaracasBuenos
											Aires en 1959.
											3
											UCABIngeniería
											Informática Sist.
											De Base de Datos I – Prof. Ana K Fernandes
											En la década de 19601970,
											la aparición de Viasa constituyó todo un acontecimiento. Es indiscutible que esta aerolínea
											nació con buen pie y una excelente gerencia que la pudo colocar entre las 12 primeras aerolíneas del mundo.
											El tráfico de pasajeros domésticos e internacionales se incrementó en el país y el aeropuerto de Maiquetía se va haciendo más
											pequeño e incómodo. Por lo que el Ministerio de Obras Públicas (MOP) trabajó en la construcción de un moderno aeropuerto para
											Caracas, a fin de desarrollar un moderno Terminal aéreo para Maiquetía en el marco de un Plan Maestro que es elaborado por
											profesionales venezolanos.
											El Estado adquiere una parte accionaria de Viasa, y compra una flotilla de
											aviones DC9
											para Aeropostal así como equipos DC10
											para Viasa. Igualmente, en
											1974 fue fundada la aerolínea Rutaca, que en sus inicios, abarcó rutas que
											comprendían las zonas mineras y misiones indígenas al sur de Venezuela
											Entre 19701980
											se
											construye un edificio
											administrativo para la sede del Instituto Autónomo Aeropuerto
											Internacional de Maiquetía, y un Terminal Internacional de Llegada, ambos
											provisionales, hasta tanto no se iniciara la construcción definitiva de los
											terminales nacional e internacional, y la sede del IAAIM respectivamente.
											Se inaugura la nueva torre de control del aeropuerto y una segunda pista de
											tres mil metros de longitud.
											Igualmente, entre 19801990
											se inauguran las nuevas instalaciones del Terminal Nacional y el edificio sede del IAAIM.
											Viasa deja de ser privada y pasa a manos del Estado, y continúa el crecimiento de las aerolíneas en el país. Así, en 1.982 inicia
											sus operaciones la Línea Turística Aerotuy (LTA) con el objetivo de ofrecer transporte aéreo en Venezuela y el Caribe y proveer
											servicios turísticos integrados en áreas de belleza natural y extraordinaria, conservando sus condiciones ambientales.
											Por su parte, en 1986 se funda Venezolana de Servicios Expresos de Carga Internacional (VENSECAR), que cuenta con
											una flota variada de aviones cargueros y forma parte de la Red Aérea Internacional DHL Aviation.
											En la década del 90 la Agencia Federal de Aviación de los Estados Unidos (FAA) ubica
											al país en la Categoría 2, a causa de una serie de irregularidades en algunas aerolíneas
											domésticas que volaban a ese país, al igual que una serie de fallas en los reglamentos
											4
											UCABIngeniería
											Informática Sist.
											De Base de Datos I – Prof. Ana K Fernandes
											aplicados y la certificación de las empresas domésticas.
											La aerolínea Aserca Airlines comienza sus actividades en 1992 y tan sólo dos años después, en 1994, se incorporan al
											mercado las empresas Láser y Avior, y a mediados del 1995 abre sus puertas Santa Bárbara Airlines, siendo en principio una
											aerolínea regional y luego nacional e internacional desde 1998.
											En 1999 se celebra una auditoría por parte de técnicos de la Organización de Aviación Civil Internacional (OACI), ente
											rector de la aviación civil a nivel mundial y adscrito a las Naciones Unidas, quienes señalan las fallas todavía presentes en
											materia de seguridad. En el año 2001 se decreta la creación del Instituto Nacional de Aviación Civil, y en el año 2005 la
											Asamblea Nacional promulga una nueva Ley de Aeronáutica Civil, asimismo nace el Instituto Nacional de Aeronáutica Civil
											–INACque
											sustituye al Instituto Nacional de Aviación Civil.
											Desde finales del año 2003 se incorpora al mercado un nuevo explotador, Rutas Aéreas de Venezuela S.A. (RAVSA),
											para brindar servicio de Transporte Aéreo Regular de Pasajeros, consolidando varias rutas a nivel nacional. A mediados de 2006
											cambia su nombre por el de VENEZOLANA, con nuevos accionistas y un renovado equipo directivo.
											En el ínterin, para el año 2004 Venezuela recibe la visita de los técnicos de la OACI para hacer el seguimiento al proceso
											de Auditoría de la Seguridad Operacional realizada por este organismo, determinándose que Venezuela había alcanzado un
											grado de cumplimiento del 89% de las normas y métodos recomendados en materia de seguridad operacional, en un espectacular
											cambio del pasado reciente en esta materia.
											El 23 de febrero del 2006, el INAC anuncia la medida de cancelar y reducir operaciones aéreas de varias aerolíneas
											estadounidenses. Al día siguiente éstas se reunieron con las autoridades del INAC, donde el Gobierno acuerda suspender la
											medida hasta el 30 de marzo. En esa fecha se efectúa una nueva reunión con los operadores aéreos y las autoridades venezolanas
											prorrogan nuevamente la medida hasta el 25 de abril. Cabe destacar que la decisión del INAC contó con el apoyo de las empresas
											aéreas venezolanas, así como con gran parte de la opinión pública.
											El 27 de marzo llegó a Caracas una comisión de expertos de la FAA, los cuales comprueban que Venezuela había
											mantenido e incluso superado el porcentaje de cumplimiento de las normas y métodos recomendados por la OACI encontrados en
											2004, en relación con los estándares de seguridad. El 18 de abril, la Embajada de los Estados Unidos en Venezuela, comunica
											oficialmente al INAC que Venezuela ascendía a Categoría 1, por lo que nuestras aerolíneas podrían volar con sus propios equipos
											y tripulaciones de vuelo a los Estados Unidos.
											Hay que destacar igualmente que las nuevas autoridades del Instituto Autónomo Aeropuerto Internacional de
											Maiquetía, retoman el Plan Maestro bajo el lema MAIQUETIA 2000, y se continúan con los planes de modernización del
											aeropuerto, con algunas variantes relacionadas a la puesta en servicio de las nuevas instalaciones del Terminal de Llegada
											Internacional, separando el flujo de tráfico de entrada y el de salida, la apertura de nuevos concesionarios, un trato más digno a
											pasajeros y visitantes, y mayor número de funcionarios para atender los servicios de Inmigración, Aduana y Seguridad.
											Por otra parte, el Ministerio de Infraestructura (MINFRA) a través del INAC, moderniza los servicios de Tránsito Aéreo,
											reemplazando equipos que datan de 1977. A través del Proyecto de Modernización y Gestión del Tránsito Aéreo (Proyecto
											MAGTA) – bajo los auspicios de la Oficina de Cooperación Técnica de la OACI – se adquieren radares de última tecnología y
											otros equipamientos técnicos tanto para Maiquetía, como para otros aeropuertos. Se mejoran sustancialmente los servicios de
											5
											UCABIngeniería
											Informática Sist.
											De Base de Datos I – Prof. Ana K Fernandes
											Búsqueda y Salvamento, con la adquisición de helicópteros especialmente destinados a esas labores. Se contrata la adquisición
											de vehículos contra incendio para los Bomberos Aeronáuticos, a fin de dotar a otros aeropuertos de estos servicios, entre otros
											proyectos de envergadura para el fortalecimiento de la plataforma aeronáutica del país. En 2004 se crea el Consorcio Venezolano
											de Industrias Aeronáuticas y Servicios Aéreos S.A. (CONVIASA), una aerolínea del Estado que busca penetrar el mercado
											interno y externo, con un norte específico. Además de prestar un servicio óptimo a venezolanos y extranjeros y que con el tiempo
											sientan el mismo orgullo y estima que cuando volaban en Viasa y en Aeropostal.
											En septiembre de 2007, Venezuela ingresa al Consejo de la OACI en calidad de miembro por un lapso de tres años, como
											parte del Grupo 2 del mismo, donde se encuentran los Estados que brindan mayor apoyo a los servicios de navegación aérea del
											mundo, dentro del marco del Convenio de Alternabilidad suscrito en 1992 con la República de Colombia para asegurar un
											representante de manera permanente en ese organismo rector de la aviación civil internacional.
											Autor: Secretaria Regional Comisión Latinoamericana de Aviación Civil – CLAC</p>
									</div>
								</div>
						</div>

						
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
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="vendor/popper.js/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="js/front.js"></script>
	</body>

	</html>