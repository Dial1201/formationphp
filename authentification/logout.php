<?php 
require_once("../functions.php");

session_start(); //to ensure you are using same session
session_destroy(); //destroy the session

redirection("../index.php");
?>