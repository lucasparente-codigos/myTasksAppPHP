<?php
// backend/index.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Tratar requisições OPTIONS (CORS preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/utils/Response.php';
require_once __DIR__ . '/routes/api.php';

// Capturar a rota da requisição
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remover query string e pegar apenas o path
$path = parse_url($requestUri, PHP_URL_PATH);
$path = str_replace('/backend', '', $path);

// Rotear para o controlador apropriado
try {
    handleRoute($path, $requestMethod);
} catch (Exception $e) {
    Response::error($e->getMessage(), 500);
}
