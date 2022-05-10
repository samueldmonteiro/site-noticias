<?php

require_once("config/db.php");

$base = "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER["REQUEST_URI"].'?').'/';

if(!isset($_SESSION)){
    session_start();
}