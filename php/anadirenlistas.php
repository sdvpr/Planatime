<?php
session_start();
$usuario_cod=$_SESSION['cod'];


if(isset($_POST['titulo'])){
    require 'datosBD.php';
    $titulo= $_POST['titulo'];
    $titulo2=filter_var($titulo,FILTER_SANITIZE_STRING);
    
    if(empty($titulo2)){
        header("Location: ../pag/listas.php?error=campovacio");
    }else{
        $consulta= $conexion->prepare("INSERT INTO lista(titulo,usuario_cod) VALUE (?,'".$usuario_cod."')");
        $resultado= $consulta-> execute([$titulo2]);
        if($resultado){
            header("Location: ../pag/listas.php?error=success");
        }else{
            header("Location: ../pag/listas.php");
        }
        $conexion = null;
        exit();
    }
    
 }else {
    header("Location: ../pag/listas.php?error=error");
}

?>