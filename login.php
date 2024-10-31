<?php
include "db.php"; 

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'], $data['password'])) {
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {
            echo json_encode(['success' => true, 'rol' => $usuario['rol']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}

$conn->close();
?>
