<?php

function conectarBD ($bd){
	require 'datosBD.php';

	$conexion = mysqli_connect($servidor, $usuario, $clave, $bd) or die('No se pudo conectar: ' . mysql_error());
    mysqli_set_charset($conexion,'utf8');
    
	return $conexion;
}



?> 