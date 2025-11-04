<?php
// backend/utils/Response.php

class Response {
    public static function success($data = null, $message = 'Success', $code = 200) {
        http_response_code($code);
        echo json_encode([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
        exit();
    }

    public static function error($message = 'Error', $code = 400) {
        http_response_code($code);
        echo json_encode([
            'success' => false,
            'message' => $message,
            'data' => null
        ]);
        exit();
    }

    public static function notFound($message = 'Resource not found') {
        self::error($message, 404);
    }

    public static function created($data, $message = 'Created successfully') {
        self::success($data, $message, 201);
    }
}
