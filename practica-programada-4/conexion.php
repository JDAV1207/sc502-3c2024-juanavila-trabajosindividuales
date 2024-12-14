<?php
require "message_log.php";

$host = 'localhost';
$dbname = 'todo_app';
$user = 'root';
$password = 'test123';
$port = '3307';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$user,$password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    logDebug("DB Conexion Exitosa");

} catch (PDOException $e) {
    logError($e->getMessage());
    die('Error de conexion: ' . $e->getMessage());
}
