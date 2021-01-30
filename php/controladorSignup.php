<?php 
//YA TENGO LA VALIDACION CON JS, PERO PARA DOBLE VALIDACIÓN (front+back):
 //comprobamos que los campos no estén vacíos
    if($_POST["nombre"]){
        if($_POST["apellido"]){
            if($_POST["email"]){
                 if($_POST["contrasena"]){ 

                    $nombre= $_POST["nombre"];
                    $apellido= $_POST["apellido"]; 
                    $email= $_POST["email"];
                        $email2=filter_var($email, FILTER_SANITIZE_EMAIL);
                            if (filter_var($email, FILTER_VALIDATE_EMAIL) && ($email===$email2)){
                                                           
                                $contrasena= password_hash($_POST['contrasena'],PASSWORD_DEFAULT);
                                
                                if ($conexion = mysqli_connect('localhost', 'root', '','bdplanatime')){
                                    mysqli_set_charset($conexion,'utf8');

                                    $consulta="insert into usuario ( nombre, apellido, email, contrasena) values( '$nombre','$apellido','$email','$contrasena')";

                                        $consulta2=mysqli_query($conexion, "select nombre, apellido, email, contrasena from usuario where email='$email'");
                                        
                                        if(mysqli_num_rows($consulta2)>0){
                                            echo '<script> 
                                                    alert("Este email ya está registrado"); 
                                                    window.history.go(-1);
                                                </script>';
                                            exit;
                                        }

                                    $resultado=mysqli_query($conexion,$consulta);
                                    if ($resultado){
                                        header("Location:../pag/signup.php?signup=success");
                                        
                                    }else{
                                        echo"Error de registro";
                                    } 
                                    mysqli_close($conexion);
                                }
                            }else{
                                echo("$email NO es una dirección de email válida");
                            }    
                }else{ header("Location:../pag/signup.php?error=campovacio");}
            }else{ header("Location:../pag/signup.php?error=campovacio");}
        }else{ header("Location:../pag/signup.php?error=campovacio");}
    }else{ header("Location:../pag/signup.php?error=campovacio");}

    
?>
