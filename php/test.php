<?php
include 'querys.php';
	
	echo insertarContacto('webo',1,'NULL',1,'NULL')." Linea 0</br>";
	echo insertarContacto('webo',1,'NULL',2,4)." Linea 1</br>";
	echo insertarContacto('webo',1,1,'NULL','NULL')."Linea 2</br>";
	echo insertarContacto('webo',1,'NULL','NULL','NULL')."Linea 3</br>";
?>