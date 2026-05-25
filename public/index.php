<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Support\Env;
use App\Controller\AppointmentController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // ✅ sửa
$method = $_SERVER['REQUEST_METHOD'];

$controller = new AppointmentController();

if ($uri === '/' && $method === 'GET') {

    $clinic       = Env::get('CLINIC_NAME');
    $appointments = require __DIR__ . '/../src/Data/appointments.php';
    require __DIR__ . '/../views/home.php';

} elseif ($uri === '/appointments' && $method === 'GET') {

    $controller->list();

} elseif ($uri === '/appointments' && $method === 'POST') {

    $controller->register();

} elseif ($uri === '/appointments' && $method === 'HEAD') { // ✅ thêm

    header('Content-Type: application/json');
    header('X-Resource: appointments');
    http_response_code(200);

} elseif ($uri === '/appointments' && $method === 'OPTIONS') { // ✅ thêm

    header('Allow: GET, POST, HEAD, OPTIONS');
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode(['allowed_methods' => ['GET', 'POST', 'HEAD', 'OPTIONS']]);

} elseif ($uri === '/appointments' && !in_array($method, ['GET', 'POST', 'HEAD', 'OPTIONS'])) {

    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Method Not Allowed']);

} else {

    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Not Found']);
}