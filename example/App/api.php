<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api
 *
 * @author Tarek.Chida
 */
require_once __DIR__ . '/../vendor/autoload.php';

//Define api constants
define('CONTROLLERS_PATH', 'App\\Controllers');
define("API_NOT_FOUND", 404);
define("API_SUCCESS", 200);
define("API_ERROR", 500);
define("API_ALREADY_EXISTS", 409);


//Error and exceptions handles
error_reporting(E_ALL);
set_error_handler('Lib\Error::errorHandler');
set_exception_handler('Lib\Error::exceptionHandler');



// Routes 
$router = new Lib\Router();

include __DIR__ . '/../App/routes.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
