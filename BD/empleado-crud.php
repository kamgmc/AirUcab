<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(isset($_POST['sepervisa'])) $supervisa = 'true';
		else $supervisa = 'false';
		
		if(isset($_POST['gerencia'])) $gerencia = 'true';
		else $gerencia = 'false';
		
		if( !isset($_POST['nota']) || strlen($_POST['nota']) <= 0 ) $nota = 'NULL';
		else $nota = $_POST['nota'];
		
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
				if(strlen($_POST['contacto'][$i]) <= 0){header('Location: empleados.php?error=2');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['nombre_beneficiario'][$i]) && isset($_POST['apellido_beneficiario'][$i]) && isset($_POST['nacionalidad_beneficiario'][$i]) && isset($_POST['ci_beneficiario'][$i])){
				if(strlen($_POST['nombre_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=3');exit;}
				if(strlen($_POST['apellido_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=3');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['experiencia_desc'][$i]) && isset($_POST['experiencia_year'][$i])){
				if(strlen($_POST['experiencia_desc'][$i]) <= 0){header('Location: empleados.php?error=4');exit;}
				$i++;
			}
			else $exit = true;
		}
		if( insertarEmpleado( $_POST['nacionalidad'], $_POST['ci'], $_POST['nombre'], $_POST['apellido'], $_POST['usuario'], $_POST['clave'], $_POST['titulacion'], $_POST['cargo'], $_POST['rol'], $_POST['zona'], $_POST['parroquia'], $supervisa, $gerencia, $nota) ){
			$qry = "SELECT em_id id FROM Empleado WHERE em_nacionalidad='".$_POST['nacionalidad']."' and em_ci=".$_POST['ci'];
			$answer = pg_query( $conexion, $qry );
			$empleado = pg_fetch_object($answer);
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
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
					if(insertarBeneficiario( $_POST['nacionalidad_beneficiario'][$i], $_POST['ci_beneficiario'][$i], $_POST['nombre_beneficiario'][$i], $_POST['apellido_beneficiario'][$i], $empleado->id))
						$i++;
					else{header('Location: empleados.php?error=3');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['experiencia_desc'][$i]) && isset($_POST['experiencia_year'][$i])){
					if(insertarExperiencia( $_POST['experiencia_desc'][$i], $_POST['experiencia_year'][$i], $empleado->id ))
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
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(isset($_POST['sepervisa'])) $supervisa = 'true';
		else $supervisa = 'false';
		
		if(isset($_POST['gerencia'])) $gerencia = 'true';
		else $gerencia = 'false';
		
		if( !isset($_POST['nota']) || strlen($_POST['nota']) <= 0 ) $nota = 'NULL';
		else $nota = $_POST['nota'];
		
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
				if(strlen($_POST['contacto'][$i]) <= 0){header('Location: empleados.php?error=6');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto_update'][$i]) && isset($_POST['tipo_contacto_update'][$i]) && isset($_POST['contacto_update_id'][$i])){
				if(strlen($_POST['contacto_update'][$i]) <= 0){header('Location: empleados.php?error=6');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['nombre_beneficiario'][$i]) && isset($_POST['apellido_beneficiario'][$i]) && isset($_POST['nacionalidad_beneficiario'][$i]) && isset($_POST['ci_beneficiario'][$i])){
				if(strlen($_POST['nombre_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=7');exit;}
				if(strlen($_POST['apellido_beneficiario'][$i]) <= 0){header('Location: empleados.php?error=7');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['nombre_beneficiario_update'][$i]) && isset($_POST['apellido_beneficiario_update'][$i]) && isset($_POST['nacionalidad_beneficiario_update'][$i]) && isset($_POST['ci_beneficiario_update'][$i]) && isset($_POST['id_beneficiario_update'][$i])){
				if(strlen($_POST['nombre_beneficiario_update'][$i]) <= 0){header('Location: empleados.php?error=7');exit;}
				if(strlen($_POST['apellido_beneficiario_update'][$i]) <= 0){header('Location: empleados.php?error=7');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['experiencia_desc'][$i]) && isset($_POST['experiencia_year'][$i])){
				if(strlen($_POST['experiencia_desc'][$i]) <= 0){header('Location: empleados.php?error=8');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['experiencia_desc_update'][$i]) && isset($_POST['experiencia_year_update'][$i]) && isset($_POST['experiencia_id_update'][$i])){
				if(strlen($_POST['experiencia_desc_update'][$i]) <= 0){header('Location: empleados.php?error=8');exit;}
				$i++;
			}
			else $exit = true;
		}
		if( editarEmpleado( $id, $_POST['nacionalidad'], $_POST['ci'], $_POST['nombre'], $_POST['apellido'], $_POST['usuario'], $_POST['titulacion'], $_POST['cargo'], $_POST['rol'], $_POST['zona'], $_POST['parroquia'], $supervisa, $gerencia, $nota) ){
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
					if(insertarContacto( $_POST['contacto'][$i], $_POST['tipo_contacto'][$i], 'NULL', $id, 'NULL' ))
						$i++;
					else{header('Location: empleados.php?error=6');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto_update'][$i]) && isset($_POST['tipo_contacto_update'][$i]) && isset($_POST['contacto_update_id'][$i])){
					if(editarContacto( $_POST['contacto_update_id'][$i], $_POST['contacto_update'][$i], $_POST['tipo_contacto_update'][$i] ))
						$i++;
					else{header('Location: empleados.php?error=6');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto_delete'][$i])){
					if(eliminarContacto( $_POST['contacto_delete'][$i] ))
						$i++;
					else{header('Location: empleados.php?error=6');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['nombre_beneficiario'][$i]) && isset($_POST['apellido_beneficiario'][$i]) && isset($_POST['nacionalidad_beneficiario'][$i]) && isset($_POST['ci_beneficiario'][$i])){
					if(insertarBeneficiario( $_POST['nacionalidad_beneficiario'][$i], $_POST['ci_beneficiario'][$i], $_POST['nombre_beneficiario'][$i], $_POST['apellido_beneficiario'][$i], $id))
						$i++;
					else{header('Location: empleados.php?error=7');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['nombre_beneficiario_update'][$i]) && isset($_POST['apellido_beneficiario_update'][$i]) && isset($_POST['nacionalidad_beneficiario_update'][$i]) && isset($_POST['ci_beneficiario_update'][$i]) && isset($_POST['id_beneficiario_update'][$i])){
					if(editarBeneficiario( $_POST['id_beneficiario_update'][$i], $_POST['nacionalidad_beneficiario_update'][$i], $_POST['ci_beneficiario_update'][$i], $_POST['nombre_beneficiario_update'][$i], $_POST['apellido_beneficiario_update'][$i]))
						$i++;
					else{header('Location: empleados.php?error=7');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['beneficiario_delete'][$i])){
					if(eliminarBeneficiario( $_POST['beneficiario_delete'][$i] ))
						$i++;
					else{header('Location: empleados.php?error=7');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['experiencia_desc'][$i]) && isset($_POST['experiencia_year'][$i])){
					if(insertarExperiencia( $_POST['experiencia_desc'][$i], $_POST['experiencia_year'][$i], $id ))
						$i++;
					else{header('Location: empleados.php?error=8');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['experiencia_desc_update'][$i]) && isset($_POST['experiencia_year_update'][$i]) && isset($_POST['experiencia_id_update'][$i])){
					if(editarExperiencia( $_POST['experiencia_id_update'][$i], $_POST['experiencia_desc_update'][$i], $_POST['experiencia_year_update'][$i] ))
						$i++;
					else{header('Location: empleados.php?error=8');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['experiencia_delete'][$i]) ){
					if(eliminarExperiencia( $_POST['experiencia_delete'][$i] ))
						$i++;
					else{header('Location: empleados.php?error=8');exit;}
				}
				else $exit = true;
			}
			header('Location: empleados.php');
		}
		else
			header('Location: empleados.php?error=5');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarEmpleado($id))
			header('Location: empleados.php');
		else
			header('Location: empleados.php?error=9');
	}
	exit;
?>