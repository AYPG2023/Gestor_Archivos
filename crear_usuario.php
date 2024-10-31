<?php
header('Content-Type: application/json');
include "db.php"; 

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'], $data['password'], $data['departamento'])) {
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT); 
    $departamento = $data['departamento'];

    $rol = '1'; 
    $grupo1 = ['Proyectos', 'Administracion', 'Planificacion', 'Financiero'];
    $grupo2 = ['Dep. Cartera', 'Dep. Social', 'Dep. Juridico', 'Dep. Catastro', 'Archivo General'];

    if (in_array($departamento, $grupo1)) {
        $rol = '1';
    } elseif (in_array($departamento, $grupo2)) {
        $rol = '2';
    }

    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado.']);
    } else {
        $stmt = $conn->prepare('INSERT INTO usuarios (email, password, departamento, rol) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $email, $password, $departamento, $rol);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el usuario.']);
        }
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}

$conn->close();
?>
