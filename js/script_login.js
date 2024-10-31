function validarLogin(event) {
    event.preventDefault(); 

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const data = {
        email: email,
        password: password
    };

    fetch("login.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.rol === '1') {
                window.location.href = "gestor1.html"; // Grupo 1
            } else if (data.rol === '2') {
                window.location.href = "gestor.html"; // Grupo 2
            }
        } else {
            document.getElementById('error-message').innerText = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
