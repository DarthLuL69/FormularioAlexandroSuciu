<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $password = $_POST['password'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $sexo = $_POST['sexo'] ?? '';

    $datosUsuario = [
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'telefono' => $telefono,
        'email' => $email,
        'sexo' => $sexo
    ];

    $jsonDatosUsuario = json_encode($datosUsuario);
    file_put_contents('usuarios.txt', $jsonDatosUsuario . PHP_EOL, FILE_APPEND);
    echo $jsonDatosUsuario;
}
?>