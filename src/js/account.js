async function borrarUsuario(idUsuario) {
    // Puedes implementar aquí la lógica para borrar el usuario con el ID proporcionado
    //alert("Borrar usuario con ID: " + idUsuario);

    try {
        const { value: confirmDelete } = await Swal.fire({
            title: "¿Eliminar?",
            //text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, confirmar",
            cancelButtonText: "No, cancelar",
        });

        if (confirmDelete) {
            const data = new FormData();
            data.append('idUsuario', idUsuario);

            const url = `${location.origin}/api/af4c266f3541aeb7d02f306d50a05f0e`;
            const response = await fetch(url, {
                method: 'POST',
                body: data,
            });

            const result = await response.json();
            console.log(result);
            if (result) {
                Swal.fire({
                    icon: 'success',
                    title: '¡LISTO!',
                    text: '¡Eliminado correctamente!',
                    button: 'OK',
                }).then(() => {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Lo sentimos, se ha producido un error',
                    button: 'OK',
                });
            }

            console.log(result);
        }
    } catch (error) {
        console.error(error);
    }
}
async function borrarRegistro(idRegistro) {
    //alert(x);
    try {
        const { value: confirmDelete } = await Swal.fire({
            title: "¿Eliminar?",
            //text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, confirmar",
            cancelButtonText: "No, cancelar",
        });

        if (confirmDelete) {
            const data = new FormData();
            data.append('idRegistro', idRegistro);

            const url = `${location.origin}/api/b1d9310c2b7d91c2fcb59a30582dc00d`;
            const response = await fetch(url, {
                method: 'POST',
                body: data,
            });

            const result = await response.json();
            
            if (result) {
                Swal.fire({
                    icon: 'success',
                    title: '¡LISTO!',
                    text: '¡Eliminado correctamente!',
                    button: 'OK',
                }).then(() => {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Lo sentimos, se ha producido un error',
                    button: 'OK',
                });
            }

            console.log(result);
        }
    } catch (error) {
        console.error(error);
    }
}
