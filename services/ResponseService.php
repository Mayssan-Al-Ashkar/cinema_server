<?php
class ResponseService {
    public static function success_response(array $payload = [], int $code = 200): void {
        http_response_code($code);
        echo json_encode(array_merge([
            'success' => true
        ], $payload));
    }

    public static function error_response(string $message, int $code = 500): void {
        http_response_code($code);
        echo json_encode([
            'success' => false,
            'message' => $message
        ]);
    }
}
