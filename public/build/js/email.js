async function findMessageContact(event) {
    event.preventDefault();
    const nombre = document.querySelector('#name').value;
    const correo = document.querySelector('#email').value;
    const mensaje = document.querySelector('#message').value;
    const notrobot = document.querySelector('#notrobot').checked;
    console.log(notrobot);
    if(nombre != '' && correo != '' && mensaje != '' && notrobot == true) {
        await sendEmail(mensaje,'tiendaatlantic1@gmail.com','atlanticatienda33@gmail.com','Mensaje de Contacto');
        document.querySelector('#name').value = '';
        document.querySelector('#email').value = '';
        document.querySelector('#message').value = '';
    } else {
        Swal.fire({
            position: "center",
            icon: 'error',
            title: 'Complete el formulario',
            showConfirmButton: true,
            timer: 2500,
            customStyle: {
              title: {
                fontSize: '17px'
              }
            }
          });
        
    }
}
 
async function sendAlert() {
    const mensaje = "Botón whatsapp clickeado";
    await sendEmail(mensaje,'tiendaatlantic1@gmail.com','atlanticatienda33@gmail.com','Botón whatsapp clickeado');
}


async function sendEmail(body,to,from,subject,alertMessage='Mensaje enviado\n ¡Muchas Gracias',r) {
    Email.send({
        Host : "smtp.elasticemail.com",
        Username : "tiendaatlantic1@gmail.com",
        Password : "18441A2469EEA6BBEBEE6FE0095D748A8809",
        Port: "587",
        SMTPSecure: "tls",
        SMTPAuth: true,
        From : from,
        To : to,
        Subject : subject,
        Body : body
    }).then(
      () => {
          // El correo se envió con éxito
          mostrarAlerta(0, alertMessage,'success',r);
      }
  ).catch(
      (error) => {
          // Hubo un error al enviar el correo
          console.error("Error al enviar el correo:", error);
          mostrarAlerta(0, 'Error al enviar el mensaje. Por favor, inténtelo nuevamente.','error');
      }
  );
}


async function sendSuscribeEmail() {
    const data = new FormData();
    const email = document.querySelector('#emailsuscriptor').value;
    
    if(email != '') {
        
        data.append('email', email);
        url = '/api/new-suscribe';
            const result = await fetch(url,{
                method: 'POST',
                body: data
            });
        const solved = await result.json();
        ////console.log(solved);
        //return;
        if(solved == true) {
                Swal.fire({
                    position: "center",
                    icon: 'success',
                    title: 'Suscripto Correctamente.',
                    showConfirmButton: false,
                    timer: 2500,
                    customStyle: {
                    title: {
                        fontSize: '17px'
                    }
                    }
                }).then((result) => {
                    document.querySelector('#emailsuscriptor').value = '';
                });
        } else {
            mostrarAlerta(0, 'Por favor, ingrese un correo electrónico válido.','error');
        }
        //console.log(solved);
    } else {
        mostrarAlerta(0, 'Por favor, ingrese un correo electrónico.','error');
    }
}
async function borrarSuscriptor(id) {
    //alert(id);

    const titulo = "¿Estás seguro?";
    const icon = "warning";

    const confirmacion = await Swal.fire({
        title: titulo,
        text: "",
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    });

    if (confirmacion.isConfirmed) {
        const data = new FormData();
        data.append('id', id);

        const url = '/api/delete-suscribe';

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });

            const resultado = await response.json();

            if (response.ok) {
                Swal.fire({
                    title: "¡Borrado!",
                    text: "",
                    icon: "success",
                }).then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: resultado.message || "Ha ocurrido un error.",
                    icon: "error",
                });
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error);
            Swal.fire({
                title: "Error",
                text: "Ha ocurrido un error al procesar la solicitud.",
                icon: "error",
            });
        }
    }
}
