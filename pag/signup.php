<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarte • Planatime</title>
    <script src="../js/validarsignup.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="icon" href="../img/favicon.png" type="image/png" sizes="32x32">
    <?php include "../pie/head_links.html"; ?>
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
        <li class="nav-item">
          <a class="nav-link" href="login.php">Iniciar sesión</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="signup.php">Registrarse<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container formLog">
    <h1>Regístrate en Planatime</h1><br><br>
      <?php
        if (isset($_GET["signup"])){
          if($_GET["signup"] == "success"){
            echo '<p style="color:green;"> Registrado correctamente! Ahora puedes iniciar sesión</p>';
          }else if($_GET["error"] == "campovacio"){
            echo '<p style="color:red;"> Revisa los campos, por favor.</p>';
          }
        }
      ?>
    <form action="../php/controladorSignup.php" method="post" onsubmit="return validar();">
      <input type="text" class="grande" name="nombre" id="nombre" placeholder="Introduce tu nombre" require> <br><br>
      <input type="text" class="grande" name="apellido" id="apellido" placeholder="Introduce tu apellido" require><br><br>
      <input type="email" class="grande" name="email" id="email" placeholder="Introduce tu e-mail" require> <br><br>
      <input type="password" class="grande" name="contrasena" id="contrasena" placeholder="Introduce contraseña" require> <br><br>
      <input type="submit" class="grande" name="enviar" id="enviar" value="Enviar">
    </form>
  </div>

<?php 
  include "../pie/footer.html";
  include "../pie/scripts.html";
?>
</html>