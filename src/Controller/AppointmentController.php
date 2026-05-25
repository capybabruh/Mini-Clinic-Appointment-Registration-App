<?php

namespace App\Controller;

class AppointmentController {

    public function list() {
        header('Content-Type: application/json');
        $appointments = require __DIR__ . '/../Data/appointments.php';
        http_response_code(200);
        echo json_encode($appointments);
    }

    public function register() {

        header('Content-Type: application/json');

        // ❌ 415 - sai Content-Type
        if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') === false) {
            http_response_code(415);
            echo json_encode(['error' => 'Unsupported Media Type']);
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true);

        // ❌ 422 - JSON lỗi
        if (!is_array($input)) {
            http_response_code(422);
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        // ❌ 422 - thiếu tên bệnh nhân
        if (empty($input['patient_name'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Patient name is required']);
            return;
        }

        // ❌ 422 - sai kiểu dữ liệu
        if (!is_string($input['patient_name'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Patient name must be string']);
            return;
        }

        // ❌ 422 - thiếu appointment_id
        if (!isset($input['appointment_id'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Appointment ID is required']);
            return;
        }

        // ❌ 422 - sai kiểu
        if (!is_int($input['appointment_id'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Appointment ID must be integer']);
            return;
        }

        $appointments = require __DIR__ . '/../Data/appointments.php';

        // ❌ 404 - không tồn tại
        $found = null;
        foreach ($appointments as $a) {
            if ($a['id'] === $input['appointment_id']) {
                $found = $a;
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Appointment not found']);
            return;
        }

        // ❌ 422 - hết chỗ
        if ($found['available'] <= 0) {
            http_response_code(422);
            echo json_encode(['error' => 'No slots available']);
            return;
        }

        // ❌ 422 - vượt số lượng
        if (isset($input['quantity'])) {
            if (!is_int($input['quantity']) || $input['quantity'] <= 0) {
                http_response_code(422);
                echo json_encode(['error' => 'Quantity must be positive integer']);
                return;
            }

            if ($input['quantity'] > $found['available']) {
                http_response_code(422);
                echo json_encode(['error' => 'Exceeds available slots']);
                return;
            }
        }

        // ✅ SUCCESS
        http_response_code(201);
        echo json_encode([
            'message'        => 'Appointment registered successfully',
            'patient_name'   => $input['patient_name'],
            'appointment_id' => $input['appointment_id']
        ]);
    }
}