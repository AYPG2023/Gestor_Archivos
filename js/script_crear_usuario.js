function crearUsuario() {
    const email = document.getElementById('nuevo-email').value;
    const password = document.getElementById('nueva-password').value;
    const departamento = document.getElementById('departamento').value;

    const data = {
        email: email,
        password: password,
        departamento: departamento
    };

    fetch("crear_usuario.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Usuario creado exitosamente.');
            window.location.href = 'index.html'; // Redirige al login después de crear el usuario
        } else {
            document.getElementById('error-message').innerText = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('error-message').innerText = 'Error en la conexión. Por favor, inténtalo de nuevo.';
    });
}
