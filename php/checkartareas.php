<?php

if(isset($_POST['importante'])){
    require 'datosBD.php';

    $cod= $_POST['importante'];

    if(empty($cod)){
       echo 'error';
    }else{
        $consulta= $conexion->prepare("SELECT cod, importante FROM lista WHERE cod=?");
        $consulta-> execute([$cod]);

        $lista=$consulta-> fetch();
        $ucod=$lista['cod'];
        $importante= $lista['importante'];

        $uimportante = $importante ? 0 : 1;

        $resultado= $conexion-> query("UPDATE lista SET importante=$uimportante WHERE cod=$ucod");

        if($resultado){
            echo $importante;
        }else{
            echo "error";
        }
        $conexion = null;
        exit();
    }
}else {
    header("Location: ../pag/listas.php?error=error");
}


if(isset($_POST['urgente'])){
    require 'datosBD.php';

    $cod= $_POST['urgente'];

    if(empty($cod)){
       echo 'error';
    }else{
        $consulta= $conexion->prepare("SELECT cod, urgente FROM lista WHERE cod=?");
        $consulta-> execute([$cod]);

        $lista=$consulta-> fetch();
        $ucod=$lista['cod'];
        $urgente= $lista['urgente'];

        $uurgente = $urgente ? 0 : 1;

        $resultado= $conexion-> query("UPDATE lista SET urgente=$uurgente WHERE cod=$ucod");

        if($resultado){
            echo $urgente;
        }else{
            echo "error";
        }
        $conexion = null;
        exit();
    }
}else {
    header("Location: ../pag/listas.php?error=error");
}


?>