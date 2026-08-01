<?php

session_start();

// Login check
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}


// Database connection
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "contact_db"
);


// Connection check
if ($conn->connect_error) {
    die("Database connection failed!");
}


// Delete message
if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $sql = "DELETE FROM contacts WHERE id = $id";

    $conn->query($sql);

}


// Dashboard par wapas
header("Location: dashboard.php");

exit();

?>