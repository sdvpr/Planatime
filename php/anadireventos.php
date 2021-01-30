<?php 
require 'datosBD.php';
session_start();
$usuario_cod=$_SESSION['cod'];


if(isset($_GET['accion'])){
    $accion=$_GET['accion'];
}else{
    $accion='leer';
}

switch($accion){
    case 'agregar':       
        $consulta= $conexion->prepare("INSERT INTO reto(title,descripcion, color, textColor, start, end, usuario_cod) VALUES (:title,:descripcion,:color,:textColor,:start,:end,'".$usuario_cod."')");
        $resultado=$consulta->execute(array(
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']
         ));

        echo "Agregado";//tiene que devolver algo para que pueda seguir con la ejecución del ajax y se pueda cerrar el modal y refrescar (refetchEvent)
    break;

    case 'eliminar':
        $resultado=false;
        if(isset($_POST['id'])){//elemto
           if($usuario_cod!=100){//si no es el admin
                $consulta= $conexion->prepare("DELETE FROM reto WHERE id=:id AND usuario_cod != 100");
                $resultado= $consulta-> execute(array("id"=>$_POST['id']));
           }else{
               $consulta= $conexion->prepare("DELETE FROM reto WHERE id=:id ");
               $resultado= $consulta-> execute(array("id"=>$_POST['id']));
           }
        }
        echo "Borrado";
    break;
        
    case 'editar':
        if(isset($_POST['id'])){
            if($usuario_cod!=100){
                $consulta= $conexion->prepare("UPDATE reto SET title=:title, descripcion=:descripcion, color=:color, textColor=:textColor, start=:start, end=:end WHERE id=:id AND usuario_cod != 100");

            $resultado=$consulta->execute(array(
                "id"=>$_POST['id'],
                "title"=>$_POST['title'],
                "descripcion"=>$_POST['descripcion'],
                "color"=>$_POST['color'],
                "textColor"=>$_POST['textColor'],
                "start"=>$_POST['start'],
                "end"=>$_POST['end']
            ));
           }else{
            $consulta= $conexion->prepare("UPDATE reto SET title=:title, descripcion=:descripcion, color=:color, textColor=:textColor, start=:start, end=:end WHERE id=:id");

            $resultado=$consulta->execute(array(
                "id"=>$_POST['id'],
                "title"=>$_POST['title'],
                "descripcion"=>$_POST['descripcion'],
                "color"=>$_POST['color'],
                "textColor"=>$_POST['textColor'],
                "start"=>$_POST['start'],
                "end"=>$_POST['end']
            ));
           }
        }
      
        echo "Editado";

    break;

    default: 
        $consulta=$conexion->prepare("SELECT * FROM reto WHERE usuario_cod=".$usuario_cod." OR usuario_cod= 100 ");//100 es el admin
        $consulta->execute();

        $resultado=$consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    break;


} 


?>