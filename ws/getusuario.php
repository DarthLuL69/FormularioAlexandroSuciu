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
    $result = $usuario->getUsuario($id);
    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Usuario encontrado.';
        $response['data'] = $result;
    } else {
        $response['message'] = 'Usuario no encontrado.';
    }
} else {
    $result = $usuario->getUsuarios();
    $response['success'] = true;
    $response['message'] = 'Usuarios encontrados.';
    $response['data'] = $result;
}

header('Content-Type: application/json');
echo json_encode($response);
?>