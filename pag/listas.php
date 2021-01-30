<?php
    require "../php/datosBD.php";
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
    <title>Listas • Planatime</title>
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
</head>
<body class="mo">
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
                <li class="nav-item  active">
                    <a class="nav-link" href="listas.php">Listas <span class="sr-only">(current)</span></a>
                </li>                
                <li class="nav-item ">
                    <a class="nav-link" href="tareas.php">Tareas</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="retos.php">Retos</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="planadoro.php">Planadoro</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../php/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php echo "<br><h1  class='display-4 ' align='center'>Esta es tu lista ".$nombre."!</h1>"; ?> 
        <div class="row">
            <div class="col-md-6">
                        
                <div class="seccion">
                    <form action="../php/anadirenlistas.php" method="POST" autocomplete="off">
                        <?php
                        if(isset($_GET['error']) && $_GET['error'] == 'campovacio'){ ?>
                            <input type="text" class="grande" name="titulo" placeholder="Campo requerido" style="border-color: #ff6666">
                            <button type="submit" class="btn-g fas"><i class="fas fa-plus"></i></button>
                        <?php }else{ ?>
                            <input type="text" class="grande" name="titulo" placeholder=" ¿Qué hay de nuevo, viejo? ">
                            <button type="submit" class="btn-g fas"><i class="fas fa-plus"></i></button>
                        <?php }?>
                    </form>
                </div>
                <br><br>
                <?php 
                    $elementos = $conexion->query("SELECT cod,titulo,date_time,checked,usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."' ORDER BY cod DESC");
                ?>
                
                <div class="mostrar-elementos">
                    <?php 
                        if($elementos->rowCount() <= 0){
                    ?>
                        <div class="item">
                            <div class="vacio">
                                <br>
                                <img src="../img/nohaynada.gif" alt="gif" width="50%">
                                <p>El profesor Dumbledore está esperando a que pongas algo, y nadie quiere ver a Dumbledore enfadado... Verdad? 🤨</p>
                            </div>
                        </div>
                    <?php }  ?>
                   
                    <?php while($elemento = $elementos -> fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="item " data-aos="fade-up" data-aos-delay="200">
                            
                            <span id="<?php echo $elemento['cod']?>" class="borrar-item" ><i class="fas fa-trash-alt "></i></span>

                            &nbsp; &nbsp; ¿Es una tarea?
                            <?php if($elemento['checked']){ ?>

                                <input type="checkbox" data-elemento-id="<?php echo $elemento['cod']?>" class="check-box" checked> 
                                
                                <h2 class="checked"><?php echo $elemento['titulo'] ?> </h2>
                                            
                            <?php }else{ ?>
                                <input type="checkbox" data-elemento-id="<?php echo $elemento['cod']?>" class="check-box "> 
                                <h2><?php echo $elemento['titulo'] ?> </h2>
                                
                            <?php } ?>
                            
                            <small>creado: <?php echo $elemento['date_time'] ?> </small>
                            <hr class="my-4">
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-3">
                <img src="../img/ilustraciones/lista.png" alt="imagen" width="700">
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        
    </div>
<?php include "../pie/footer.html";?>

<?php include "../pie/scripts.html" ?>

  <script src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.borrar-item').click(function(){
                var id= $(this).attr('id');
                $.post("../php/borrardelistas.php",
                    {
                       id: id,                        
                    },
                    (data) => {
                       if(data){
                           $(this).parent().hide(600);
                       }                        
                    }
                );                
            }); 

            $('.check-box').click(function(e){
                var id= $(this).attr('data-elemento-id');
                $.post('../php/checkarlistas.php',
                    {
                       id: id,
                    },
                    (data)=>{
                      if (data !='error'){
                            var h2 = $(this).next();
                            if(data === '1'){
                                h2.removeClass('checked');
                            }else{
                                h2.addClass('checked');
                            }
                        } 
                    }
                    
                );
            });  

        });
    </script>
    <script src="../js/aos.js"></script>
    <script>
        AOS.init();
    </script>
  
</html>
