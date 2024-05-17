<?php

namespace Helpers;

/**
 * Custom annotation class to store HTTP request method information.
 */
class HttpMethod {
    private $method;

    public function __construct($method) {
        $this->method = strtoupper($method);
    }

    public function getMethod() {
        return $this->method;
    }
}
?>