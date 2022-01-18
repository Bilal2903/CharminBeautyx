<?php

session_start();

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}