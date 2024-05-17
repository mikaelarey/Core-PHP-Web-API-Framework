<?php

namespace Controllers\Admin;

use Helpers\HttpRequest;
use Helpers\HttpResponse;

class User {

    /**
     * @HttpMethod("POST")
     */
    public function Create($data) {
        return HttpResponse::Ok($data);
    }

    /**
     * @HttpMethod("GET")
     */
    public function GetById($data) {
        return HttpResponse::Ok($data);
    }

    /**
     * @HttpMethod("GET")
     */
    public function GetAll() {
        return HttpResponse::Ok('Get all users');
    }

    /**
     * @HttpMethod("PUT")
     */
    public function Update($data) {
        return HttpResponse::Ok($data);
    }

    /**
     * @HttpMethod("DELETE")
     */
    public function Delete($data) {
        return HttpResponse::Ok($data);
    }
}

?>