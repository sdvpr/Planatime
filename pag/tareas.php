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
    <title>Tareas • Planatime</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="icon" href="../img/favicon.png" type="image/png" sizes="32x32">
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
    <style> 
        .col-6{
            align:center;
            padding:20px;
            background-color: rgba(255, 0, 0, 0.3) ;
        }
        th{
            padding-left:0;
        }
        td,tr,th{
            border: 1px solid black;
            height:auto;
            width:800px;
            padding:20px; 
        }
        .hacer{
            background-color: rgba(255, 0, 0, 0.3) ; 
            
        }
        .planificar{
            background-color: rgba(0, 0, 255, 0.3) ; 
        }
        .delegar{
            background-color: rgba(0, 255, 0, 0.3) ; 
        }
        .eliminar{
            background-color: rgba(0, 255, 255, 0.3) ; 
        }
        .btn{
            background-color:#E1EEE1;
        }
    </style>
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
                    <a class="nav-link" href="../index.php">Inicio </a> 
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="listas.php">Listas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="tareas.php">Tareas<span class="sr-only">(current)</span></a>
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
    <?php echo "<br><h1  class='display-4 ' align='center'>Bienvenido al mundo de Matrix, ".$nombre."! 😎</h1>"; ?>
    <br>
    <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-5">
            <table>
                <th><button id="info" class="btn">Información</button></th>
                <th>Urgente</th>
                <th>No Urgente</th>
                    <tr>
                        <th>Importante</th>
                        <td class="hacer"> 
                            1️⃣ Hacer ya!
                            <ol>
                                <?php 
                                $tareas = $conexion->query("SELECT cod,titulo,date_time,checked,importante,urgente, usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."' AND checked = 1 AND importante=1  AND urgente = 1 ");
                                while($tarea = $tareas -> fetch(PDO::FETCH_ASSOC)) { 
                                    echo "<li> ";                          
                                    echo "<h3>".$tarea['titulo']."</h3><br>";
                                    echo "</li>";
                                }

                                ?>
                            </ol>                         
                        </td>
                        <td class="planificar">
                            2️⃣Planificar
                            <ol>
                                <?php 
                                $tareas = $conexion->query("SELECT cod,titulo,date_time,checked,importante,urgente, usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."' AND checked = 1 AND  importante=1 AND (urgente IS NULL OR urgente = 0 ) ");
                                while($tarea = $tareas -> fetch(PDO::FETCH_ASSOC)) { 
                                    echo "<li> ";                           
                                    echo "<h3>".$tarea['titulo']."</h3><br>"; 
                                    echo "</li>";
                                }
                                    
                                ?>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <th>No Importante</th>
                        <td class="delegar">
                            3️⃣ Delegar
                            <ol>                           
                                <?php 
                                $tareas = $conexion->query("SELECT cod,titulo,date_time,checked,importante,urgente, usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."' AND checked = 1 AND urgente = 1  AND (importante=0 OR importante IS NULL ) ");
                                while($tarea = $tareas -> fetch(PDO::FETCH_ASSOC)) { 
                                    echo "<li> ";                           
                                    echo "<h3>".$tarea['titulo']."</h3><br>"; 
                                    echo "</li>";
                                }
                                
                                ?>
                            </ol>
                        </td>
                        <td class="eliminar">
                            4️⃣ Eliminar
                            <ol>
                                <?php 
                                $tareas = $conexion->query("SELECT cod,titulo,date_time,checked,importante,urgente, usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."'AND checked = 1 AND (importante=0 OR importante IS NULL)  AND (urgente = 0 OR urgente IS NULL)  ");
                                while($tarea = $tareas -> fetch(PDO::FETCH_ASSOC)) { 
                                    echo "<li> ";                           
                                    echo "<h3>".$tarea['titulo']."</h3><br>"; 
                                    echo "</li>";
                                }
                                    
                                ?>
                            </ol>
                        </td>
                    </tr>
                </table>
                <p> &nbsp; ¿Necesitas aprender cómo funciona? <a href="https://www.youtube.com/watch?v=jxiCV0vwVT8&ab_channel=TEDxTalks" target="_blank" [style.color]="green">No te pierdas este video</a>🧠</p>
                <br>
                <img src="" alt="">            
        </div>
        <div class="col-md-5">
            <h2>Estas son tus nuevas tareas:</h2>
            <small>Cuanto antes las ordenes, antes podrás tomar acción, y conseguirás realizarlas todas! 😉</small> <br><br>

            <?php 
            $tareas = $conexion->query("SELECT cod,titulo,date_time,checked,importante,urgente, usuario_cod FROM lista WHERE usuario_cod='".$usuario_cod."' AND checked = 1 ORDER BY cod DESC");
        
            if($tareas->rowCount() <= 0){
            ?>
                <div class="item">
                    <div class="vacio">
                        <br>
                        <img src="../img/ilustraciones/nada.png" alt="gif" width="50%">
                        <p>&nbsp; Anda! un lindo gatito viendo tu tabla... vacía... 😿</p>
                    </div>
                </div>
                
            <?php }  
        
            while($tarea = $tareas -> fetch(PDO::FETCH_ASSOC)) {   ?>
                <div class="item">
        
                    <?php echo "<h3>".$tarea['titulo'] ."</h3><br>"; ?>
                
                    <?php 
                    if($tarea['importante'] == true ){ ?>

                        <p>¿Es importante?: <input type="checkbox" data-tarea-id="<?php echo $tarea['cod']?>" class="importante" checked> </p>

                    <?php 
                    }else{ ?>

                        <p>¿Es importante?: <input type="checkbox" data-tarea-id="<?php echo $tarea['cod']?>" class="importante"> </p>

                    <?php 
                    }  

                    if( $tarea['urgente'] == true){ ?>

                        <p>¿Es urgente?: <input type="checkbox" data-tarea-id="<?php echo $tarea['cod']?>" class="urgente" checked> </p>

                    <?php  
                    }else{ ?>

                        <p>¿Es urgente?: <input type="checkbox" data-tarea-id="<?php echo $tarea['cod']?>" class="urgente"> </p>
                    <?php
                    }            
                    ?>
                    
                    <span id="<?php echo $tarea['cod']?>" class="borrar-item" ><i class="fas fa-trash-alt "></i></span>
                    <hr class="my-4">
                </div>
            
                <?php 

            }
            ?>
        

        <button class="btn orden"><a href="javascript:location.reload()">Ya está todo en orden!</a></button>
        </div>  
        <?php
        include "../pie/scripts.html";
        ?>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $('#info').click( function(){
                    alert("Aquí podrás ordenar tus tareas según su urgencia e importancia, cuanto antes las hagas antes las dejarás de ver en el mismo lugar, en la tabla las tienes ordenadas por orden de entrada, TU PUEDES CONTROLAR EL MATRIX! Ve corriendo a la Lista para añadir tus tareas antes de que las fechas de entrega te alcancen! Recuerda: Lo que es URGENTE requiere de atención inmediata, tiene consecuencias inmediatas, y lo que es IMPORTANTE es aquello que nos ayuda a lograr nuestras metas personales o profesionales")
                });

                $('.importante').click(function(e){
                    var importante= $(this).attr('data-tarea-id');
                    $.post('../php/checkartareas.php',
                        {
                            importante: importante,
                        },
                        (data)=>{
                            if (data !='error'){
                                // alert(importante);
                            } 
                        }
                    );
                });

                $('.urgente').click(function(e){
                    var urgente= $(this).attr('data-tarea-id');
                    $.post('../php/checkartareas.php',
                        {
                            urgente: urgente,
                        },
                        (data)=>{
                            if (data !='error'){
                                // alert(urgente);
                            } 
                        }
                    );
                }); 

                $('.borrar-item').click(function(){
                    var id= $(this).attr('id');
                    $.post("../php/borrardelistas.php",
                        {
                            id: id,                        
                        },
                        (data) => {
                            if(data){
                                $(this).parent().hide(500);
                            }                        
                        }
                    );                
                });

            });
        </script>

    </div>  
</div>
    
<?php 
    include "../pie/footer.html";    
?>
</html>