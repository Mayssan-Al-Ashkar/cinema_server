<?php
require(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . '/../services/ResponseService.php');

class BaseController {

    public static function respondSuccess($payload) {
        echo ResponseService::success_response($payload);
    }

    public static function respondError($message, $code = 500) {
        echo ResponseService::error_response($message, $code);
    }
}
