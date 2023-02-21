<?php

use MyApp\classes\Product;

require_once('./vendor/autoload.php');
include_once('db_credentials.php');
include_once('helper_functions.php');

// DB Connection
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Set the database for the classes
Product::set_database($database);

?>