function mostrarContrasena($token) {

    var btnMostrar = document.getElementById("mostrar_contrasena-" + $token);
    var contrasena  = document.getElementById("contrasena-" + $token);


    if (contrasena.type === "password") {
        contrasena.type = "text";
        btnMostrar.setAttribute("class", "fas fa-eye-slash");
    }
    else {
        contrasena.type = "password";
        btnMostrar.setAttribute("class", "fas fa-eye");
    }
}
function mostrarContrasena() {

    var btnMostrar = document.getElementById("mostrar_contrasena");
    var contrasena  = document.getElementById("contrasena");


    if (contrasena.type === "password") {
        contrasena.type = "text";
        btnMostrar.setAttribute("class", "fas fa-eye-slash");
    }
    else {
        contrasena.type = "password";
        btnMostrar.setAttribute("class", "fas fa-eye");
    }
}

function copiarContrasena(token) {

    var inputContrasena  = document.getElementById("contrasena-" + token);

    copiarPortapapeles(inputContrasena.value);

    alert("Contraseña copiada al portapapeles");
}

function copiarUsuario(token) {

    var inputUsuario  = document.getElementById("usuario-" + token);

    copiarPortapapeles(inputUsuario.value);

    alert("Usuario copiado al portapapeles");

}

function copiarPortapapeles(string) {
    const temp = document.createElement('textarea');
    temp.value = string;
    document.body.appendChild(temp);
    temp.select();
    document.execCommand('copy');
    document.body.removeChild(temp);
}

function filtrarServicio(){

    var servicio =document.getElementById("filtrar-servicio").value;

    window.location = "index.php?pagina=contrasenas&servicio=" + servicio;
}