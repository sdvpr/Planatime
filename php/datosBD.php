<?php
	$servidor = 'localhost';
	$usuario = 'root';
	$clave = '';
	$db = 'bdplanatime';



	try{
		$conexion=new PDO("mysql:host=$servidor;dbname=$db",$usuario,$clave);
		
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $e){
		echo"Conexion fallida: ". $e->getMessage();
		
	}
		



?>