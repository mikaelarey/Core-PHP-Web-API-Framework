<?php

namespace Config;

class AuthConfig {
    // Key value pair of the user role and list of modules that they have access
    protected static $accessRights = [
        1 => ['Admin'],
        2 => ['Associate'],
        3 => ['Approver'],
        4 => ['Student']
    ];

    protected static $secretKey = 'SSOANANDA12551KLJ21254568ERAS';
    protected static $encriptionType = 'HS256';
}

?>