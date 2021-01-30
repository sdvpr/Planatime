<?php

if(isset($_POST['id'])){
    require 'datosBD.php';

    $id= $_POST['id'];

    if(empty($id)){
       echo 0;
    }else{
        $consulta= $conexion->prepare("DELETE FROM lista WHERE cod=?");
        $resultado= $consulta-> execute([$id]);
        if($resultado){
            echo 1;
        }else{
            echo 0;
        }
        $conexion = null;
        exit();
    }
}else {
    header("Location: ../pag/listas.php?error=error");
}

?>