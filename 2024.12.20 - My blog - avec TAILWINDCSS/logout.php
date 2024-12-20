<?php


require_once "config.php";
require_once "functions.php";

session_start ();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
    header ("Location:login.php");
    exit;
    }
    else{
    session_regenerate_id();
}

session_destroy();

header ("Location: login.php");

exit;