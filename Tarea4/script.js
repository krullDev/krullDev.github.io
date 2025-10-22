// Ejercicio 1: Cambiar el texto de un elemento al hacer clic en un botón
document.getElementById("cambiartextobtn").addEventListener("click", function() {
    document.getElementById("textElement").innerText = "Texto cambiado con JavaScript";
});

// Ejercicio 2: Agregar el texto de un elemento en una lista
document.getElementById("agregaralistabtn").addEventListener("click", function() {
    var texto = document.getElementById("inputTexto").value;
    var li = document.createElement("li");
    li.innerText = texto;
    document.getElementById("miLista").appendChild(li);
});

// Ejercicio 3: Mostrar/Ocultar contenido mediante un boton
document.getElementById("mostrarocultarbbtn").addEventListener("click", function() {
    var contenido = document.getElementById("contenido");  
    if (contenido.style.display === "none") {
        contenido.style.display = "block";
    } else {
        contenido.style.display = "none";
    }
});

// Ejercicio 4: Cambiar color de un párrafo (rojo, verde y azul)
document.getElementById("cambiarColorBtn").addEventListener("click", function() {
    var parrafo = document.getElementById("cambiarColorTxt");
    var colores = ["red", "green", "blue"];
    var colorActual = parrafo.style.color || "red"; // color inicial por si no hay ninguno
    var nuevoColor = colores[(colores.indexOf(colorActual) + 1) % colores.length];
    parrafo.style.color = nuevoColor;
});

// Ejercicio 5: Contador de clics en un botón
var contador = 0;
document.getElementById("contarClicksBtn").addEventListener("click", function() {
    contador++;
    document.getElementById("contadorClicks").innerText = "Clics: " + contador;
});

// Ejercicio 6: Validar un formulario simple
document.getElementById("validarFormularioBtn").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar el envío del formulario para validación
    var nombre = document.getElementById("nombre").value;
    var mensaje = "";
    var colormensaje = document.getElementById("mensajeFormulario");
    

    if (nombre === "") {
        mensaje += "Por favor, ingresa tu nombre.\n";
        colormensaje.style.color = "red";
    }

    if (mensaje !== "") {
        document.getElementById("mensajeFormulario").innerText = mensaje;
    } else {
        document.getElementById("mensajeFormulario").innerText = "Formulario enviado con éxito.";
        colormensaje.style.color = "green";
    }
});