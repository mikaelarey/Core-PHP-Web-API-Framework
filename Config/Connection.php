<?php

namespace Config;

class Connection 
{
    public $isDevMode = true;
    private $driver   = 'pdo_mysql';
    private $user     = 'root';            
    private $password = '';              
    private $dbname   = 'document_management';   
    private $host     = 'localhost';

    public function __construct() {
        $this->conn = [
            'driver'   => $this->driver,
            'user'     => $this->user,
            'password' => $this->password,
            'dbname'   => $this->dbname,
            'host'     => $this->host
        ];
    }
}

?>