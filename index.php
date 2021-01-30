<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Planatime</title>
    <link rel='stylesheet' href='css/estilos.css'>
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b592f0938f.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
    <!-- AOS -->
    <link rel="stylesheet" href="css/aos.css">
    <?php 
    if(isset($_GET['tema'])){
        if($_GET['tema']=="DRK"){
            setcookie("modo","oscuro",time()+3600*24*7);
        }
        if($_GET['tema']=="CLR"){
            setcookie("modo","claro",time()+3600*24*7);
        }
    }

    if(isset($_COOKIE['modo'])){
        if($_COOKIE['modo']=="oscuro"){
            echo"<link rel='stylesheet' href='css/modoOscuro.css'>";

        }elseif($_COOKIE['modo']=="claro"){
            echo"<link rel='stylesheet' href='css/estilos.css'>";
        }
    }
    
    ?>    
<style>
    .btn{
        background-color:#92b894;
        outline:none;
        border: none;
            border-radius:2rem;
            padding:10px 30px;
            font-size:1rem;
            font-family: ;
            cursor: pointer;
           
    }
    .btn:hover{
        background-color:#83A283;
    }
    /* .jumbotron{
        height:100px;
    }
    .tema{
        margin-top:0px;
    } */
</style>
</head>

<body class="fondo">
    <?php
        session_start();
        if(isset($_SESSION['email'])){
            include "menu/menulog.html";
            $nombre=$_SESSION['nombre'];
    	    $apellido=$_SESSION['apellido'];
    	    
        }else{
            header("Location:index2.php");
        }
    ?>
    <div id="container" class="sombra mt-3">
        <div class="jumbotron">
            <div class="row justify-content-end">
                <div>                   
                    <p>Tema: <br></p> 
                    <div class="row">
                    <div class="col-md-1"><a href="index.php?tema=DRK"><i class="far fa-moon fa-2x" style="color:black;"></i></a>
                    </div>&nbsp;
                    <div class="col-md-1">
                        <a href="index.php?tema=CLR"><i class="far fa-sun fa-2x" style="color:black;"></i></a><br>
                    </div>
                    </div>
                    <button class="btn-g"><a href="javascript:location.reload()">Aplicar</a></button>
                </div>
            </div>
           <?php echo" <br><h1 class='display-4' align='center' > Ya estás en Planatime $nombre $apellido !</h1><br>";  ?>
           <blockquote align="center">
               <p  class="lead" style="padding: padding 5px; padding-top: 5px;"> <i class="fas fa-quote-left fa-1x"></i>Todo lo que tenemos que decidir es qué hacer con el tiempo que se nos ha concedido.<br>-Gandalf.</p>
           </blockquote>      
            <a class="btn btn-primary btn-lg" href="pag/planadoro.php" role="button" >Quiero hacer mi tarea!</a>
            </p>
            <p class="lead"></p>
            <?php
                echo "Hoy es ".date('d-m-Y')." <br>";
            ?> 
            
        </div>      

        <div class="row">
        <div class="card-deck">
            <div class="card">
            <img class="card-img-top mo" src="img/ilustraciones/lista.png" alt="imagen">
                <div class="card-body mo">
                <h5 class="card-title">Mi Lista </h5>
                <p class="card-text">Todo lo que necesitas recordar en un solo lugar!</p>
                <a href="pag/listas.php" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card">
            <img class="card-img-top mo" src="img/ilustraciones/reto.png" alt="imagen">
                <div class="card-body mo">
                <h5 class="card-title">Mis Retos</h5>
                <p class="card-text">Todo lo que puedes llegar a hacer en un solo vistazo, los límites los pones tú!</p>
                <a href="pag/retos.php" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card">
            <img class="card-img-top mo" src="img/ilustraciones/tareas.png" alt="imagen">
                <div class="card-body mo">
                <h5 class="card-title">Mis Tareas</h5>
                <p class="card-text">¿Qué es importante para ti? ¿Corre prisa? Tienes que verlo!</p>
                <a href="pag/tareas.php" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php 
    include "pie/footer.html";
    include "pie/scripts.html";
?>
</html>