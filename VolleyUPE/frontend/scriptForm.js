function inicio(){
  document.getElementById("formulario").addEventListener('submit', enviarFormulario);
  document.getElementById("edad").addEventListener('change', MostrarAutorizada);
}


function enviarFormulario(evento) {
  evento.preventDefault();
  if (Validaciones()) {
      mostrarModal();
  }
}


function mostrarModal() {
  let exampleModal = new bootstrap.Modal(document.getElementById('gracias'));
  exampleModal.show();
  let modalTexto = document.getElementById("textoModal");
  let nombreInput = document.getElementById("nombre").value;
  modalTexto.innerHTML = "Gracias por registrarse, " + nombreInput;
  limpiarFormulario();
   
}
////////////////////////

function MostrarAutorizada(){
   //Muestro los equipos del grupo FAC
  let edadAutorizada = document.getElementById('edad');
  let numeroEdad = edadAutorizada.value;
  if(numeroEdad >=14 && numeroEdad <18){
      document.getElementById("autorizar").classList.remove("AutorizadoOculto"); //agrego la clase que hace visible los grupos
  }else{
      document.getElementById("autorizar").classList.add("AutorizadoOculto"); //agrego la clase que hace visible los grupos

  }
}

//////////
function limpiarFormulario() {
  document.getElementById("formulario").reset();
}

///////////////////

function Validaciones(){


  let mensajeNombre = document.getElementById("nombre");
  mensajeNombre.classList.remove("is-invalid");

  let mensajeMail = document.getElementById("email");
  mensajeMail.classList.remove("is-invalid");

  let mensajeEdad = document.getElementById("edad");
  mensajeEdad.classList.remove("is-invalid");



  let inputTexto = document.getElementById("nombre").value;
  let palabras = inputTexto.split(/\s+/); 
  let RegularLetras=/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/;

  //////////Validar cantidad de palabras

  if (palabras.length !== 2 ){
          console.log('Debes ingresar nombre y apellido solamente.');
          mensajeNombre.classList.add("is-invalid");

          return false;
  }  

  //////////Validar el rango de ambas palabras

  for (let cadena of palabras){
      if(cadena.length < 3 || cadena.length > 15){
          mensajeNombre.classList.add("is-invalid");

          console.log('MAL RANGO PALABRAS');
          return false;
      }
  }

  /////////////Validar caracteres

  if(!RegularLetras.test(inputTexto)){
      mensajeNombre.classList.add("is-invalid");
      console.log('invalido');
  }


  ////////////////////Validar Email

  let mail = document.getElementById("email").value;
  let regularMail = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
  
  if(!regularMail.test(mail)){
      mensajeMail.classList.add("is-invalid");
      console.log('caracteres invalidos en el formato mail');
      return false;
  }


  //////////Validar Edad

  let edad = document.getElementById("edad");
  let num = parseInt(edad.value);

  if (!isNaN(num) && num < 14 || num > 100) {
      mensajeEdad.classList.add("is-invalid");
      console.log('ERROR EDAD');
      return false;
  }
  return true;
}
window.onload = inicio;