<?php

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dataBase = 'users';
    try {
        $conn = new PDO('mysql:host=' . $serverName . '; dbname=' . $dataBase, $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e;
    }

?>