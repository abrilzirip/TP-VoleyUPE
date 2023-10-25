function inicio(){
  document.getElementById("registrarUsuario").addEventListener('submit', enviarFormulario);
}


function enviarFormulario(evento) {
  evento.preventDefault();
  if (Validaciones()) {
      console.log('envio existoso')
  }
}


function Validaciones(){

  let mensajeMail = document.getElementById("email");
  mensajeMail.classList.remove("is-invalid");

  let mensajeEdad = document.getElementById("edad");
  mensajeEdad.classList.remove("is-invalid");



  ////////////////////Validar Email

  let mail = document.getElementById("email").value;
  let regularMail = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
  
  if(!regularMail.test(mail)){
      alert('El correo ingresado no cumple un formato valido')
      return false;
  }


  //////////Validar Edad

  let fechaNacimiento = new Date(document.getElementById('edad').value); // aca obtengo el valor ingresado en el formulario

  // aca obtengo la fecha de la actualidad
  let fechaActual = new Date();

 
  let diferencia = fechaActual - fechaNacimiento; // la diferencia entre la fecha actual y la fecha ingresada 

  // convierto la diferencia en años
  let edad = Math.floor(diferencia / (1000 * 60 * 60 * 24 * 365.25)); //Math.floor para redondear hacia abajo el resto de la division matematica

  if (edad < 16) {
      // si la edad es menor a 16 años, muestro un mensaje "alert" en la pagina indicando que no pudo iniciar sesion, y el error
      alert('Para registrarte en la pagina de VOLEY UPE debes tener almenos 16 años');
      return false;
  }

  // La edad es mayor o igual a 16 años
  return true;
}
window.onload = inicio;