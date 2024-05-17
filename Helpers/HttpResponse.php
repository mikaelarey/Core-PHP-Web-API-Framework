<?php

namespace Helpers;

class HttpResponse {

    public static function Ok($data = []) {
        http_response_code(200);
        header('Content-Type: application/json');

        if (!empty($data)) {
            echo json_encode($data);
        }

        exit;
    }

    public static function BadRequest($message = null) {
        $data = [
            'Code' => 400,
            'Status' => 'Bad Request',
            'Message' => empty($message) ? 'Unable to process your request' : $message
        ];
        
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function NotAllowed($message = null) {
        $data = [
            'Code' => 405,
            'Status' => 'Not Allowed',
            'Message' => empty($message) ? 'Method not allowed' : $message
        ];
        
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function NotFound($message = null) {
        $data = [
            'Code' => 404,
            'Status' => 'Page Not Found',
            'Message' => empty($message) ? 'The page that you are requesting was not found' : $message
        ];
        
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function Unauthorize($message = null) {
        $data = [
            'Code' => 401,
            'Status' => 'Unauthorize',
            'Message' => empty($message) ? 'Access Denied' : $message
        ];
        
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

?>