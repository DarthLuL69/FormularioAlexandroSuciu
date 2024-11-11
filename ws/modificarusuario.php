<?php

require_once 'Database.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$response = [
    'success' => false,
    'message' => '',
    'data' => null
];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuarioExistente = $usuario->getUsuario($id);

    if ($usuarioExistente) {
        $usuario->nombre = $_POST['nombre'] ?? $usuarioExistente['nombre'];
        $usuario->apellidos = $_POST['apellidos'] ?? $usuarioExistente['apellidos'];
        $usuario->password = $_POST['password'] ?? $usuarioExistente['password'];
        $usuario->telefono = $_POST['telefono'] ?? $usuarioExistente['telefono'];
        $usuario->email = $_POST['email'] ?? $usuarioExistente['email'];
        $usuario->sexo = $_POST['sexo'] ?? $usuarioExistente['sexo'];

        if ($usuario->updateUsuario($id)) {
            $result = $usuario->getUsuario($id);
            $response['success'] = true;
            $response['message'] = 'Usuario modificado.';
            $response['data'] = $result;
        } else {
            $response['message'] = 'Error al modificar el usuario.';
        }
    } else {
        $response['message'] = 'Usuario no encontrado.';
    }
} else {
    $response['message'] = 'ID no proporcionado.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>