<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Planatime</title>
    <link rel="stylesheet" href="css/estilos.css">
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
    <style>
        *{
            margin:0;
            padding:0;
        }
        
        .overlay{
            color:black;
            position: absolute;
            z-index:20;
            top:45%;
            left:50%;
            width:200%; 
            text-align:center;
            height: 200px;
            width: 400px;
            margin: -100px 0 0 -200px;
            font-family: 'Chonburi', cursive;
            font-size:50px;
            font-weight:700;
            /* background:#e07a5f; */
                

        }
        .subrayado{
            color: white;
            /* background:#e07a5f; */
            background:rgb(128, 167, 116);
        }
        .tx-col{
            font-family: 'Lemon', cursive;
        }
        .a{
            margin:100px auto;
            
        }
        .division{
            background:url(img/img0.jpg) no-repeat center center fixed;
            background-size: cover;
            width:100vw;
            height: 250px;
            position:relative;
            left:calc(-1 * (100vw - 100%)/2);
            color: rgba(0,0,0,1);
            background-color:#ffffff; 
            text-align:center;
            font-family: 'Lemon', cursive;
            font-weight:700;
            
        }
        
    </style>
</head>

<body class="fondo">
    <?php
        session_start();
        if(isset($_SESSION['email'])){
            include "menu/menulog.html";
            $nombre=$_SESSION['nombre'];
    	    $apellido=$_SESSION['apellido'];
    	    echo "<br><h1 align='center'>Ya estás en Planatime, " .$nombre." ". $apellido." !</h1>";
        }else{
            include "menu/menuNOlog.html";
        }
    ?>
    <div>
        <h1 class="overlay">Ordena tu mente.<br><mark class="subrayado">Enfócate</mark>  en tu meta.</h1> 
        <video autoplay muted loop id="myVideo" width="100%">
            <source src="vid/productividad2.mp4" type="video/mp4">
        </video>
    </div>
    <div class="container mt-3">
        <div class="row a">
            <div class="col-md-6" data-aos="zoom-in-right" data-aos-delay="100">
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/sOMLVlqzw_4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-2">&nbsp;</div>
            <dv class="col-md-4" >
                <h3 class="tx-col" data-aos="zoom-in-left" data-aos-delay="200">¿Qué es Planatime?</h3><br>
                <p data-aos="zoom-in-left" data-aos-delay="350">Planatime es tu pequeño espacio de orden y tranquilidad, en él, podrás organizar todo lo que necesitas para realizar todo aquello que desees. Planatime nace de la necesidad de encontrar algo sencillo que se adapte a tus necesidades, sin llevarte mucho tiempo, tan solo tienes que registrarte y empezar a anotar todo lo que tienes en la mente en este momento, ¿estás cansado de la rutina?, ¿qué tienes que recordar?, ¿qué tienes que hacer?, ¿qué es importante?, ¿es urgente?, ¿podrás hacerlo en 25 minutos? ¡Compruébalo en Planatime! </p>
            </dv>
        </div>
        <div class="division"><br>
        <br>
        <br>
            <h2>¿Qué podrás encontrar?</h2>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3 card" style="width: 18rem;" data-aos="fade-up" data-aos-delay="500">
                <img class="card-img-top" src="img/ilustraciones/lista.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Una lista en la que guardar todo aquello que se te ocurra, y tenerlo siempre al alcance. Guarda todas tus notas en un solo lugar.</p>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-3 card" style="width: 18rem;" data-aos="fade-up" data-aos-delay="600">
                <img class="card-img-top" src="img/ilustraciones/reto.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Un calendario en el que encontrarás retos mensuales para evitar estancarte en la rutina y salir de tu zona de confort. También podrás crear aquellos retos que desees cumplir.</p>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-3 card" style="width: 18rem;" data-aos="fade-up" data-aos-delay="700">
                <img class="card-img-top" src="img/ilustraciones/a.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Aprende a evaluar tus prioridades, decide, delega y comienza a descartar aquellas que no te valen. Pasa a la acción!</p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-aos="fade-up" data-aos-delay="900">
                <!-- Indicators-->
                <ul class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ul> 
                        
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-caption d-none d-md-block align-items-center justify-content-center">
                        
                    </div>
                        
                    <div class="carousel-item active">
                        <img src="img/img3.jpg" alt="imagen" width="1100" height="500">
                        <div class="carousel-caption d-none d-md-block align-items-center justify-content-center">
                            <h3>"Muchas veces carecemos de herramientas para aumentar la productividad personal, dejar de perder el tiempo y simplemente enfocarnos en nuestras tareas de manera eficiente, eficaz y efectiva."</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/img1.jpg" alt="imagen" width="1100" height="500">
                    </div>
                    <div class="carousel-item">                        
                        <video autoplay muted loop id="myVideo" width="95%">
                            <source src="vid/salon2.mp4" type="video/mp4">
                        </video>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
    include "pie/footer.html";
    include "pie/scripts.html";
?>
<script src="js/aos.js"></script>
<script>
    AOS.init();
</script>

</html>