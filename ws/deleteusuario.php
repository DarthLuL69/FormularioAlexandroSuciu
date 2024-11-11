<?php

require_once 'Database.php';
require_once 'User.php';

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
    $result = $usuario->getUsuario($id);
    if ($result) {
        if ($usuario->deleteUsuario($id)) {
            $response['success'] = true;
            $response['message'] = 'Usuario eliminado.';
            $response['data'] = $result;
        } else {
            $response['message'] = 'Error al eliminar el usuario.';
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