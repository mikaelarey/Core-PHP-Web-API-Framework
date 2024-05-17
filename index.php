<?php

require_once 'autoload.php';

$endpoint = GetEndPoints();
$module = GetModule($endpoint);
$controller = GetController($module, $endpoint);
$action = GetAction($endpoint);
$parameters = GetParameters();
$token = GetToken();

ValidateRoute($token, $module);
RedirectToRoute($controller, $action, $parameters);

?>