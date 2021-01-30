function validar(){
    var nombre, apellido, email, contrasena, expresion;
    nombre= document.getElementById("nombre").value;
    apellido= document.getElementById("apellido").value;
    email= document.getElementById("email").value;
    contrasena= document.getElementById("contrasena").value;
    expresionmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    expresionword=/^[a-zA-Z]/; 

    // expresion_contrasena=/^\w{8}$/;
    if(nombre === "" || apellido === "" || email === "" || contrasena === ""){
        alert("Todos los campos son obligatorios");
        return false;
    }else if(nombre.length>20 || apellido.length>20){
        alert("El nombre y el apellido debe tener 20 caracteres como máximo");
        return false;
    }else if(nombre.length<2 || apellido.length<2 || contrasena.length<8){
        alert("El nombre y el apellido debe tener 2 caracteres como mínimo, y recuerda que la contraseña debe contener al menos 8 caracteres.");
        return false;
    }else if(email.length>45){
        alert("El e-mail es muy largo");
        return false;
    }else if(email.length<7){
        alert("El e-mail es muy corto");
        return false;    
    }else if(!expresionmail.test(correo)){
        alert("El e-mail no es válido");
        return false;
    }else if(expresionword.test(nombre)){//
        alert("El nombre solo puede contener letras");
        return false;
    }else if(expresionword.test(apellido)){//
        alert("El apellido solo puede contener letras");
        return false;
    }else if(contrasena.length>60){
        alert("Contraseña demasiado larga");
        return false;
    }
    // else if(!expresion_contrasena.test(contrasena)){
    //     alert("El e-mail no es válido");
    //     return false;
    // }
    
    

 } 