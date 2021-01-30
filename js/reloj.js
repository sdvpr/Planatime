//TIEMPO TAREA
var activo=false;
var minInicio=25;
let tiempo= minInicio*60;
var click= new Audio("../sonido/bleep.mp3");
var descansoEmpezado=false;
var desc_activo=false;

function check(){//comprueba que no haya una sesión activa
    
    if(!descansoEmpezado){//si no ha empezado el descanso 
        activo=!activo;
            start(activo);
            if(!activo){//si no está activo nos muestra el botón PLAY
                document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";  
            }else{//si lo está, el de PAUSA
                document.getElementById("empezar").innerHTML = "<i class='fas fa-pause fa-2x'></i>";
            }
    } else{//si el descanso ha empezado, comprueba que no haya una sesión activa 
         check_desc(); //el botón de pause parará cuando debe porque si no siempre onclick-> check()
    }
}

function start(){
    
    if(!activo){ //si hemos interrumpido la actividad (se pausa) sale el el botón para pulsar PLAY
        
        document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>"; 

        activo=false;
        clearInterval(ctaAtras);                
    }else{//si no se ha interrumpido
        
        if(tiempo<=0){
            time=25;
        }
        var temporizador =document.querySelector("h4");
        
        function actualizaTemp(){
            
            if(!activo){
               
                document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";      
                clearInterval(ctaAtras);
                activo=false;

            }else{
                if(tiempo <= 0){//para que no llegue a los negativos
                    clearInterval(ctaAtras);
                    activo=false;
                    document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";      
                    click.play();
                    check_desc();
                    descansoEmpezado=true;
                }
                let minutos =Math.floor(tiempo/60);//nos divide el tiempo en min, y nos redondea los numeros decimales
                let segundos =tiempo%60;//para los segundos obtenemos el resto del tiempo dividido entre 60
                minutos =minutos  < 10 ? "0"+ minutos : minutos ;//cuando min y segundos sean menores de 10 pondrá un 0 antes del numero 09,08,07...
                segundos = segundos < 10 ? "0"+ segundos: segundos ;
                temporizador.innerHTML= minutos +":"+segundos ;
                tiempo--;
                
            }
        }
        actualizaTemp();// para  arreglar un segundo de retraso
    
        var ctaAtras =setInterval(actualizaTemp,1000);//con setInterval nos pone un intervalo a casa segundo 
    }

}

// TIEMPO DESCANSO

var descanso=5;
let tiempo_desc= descanso*60;
var click_desc= new Audio("../sonido/bleep.mp3");

function check_desc(){

    desc_activo=!desc_activo;
    start_desc(desc_activo);
    if(!desc_activo){
        document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";  
    }else{
        document.getElementById("empezar").innerHTML = "<i class='fas fa-pause fa-2x'></i>";
    }
}

function start_desc(){
    
    if(!desc_activo){
        
        document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";      
        desc_activo=false;
        clearInterval(ctaAtrasDesc);
        
    }else{
        
        if(tiempo_desc<=0){
            time=5;
        }
        var temporizador =document.querySelector("#desc");
        
        function actualizaTemp_desc(){
           
            if(!desc_activo){
               
                document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";      
                clearInterval(ctaAtrasDesc);
                desc_activo=false;
                }
                else{
                    if(tiempo_desc <= 0){
                        clearInterval(ctaAtrasDesc);
                        desc_activo=false;
                        document.getElementById("empezar").innerHTML = "<i class='fas fa-play fa-2x'></i>";      
                        click_desc.play();
                        resetTimers();
                    }
                    let minutos =Math.floor(tiempo_desc/60);
                    let segundos =tiempo_desc%60;
                    minutos =minutos  < 10 ? "0"+ minutos : minutos ;
                    segundos = segundos < 10 ? "0"+ segundos: segundos ;
                    temporizador.innerHTML= minutos +":"+segundos ;
                    tiempo_desc--; 
                }
        }
        actualizaTemp_desc();
        var ctaAtrasDesc =setInterval(actualizaTemp_desc,1000); 
    }
}
function resetTimers() {
        activo=false;
        minInicio=0;
        tiempo= minInicio*60;
        descansoEmpezado=false;
        desc_activo=false;
        descanso=0;
        tiempo_desc= descanso*60;
        }