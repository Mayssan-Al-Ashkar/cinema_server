<?php
class ResponseService {
    public static function success_response($payload = [], $code = 200) {
        http_response_code($code);
        return json_encode([
            'success' => true,
            ...$payload
        ]);
    }

    public static function error_response($message, $code = 500) {
        http_response_code($code);
        return json_encode([
            'success' => false,
            'message' => $message
        ]);
    }
}
