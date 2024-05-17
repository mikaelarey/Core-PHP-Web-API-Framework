<?php

require_once 'vendor/autoload.php';

spl_autoload_register(function($class) {
	$file = str_replace('\\', '/', $class) . '.php';
	if(is_readable($file)) {
		require $file;
	}
});

use Helpers\HttpResponse;
use Helpers\TokenHelper;

function RemoveEmptyStrings($value) {
    return $value !== "";
}

function GetPayload() {
    $payload = file_get_contents('php://input');
    return json_decode($payload, true);
}

function GetToken() {
    $headers = apache_request_headers(); // Retrieve all HTTP request headers
    
    // Check if the Authorization header exists
    if (isset($headers['Authorization'])) {
        $authorizationHeader = $headers['Authorization'];

        // Check if the Authorization header starts with "Bearer"
        if (preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            return $matches[1]; // Return the bearer token
        }
    }
    
    return null;
}

function GetEndPoints() {
    $uri = $_SERVER["REQUEST_URI"];
    $uri = explode('?', $uri);
    $resultArray = explode('/', $uri[0]);

    $resultArray = array_filter($resultArray, "RemoveEmptyStrings");
    $endpoints = [];

    foreach ($resultArray as $item) {
        array_push($endpoints, $item);
    }

    return $endpoints;
}

function GetParameters() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $parameters = [];
        foreach ($_GET as $key => $value) {
            $parameters[$key] = $value;
        }

        return $parameters;
    }
    
    return GetPayload();
    
}

function GetModule($endpoint) {
    $arrayCount = count($endpoint);
    $moduleCount = $arrayCount - 2;
    $module = '';

    foreach($endpoint as $item) {
        if ($moduleCount > 0) {
            $isValidEndpoint = !(empty($module) && empty($item)) && !(trim(strtolower($item)) == 'api');

            if ($isValidEndpoint) {
                $module = empty($module) ? $item : $module.'\\'.$item;
            }
        }

        $moduleCount--;
    }

    return $module;
}

function GetController($module, $endpoint) {
    $arrayCount = count($endpoint);

    if ($arrayCount < 2) {
        HttpResponse::NotFound('Unable to parse controller');
    }

    return 'Controllers\\'.$module.'\\'.$endpoint[$arrayCount - 2];
}

function GetAction($endpoint) {
    $arrayCount = count($endpoint);

    if ($arrayCount < 2) {
        HttpResponse::NotFound('Unable to parse action');
    }

    return $endpoint[$arrayCount - 1];
}

function ValidateRoute($token, $module) {
    if (empty($token) && !in_array($module, ['Auth', 'Data'])) {
        HttpResponse::Unauthorize();
    } else {
        if (!empty($token)) {
            $decodedToken = TokenHelper::DecodeToken($token);
            $role = TokenHelper::GetUserRoleId($decodedToken);
            $hasAccessToModule = TokenHelper::IsValidAccessRights($role, $module);
    
            if (!$hasAccessToModule) {
                HttpResponse::Unauthorize('No access to this module');
            }
        }  
    }
}

function RedirectToRoute($controller, $action, $parameters) {
    if (class_exists($controller)) {
        $object = new $controller();
    
        if (method_exists($object, $action)) {
            $reflectionMethod = new ReflectionMethod($object, $action);
            $annotations = getMethodAnnotations($reflectionMethod);
            $isValidRequestMethod = in_array($_SERVER['REQUEST_METHOD'], $annotations);

            if (!$isValidRequestMethod) {
                return HttpResponse::NotAllowed();
            }

            if (empty($parameters)) {
                $object->$action();
            } else {
                $object->$action($parameters);
            }
        } else {
            return HttpResponse::NotFound();
        }
        
    } else {
        return HttpResponse::NotFound();
    }
}

function DecodeToken($token) {
    $decodedToken = TokenHelper::DecodeToken($token);
}

function getMethodAnnotations($reflectionMethod) {
    $docComment = $reflectionMethod->getDocComment();
    preg_match_all('/@HttpMethod\("(\w+)"\)/', $docComment, $matches);
    return array_map('strtoupper', $matches[1]);
}

?>