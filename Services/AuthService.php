<?php

namespace Services;

use Domain\AuthDomain;
use Helpers\TokenHelper;

class AuthService {
    public function __construct() {
        $this->authDomain = new AuthDomain();
    }

    public function login($data) {
        if (!empty($data)) {
            $username = isset($data['username']) ? $data['username'] : null;
            $password = isset($data['password']) ? $data['password'] : null;

            if (!empty($username) && !empty($password)) {
                $user = $this->authDomain->login($username, $password);

                if (!empty($user)) {
                    $token = TokenHelper::GenerateToken($user);
                    return $this->buildLoginResponse('success', 'Login Successful.', $token);
                }

                return $this->buildLoginResponse('error', 'Username and password did not match.');
            }

            $this->buildLoginResponse('error', 'Username and password are both required');
        }

        return null;
    }

    private function buildLoginResponse($status, $message, $token = []) {
        return !empty($token) 
            ? [
                'status'  => 'success',
                'message' => 'Login Successful',
                'token'   => $token
            ] 
            : [
                'status'  => $status,
                'message' => $message
            ];
    }   
}

?>