<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(isset($_POST['sepervisa'])) $supervisa = 'true';
		else $supervisa = 'false';
		
		if(isset($_POST['gerencia'])) $gerencia = 'true';
		else $gerencia = 'false';
		
		if( !isset($_POST['nota']) || strlen($_POST['nota']) <= 0 ) $nota = 'NULL';
		else $nota = $_POST['nota'];
		
		if( insertarEmpleado( $_POST['nacionalidad'], $_POST['ci'], $_POST['nombre'], $_POST['apellido'], $_POST['usuario'], $_POST['clave'], $_POST['titulacion'], $_POST['cargo'], $_POST['rol'], $_POST['zona'], $_POST['parroquia'], $supervisa, $gerencia, $nota) ){
			$qry = "SELECT em_id id FROM Empleado WHERE em_nacionalidad='".$_POST['nacionalidad']."' and em_ci=".$_POST['ci'];
			$answer = pg_query( $conexion, $qry );
			$empleado = pg_fetch_object($answer);
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
					
					if(strlen($_POST['contacto'][$i]) <= 0){header('Location: empleados.php?error=2');exit;}
					
					if(insertarContacto( $_POST['contacto'][$i], $_POST['tipo_contacto'][$i], 'NULL', $empleado->id, 'NULL' ))
						$i++;
					else{
						header('Location: empleados.php?error=2');
						exit;
					}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['nombre_beneficiario'][$i]) && isset($_POST['apellido_beneficiario'][$i]) && isset($_POST['nacionalidad_beneficiario'][$i]) && isset($_POST['ci_beneficiario'][$i])){
					
					if(strlen($_POST['nombre_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=3');exit;}
					if(strlen($_POST['apellido_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=3');exit;}
					
					if(insertarBeneficiario( $_POST['nacionalidad_beneficiario'][$i], $_POST['ci_beneficiario'][$i], $_POST['nombre_beneficiario'][$i], $_POST['apellido_beneficiario'][$i], $empleado->id))
						$i++;
					else{header('Location: empleados.php?error=3');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['experiencia_desc'][$i]) && isset($_POST['experiencia_year'][$i])){
					
					if(strlen($_POST['experiencia_desc'][$i]) <= 0){header('Location: empleados.php?error=4');exit;}
					
					if(insertarExperiencia( $_POST['experiencia_desc'][$i], $_POST['experiencia_year'], $empleado->id ))
						$i++;
					else{header('Location: empleados.php?error=4');exit;}
				}
				else $exit = true;
			}
			header('Location: empleados.php');
		}
		else
			header('Location: empleados.php?error=1');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarEmpleado($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
?>