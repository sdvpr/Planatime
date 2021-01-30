<?php
    session_start();
    if(isset($_SESSION['email'])){
        $nombre=$_SESSION['nombre'];
        $apellido=$_SESSION['apellido'];
        $usuario_cod=$_SESSION['cod'];
    }else{
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planadoro • Planatime</title>
    <link rel="icon" href="../img/favicon.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="../css/estilos.css"> 
    <?php
        if(isset($_COOKIE['modo'])){
            if($_COOKIE['modo']=="oscuro"){
                echo"<link rel='stylesheet' href='../css/modoOscuro.css'>";
            }elseif($_COOKIE['modo']=="claro"){
                echo"<link rel='stylesheet' href='../css/estilos.css'>";
            }
        }

        include "../pie/head_links.html"; 
    ?>
    
    <script src="../js/reloj.js"></script>

    <style>
        
        .reloj{
            color:green;
            text-align:center;
            width:20rem;
            height:20rem;
            border: 5px solid black;
            border-radius:10rem;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .container{
            border-color:1px solid black;
        }
        .fa-play, .fa-pause,.fa-redo-alt{
            color:green;
            border:2px solid black;
            padding:1rem;
            border-radius:2rem;
        }
        .fa-play:hover,.fa-pause:hover, .fa-redo-alt:hover{
            background-color:lightgreen;
            transition:0.3s ease;
            border:2px solid black;
            padding:1rem;
            border-radius:2rem;
        }
        .row{
            width:100%;
        }
        a{
            color:green;

        }
        a:hover{
            text-decoration:none;
            color:green;
        }

    </style>
</head>

<body  class=" mo" >
    <nav class="navbar navbar-expand-lg navbar-light " id="nav1">
        <a class="navbar-brand" href="../index.php"> <img src="../img/logo.png" width="50" height="50" />Planatime</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">                
                    <a class="nav-link " href="../index.php">Inicio </a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link" href="listas.php">Listas </a>
                </li>                
                <li class="nav-item ">
                    <a class="nav-link" href="tareas.php">Tareas</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="retos.php">Retos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="planadoro.php">Planadoro<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../php/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php echo "<br><h1  class='display-4 ' align='center'>Da lo mejor de ti, ".$nombre."!</h1>"; ?> 

    <div class="container reloj">
        <div class="row ">
           
            <div class="col-md-6">
            <small>Tu tarea 💪</small>
                <h4>25:00</h4>
            </div>
            <div class="col-md-6">
                <small>Tu descanso 😌</small>
                <h4 id="desc">5:00</h4>
                
            </div>

        </div>
    </div>
    <div class="botones"></div>

        <div class="container d-flex justify-content-center align-items-center my-5">
            <button id="empezar" onclick="check(activo)" class="btn"><i class="fas fa-play fa-2x"></i></button>
            <a href="planadoro.php"><i class="fas fa-redo-alt fa-2x"></i></a>
        </div>

    </div>

    <div class=" container col-md-5">
        <div class="row">        
            <br><br>
            <h4>Aplica la técnica</h4><br>
            <ol>
                <li>Prepara todo lo que necesites para realizar una de tus tareas. </li><br>
                <li>Dale al play! </li><br>
                <li>Trabaja en la tarea hasta que pasen los 25 minutos. </li><br>
                <li>Toma un pequeño descanso de cinco minutos (esto indicará la conclusión de un Planadoro, Yuhuu!). </li><br>
                <li>Repite los pasos del 1 al 4. </li><br>                
            </ol>
        <p> &nbsp; Ya sabemos que adoras nuestro Plan, pero... ¿sabes en qué consiste la técnica del Pomodoro? <a href="https://www.casadellibro.com/libro-la-tecnica-pomodoro/9788449336492/10939289" target="_blank">Descubre más sobre la técnica del pomodoro</a>🧐</p>
        </div>
    </div>
    <?php include "../pie/footer.html";
      include "../pie/scripts.html";
    ?>
    
</body>
</html>