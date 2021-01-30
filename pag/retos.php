<?php
    require '../php/datosBD.php';
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
    <title>Retos • Planatime</title>
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
    <!-- para full calendar -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/moment.min.js"></script>
    <!-- Full calendar -->
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/es.js"></script>
    <!--clockpicker-->
    <script src="../js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css">
    <!-- scripts bootstrap que tienen que estar aqui -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
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
                <li class="nav-item ">
                    <a class="nav-link" href="tareas.php">Tareas</a>
                </li>
                <li class="nav-item  active">
                    <a class="nav-link" href="retos.php">Retos<span class="sr-only">(current)</span></a>
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
    <?php echo "<br><h1  class='display-4' align='center'>Este es tu calendario de retos, ".$nombre."!</h1>"; ?> <br>
        <div class="row">
            <div class="col"></div>
            <div class="col-8"><div id="calendario" data-aos="fade-up" data-aos-delay="200"></div></div>
            <div class="col"></div>
        </div>
    </div>
    
    <script>
    $(document).ready(function(){
    
        $('#calendario').fullCalendar({
            header:{
                left:'today, prev,next,Informacion',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            customButtons:{
                Informacion:{
                    text:"Información",
                    click:function(){
                        alert("Este es tu calendario de retos, aqui puedes crear tus retos diarios y seguir los que proponemos. Recuerda que los retos propuestos no pueden ser eliminados ni modificados.");
                    }
                }
            },
            dayClick:function(date,jsEvent,view){               
                $('#btnAgregar').show();
                $('#btnEditar').hide();
                $('#btnEliminar').hide();
                
                $('#txtFecha').val(date.format());//fecha del día en el que se clica
                limpiarFormulario();
                $('#ModalEventos').modal();
                
            },
            events:'../php/anadireventos.php',
                
            eventClick:function(calEvent,jsEvent,view){
                $('#ModalEventos').modal();
                $('#btnAgregar').hide();
                $('#btnEditar').show();
                $('#btnEliminar').show();
                //h2
                $('#tituloEvento').html(calEvent.title);
                //saca la info en los inputs
                $('#txtDescripcion').val(calEvent.descripcion);
                $('#txtId').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);

                var FechaHora=calEvent.start._i.split(" ");
                $('#txtFecha').val(FechaHora[0]);
                $('#txtHora').val(FechaHora[1]);

                // Si lo descomento no abre el modal de los demás eventos, solo del primero en la bbdd
                FechaHoraFin=calEvent.end._i.split(" ");
                $('#txtFechaFin').val(FechaHoraFin[0]);
                $('#txtHoraFin').val(FechaHoraFin[1]);
 
            },
            editable:true,
            eventDrop:function(calEvent){//recupero el evento modificado para llevarlo a la bbdd
                $('#txtId').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);
                $('#txtDescripcion').val(calEvent.descripcion);
                
                FechaHora=calEvent.start.format().split("T");//le vuelvo a poner el formato establecido en la bbdd
                $('#txtFecha').val(FechaHora[0]);
                $('#txtHora').val(FechaHora[1]);

                FechaHoraFin=calEvent.end.format().split("T");
                $('#txtFechaFin').val(FechaHoraFin[0]);
                $('#txtHoraFin').val(FechaHoraFin[1]);

                //actualizo la info en la bbdd
                var id= $('#txtId').val();
                var title= $('#txtTitulo').val();
                var start= $('#txtFecha').val()+" "+$('#txtHora').val();
                var color=$('#txtColor').val();
                var descripcion=$('#txtDescripcion').val();
                var textColor="#FFFFFF";
                var end=$('#txtFechaFin').val()+" "+$('#txtHoraFin').val();
                enviarInfo('editar',id,title,start,color,descripcion,textColor,end,true);
            }
           
        });

    });
    
    </script>

    <!-- Modal -->
    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  mo " role="document" >
            <div class="modal-content  mo" >
                
                <div class="modal-header  mo">
                    <h5 class="modal-title" id="tituloEvento"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  mo">
                        <input type="hidden" id="txtId" name="txtId">
                        <input type="hidden" id="txtFecha">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Titulo:</label> 
                                <input type="text" id="txtTitulo" class="form-control" autocomplete="off" placeholder="Título del reto"> 
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hora de inicio:</label>
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" id="txtHora" class="form-control">
                                </div>                                
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Descripción: </label>
                            <textarea  id="txtDescripcion" class="form-control" row="3" autocomplete="off" placeholder="¿En qué consiste?"></textarea>
                        </div>                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Fecha de fin: </label>
                                <input type="text" id="txtFechaFin" autocomplete="off" class="form-control" placeholder="aaaa/mm/dd">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Hora de fin:</label>
                                <div class="input-group clockpicker" data-autoclose="true" >
                                    <input type="text" id="txtHoraFin" autocomplete="off" class="form-control"> 
                                </div>                                
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Color:</label>   
                            <input type="color" id="txtColor" class="form-control" value="#ff0000" >
                        </div>
                               
                                          
                </div>
                <div class="modal-footer  mo">
                    <button type="text" id="btnAgregar"class="btn btn-success" >Agregar</button>
                    <button type="text" id="btnEditar" class="btn btn-primary" >Editar</button>
                    <button type="text" id="btnEliminar" class="btn btn-danger" >Eliminar</button>
                    <button type="button" id="btnCerrar" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                </div>
                
            </div>
        </div>
    </div>
    
    <script>
       
        $('#btnAgregar').click(function(){
            var id= $('#txtId').val();
            var title= $('#txtTitulo').val();
            var start= $('#txtFecha').val()+" "+$('#txtHora').val();
            var color=$('#txtColor').val();
            var descripcion=$('#txtDescripcion').val();
            var textColor="#FFFFFF";
            var end=$('#txtFechaFin').val()+" "+$('#txtHoraFin').val();
            enviarInfo('agregar',id,title,start,color,descripcion,textColor,end);
        }); 

        $('#btnEditar').click(function(){
            var id= $('#txtId').val();
            var title= $('#txtTitulo').val();
            var start= $('#txtFecha').val()+" "+$('#txtHora').val();
            var color=$('#txtColor').val();
            var descripcion=$('#txtDescripcion').val();
            var textColor="#FFFFFF";
            var end=$('#txtFechaFin').val()+" "+$('#txtHoraFin').val();
            enviarInfo('editar',id,title,start,color,descripcion,textColor,end);
        });
        
        $('#btnEliminar').click(function(){
            var id= $('#txtId').val();
            var title= $('#txtTitulo').val();
            var start= $('#txtFecha').val()+" "+$('#txtHora').val();
            var color=$('#txtColor').val();
            var descripcion=$('#txtDescripcion').val();
            var textColor="#FFFFFF";
            var end=$('#txtFechaFin').val()+" "+$('#txtHoraFin').val();
            enviarInfo('eliminar',id,title,start,color,descripcion,textColor,end);
        }); 

        function enviarInfo(accion,id,title,start,color,descripcion,textColor,end, modal){
        
            var peticion = $.ajax({
                type:"POST",
                url:"../php/anadireventos.php?accion="+accion,
                async: true,
                data:{
                    id:id,
                    title:title,
                    start:start,
                    color:color,
                    descripcion:descripcion,
                    textColor,
                    end:end
                },
                success:function(msg){
                    if(msg){
                         $('#calendario').fullCalendar('refetchEvents');
                        if(!modal){
                            $("#ModalEventos").modal('toggle'); //se ejecuta si no le mando el parametro modal (agregar, editar, borrar)
                        }
                         
                    }

                },
                error:function(){
                    alert("Error");
                },
                
            })
        }

        $('.clockpicker').clockpicker();
        
        function limpiarFormulario(){
            $('#tituloEvento').html('');
            $('#txtId').val('');
            $('#txtTitulo').val('');
            $('#txtColor').val('');
            $('#txtDescripcion').val('');
            $('#txtHora').val('');
            $('#txtFechaFin').val(''); 
            $('#txtHoraFin').val(''); 
        }
        
    </script>
    <script src="../js/aos.js"></script>
    <script>
        AOS.init();
    </script>
<?php 
 include "../pie/footer.html";

 ?>
</html>