<?php
require_once 'pdoconfig.php';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", "$username", "$password");
} catch (PDOException $e) {
    print $e->getMessage();
}