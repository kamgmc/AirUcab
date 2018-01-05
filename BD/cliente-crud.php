<?php include 'querys.php';
	if(isset($_GET['create'])){
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
				if(strlen($_POST['contacto'][$i]) <= 0){header('Location: clientes.php?error=2');exit;}
				$i++;
			}
			else $exit = true;
		}
		if(insertarCliente ( $_POST['tipo_rif'], $_POST['rif'], $_POST['nombre'], $_POST['web'], $_POST['parroquia'] )){
			$qry = "SELECT cl_id AS id FROM Cliente where cl_tipo_rif='".$_POST['tipo_rif']."' AND cl_rif=".$_POST['rif'];
			$answer = pg_query( $conexion, $qry );
			$cliente = pg_fetch_object($answer);
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
					if(insertarContacto( $_POST['contacto'][$i], $_POST['tipo_contacto'][$i], $cliente->id, 'NULL', 'NULL' ))
						$i++;
					else{header('Location: clientes.php?error=2');exit;}
				}
				else $exit = true;
			}
		}
		else
			header('Location: clientes.php?error=1');
		header('Location: clientes.php');
		exit;
	}
	if(isset($_GET['edit'])){
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
				if(strlen($_POST['contacto'][$i]) <= 0){header('Location: clientes.php?error=4');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if(isset($_POST['contacto_update'][$i]) && isset($_POST['tipo_contacto_update'][$i]) && isset($_POST['contacto_update_id'][$i])){
				if(strlen($_POST['contacto_update'][$i]) <= 0){header('Location: clientes.php?error=4');exit;}
				$i++;
			}
			else $exit = true;
		}
		$id = $_GET['edit'];
		if(editarCliente ( $id, $_POST['tipo_rif'], $_POST['rif'], $_POST['nombre'], $_POST['web'], $_POST['parroquia'] )){
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto'][$i]) && isset($_POST['tipo_contacto'][$i])){
					if(insertarContacto( $_POST['contacto'][$i], $_POST['tipo_contacto'][$i], $id, 'NULL', 'NULL' ))
						$i++;
					else{header('Location: clientes.php?error=4');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto_update'][$i]) && isset($_POST['tipo_contacto_update'][$i]) && isset($_POST['contacto_update_id'][$i])){
					if(editarContacto( $_POST['contacto_update_id'][$i], $_POST['contacto_update'][$i], $_POST['tipo_contacto_update'][$i] ))
						$i++;
					else{header('Location: clientes.php?error=4');exit;}
				}
				else $exit = true;
			}
			$exit = false; $i = 0;
			while(!$exit){
				if(isset($_POST['contacto_delete'][$i])){
					if(eliminarContacto( $_POST['contacto_delete'][$i] ))
						$i++;
					else{header('Location: clientes.php?error=4');exit;}
				}
				else $exit = true;
			}
		}
		else header('Location: clientes.php?error=3');
		header('Location: clientes.php'); exit;
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarCliente($id))
			header('Location: clientes.php');
		else
			header('Location: clientes.php?error=5');
		exit;
	}
?>