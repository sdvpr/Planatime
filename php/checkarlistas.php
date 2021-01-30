<?php

if(isset($_POST['id'])){
    require 'datosBD.php';

    $cod= $_POST['id'];

    if(empty($cod)){
       echo 'error';
    }else{
        $consulta= $conexion->prepare("SELECT cod, checked FROM lista WHERE cod=?");
        $consulta-> execute([$cod]);

        $lista=$consulta-> fetch();
        $ucod=$lista['cod'];
        $checked= $lista['checked'];

        $uchecked = $checked ? 0 : 1;

        $resultado= $conexion-> query("UPDATE lista SET checked=$uchecked WHERE cod=$ucod");

        if($resultado){
            echo $checked;
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