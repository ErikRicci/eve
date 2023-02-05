<?php

use Game\Controllers\CharacterController;
use R2SSimpleRouter\Managers\RouteManager;

ini_set('display_errors', 1);
set_error_handler(function (\Throwable $e) { \R2SSimpleRouter\Response::error(message: $e->getMessage()); });
set_exception_handler(function (\Throwable $e) { \R2SSimpleRouter\Response::error(message: $e->getMessage()); });

require_once(__DIR__.'/vendor/autoload.php');

new RouteManager(include 'routes.php');
