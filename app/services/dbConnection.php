<?php
    require_once __DIR__.'/../models/connection.php';

    $connection = new Connection();

    $db = $connection->connect();
?>