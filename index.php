<?php

/*=============================================
Mostrar errores
=============================================*/

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "C:/xampp/htdocs/credifarma/php_error_log");

/*=============================================
CORS
=============================================*/

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

/*=============================================
Requerimientos
=============================================*/

require_once "controllers/template.controller.php";

$index = new TemplateController();
$index->index();