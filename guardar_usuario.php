<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    file_put_contents('usuarios.txt', $usuario, FILE_APPEND | LOCK_EX);
    echo 'success';
} else {
    echo 'fail';
}
?>
