<?php include 'querys.php';

	$qryRol = "SELECT sr_id AS id, sr_nombre AS nombre FROM Rol_sistema";
	$rsRol = pg_query( $conexion, $qryRol );
	$permiso = array();

	while( $rol = pg_fetch_object($rsRol) ){
		$permiso[$rol->id] = array();
		
		$qryRolPermiso = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$rol->id;
		
		$rsRolPermiso = pg_query( $conexion, $qryRolPermiso ); 
		
		while( $rolp = pg_fetch_object($rsRolPermiso) ){ 
			$permiso[$rol->id][] = $rolp->permiso; 
		}
	}

	$qryPermiso = "SELECT pe_id AS id, pe_nombre AS nombre, pe_iniciales AS iniciales FROM Permiso";
	$rsPermiso = pg_query( $conexion, $qryPermiso );

	while( $permisoCheck = pg_fetch_object($rsPermiso) ){
		
		$rsRol = pg_query( $conexion, $qryRol );
		while( $rolCheck = pg_fetch_object($rsRol) ){
			if( $rolCheck->id != 1 && $rolCheck->id != 2 ){
				if( isset( $_POST[$permisoCheck->iniciales."_".$rolCheck->id] ) && !in_array($permisoCheck->iniciales, $permiso[$rolCheck->id]) ){
					if(insertarRolPermiso( $rolCheck->id , $permisoCheck->id ))
						header('Location: empleados.php?tab=permiso');
					else
						header('Location: empleados.php?tab=permiso&error=19');
				}

				if( !isset( $_POST[$permisoCheck->iniciales."_".$rolCheck->id] ) && in_array($permisoCheck->iniciales, $permiso[$rolCheck->id]) ){
					if(eliminarRolPermiso( $rolCheck->id, $permisoCheck->id ))
						header('Location: empleados.php?tab=permiso');
					else
						header('Location: empleados.php?tab=permiso&error=20');
				}
			}
		}
	}
	exit;
?>