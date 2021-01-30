<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar sesión • Planatime</title>
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="icon" href="../img/favicon.png" type="image/png" sizes="32x32">
        <?php
           include "../pie/head_links.html";
        ?>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light " id="nav1">
        <a class="navbar-brand" href="../index.php"> <img src="../img/logo.png" width="50" height="50" />Planatime</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Iniciar sesión <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="signup.php">Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container formLog">
        <h1>Iniciar sesión en Planatime</h1> <br><br>
        <?php
            if (isset($_GET["error"])){
                if($_GET["error"] == "campovacio"){
                    echo '<p style="color:red;">Revise los campos por favor.</p>';                    
                }else if($_GET["error"] == "errorpswd"){
                    echo '<p style="color:red;">Contraseña incorrecta.</p>';
                }else if($_GET["error"] == "errormail"){
                    echo '<p style="color:red;">E-mail incorrecto.</p>';
                }
            }
            
          ?>
        <form action="../php/controladorLogin.php" method="post">
            <input type="email" class="grande" name="email" placeholder="Introduce el e-mail" require> <br><br>
            <input type="password" class="grande" name="contrasena" placeholder="Introduce la contraseña" require> <br><br>
            <input type="submit" class="grande" name="enviar" value="Enviar">
        </form>
    </div>

    <?php include "../pie/footer.html";?>
    <?php include "../pie/scripts.html" ?>
    <!-- <script src="js/jquery-3.4.1.js"></script> 
      Hacer transición de imágenes FullScreen 
       <script src="js/jquery.backstretch.js"></script>
         <script>
             $.backstretch([
             "../img/img0.jpg",
             "../img/img1.jpg",
             "../img/img2.jpg",
             "../img/img3.jpg"
             ], {
                 fade: 750,
                 duration: 4000
             });
         </script> -->
</html>