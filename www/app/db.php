<?php
$host = 'db';
$db = 'schedule';
$user = 'myuser';
$pass = '12345678';
$charset = 'utf8';

$dsn = "pgsql:host=$host;dbname=$db;";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
?>