<?php

session_start();

// database include

/** @var mysqli $conn */
require_once "config/db.php";

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
} else
    echo "Test";
