<?php

namespace Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\AuthConfig;

class TokenHelper extends AuthConfig {
    
    public static function GenerateToken($data) {
        return JWT::encode($data, parent::$secretKey, parent::$encriptionType);
    }

    public static function DecodeToken($token) {
        return JWT::decode($token, new Key(parent::$secretKey, parent::$encriptionType));
    }

    public static function IsValidAccessRights($role, $module) {
        return isset(parent::$accessRights[$role]) 
            ? (in_array($module, parent::$accessRights[$role])) : FALSE; 
    }

    public static function GetUserRoleId($data) {
        return isset($data->user_role_id)
            ? $data->user_role_id : '';
    }
}

?>