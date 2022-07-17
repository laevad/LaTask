<?php
ob_start(); 
session_start(); 
$public_end = 0; // project folder should be LaTask
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WEB", $doc_root);
var_dump(WEB);
require_once('query_function.php');
require_once('validation_functions.php');
require_once 'functions.php';
require_once 'database.php';
require_once 'auth_functions.php';
$db = db_connect();
$errors = [];