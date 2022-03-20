<?php
require "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createUnsafeImmutable("../");
$dotenv->load();

$database = getenv('DB_DATABASE');
$db_user = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');

$pdo = new PDO("mysql:dbname=$database;host=db", $db_user, $db_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version:' . $row['Value'];
