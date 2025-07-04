<?php

require_once(__DIR__ . '/../services/ResponseService.php');
require(__DIR__ . "/../connection/connection.php");


abstract class BaseController {

    protected function success($payload) {
        echo ResponseService::success_response($payload);
        exit;
    }

    protected function error($message) {
        echo ResponseService::error_response($message);
        exit;
    }

}