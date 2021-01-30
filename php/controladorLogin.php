<?php
    $email=$_POST['email'];
    $contrasena=$_POST['contrasena'];
   
	$email2=filter_var($email, FILTER_SANITIZE_EMAIL);
	if (filter_var($email, FILTER_VALIDATE_EMAIL) && ($email===$email2)){
    
        if ($conexion = mysqli_connect('localhost', 'root', '','bdplanatime')){
            mysqli_set_charset($conexion,'utf8');

            $consulta = "SELECT nombre, apellido, email, contrasena, cod from usuario where email='$email'";

            if ($resultado= mysqli_query($conexion, $consulta)){
                $fila = mysqli_fetch_row($resultado);

                if($fila != null){                    
                    if(password_verify($contrasena,$fila[3])){
                        session_start();
                        $_SESSION['nombre']=$fila[0];
                        $_SESSION['apellido']=$fila[1];
                        $_SESSION['email']=$fila[2];
                        $_SESSION['cod']=$fila[4];
                        
                        header("location: ../index.php");
                        
                    }else{
                        header ("Location:../pag/login.php?error=errorpswd");
                    }
                }else{
                    header ("Location:../pag/login.php?error=errormail");
                }
            }

            mysqli_close($conexion);
        }

    }else{
        header ("Location:../pag/login.php?error=campovacio");

    }

?>
