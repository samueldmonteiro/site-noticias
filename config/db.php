<?php

$host = "localhost";
$dbName = "news";
$user = "qwerty";
$password = "t00rt00r";


try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbName",$user, $password);  
}catch(PDOException $e){
    echo $e->getMessage();
}
