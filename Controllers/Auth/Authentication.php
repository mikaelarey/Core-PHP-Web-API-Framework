<?php

namespace Controllers\Auth;

use Helpers\TokenHelper;
use Helpers\HttpRequest;
use Helpers\HttpResponse;
use Services\AuthService;

class Authentication {
    public function __construct() {
        $this->authService = new AuthService();
    }

    /**
     * @HttpMethod("POST")
     */
    public function Login($data) {
        $user = $this->authService->login($data);

        return (empty($user)) 
            ? HttpResponse::BadRequest()
            : HttpResponse::Ok($user);
    } 
}

?>