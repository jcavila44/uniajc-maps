<?php

$controllerFile  = ucwords(strtolower("Controllers/" . $controller . ".php"));
if (file_exists($controllerFile)) {
    require_once($controllerFile);
    $controller = new $controller();
    if (method_exists($controller, $method)) {
        $controller->{$method}($params);
    } else {
        require_once('Controllers/error.php');
    }
} else {
    require_once('Controllers/error.php');
}
