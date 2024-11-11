<?php

require_once 'Database.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$usuario->nombre = $_POST['nombre'] ?? '';
$usuario->apellidos = $_POST['apellidos'] ?? '';
$usuario->password = $_POST['password'] ?? '';
$usuario->telefono = $_POST['telefono'] ?? '';
$usuario->email = $_POST['email'] ?? '';
$usuario->sexo = $_POST['sexo'] ?? '';

$response = [
    'success' => false,
    'message' => '',
    'data' => null
];

$id = $usuario->createUsuario();
if ($id) {
    $result = $usuario->getUsuario($id);
    $response['success'] = true;
    $response['message'] = 'Usuario creado.';
    $response['data'] = $result;
} else {
    $response['message'] = 'Error al crear el usuario.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>