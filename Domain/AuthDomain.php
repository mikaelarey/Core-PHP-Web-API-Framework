<?php

namespace Domain;

use Repository\Repositories\UserAccountRepository;

class AuthDomain {
    public function __construct() {
        $this->userAccountRepository = new UserAccountRepository();
    }

    public function login($username, $password) {
        $user = $this->userAccountRepository->login($username, $password);

        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');

        return empty($user) ? $user : [
            'id'           => $user->get_id(),
            'firstname'    => $user->get_firstname(),
            'middlename'   => $user->get_middlename(),
            'lastname'     => $user->get_lastname(),
            'username'     => $user->get_username(),
            'email'        => $user->get_email(),
            'user_role_id' => $user->get_user_role_id(),
            'login_date'   => $date
        ];
    }
} 

?>