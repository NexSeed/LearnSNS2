<?php
$dsn = 'mysql:dbname=zeroproject;host=localhost';
$user = 'root';
$password='root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');