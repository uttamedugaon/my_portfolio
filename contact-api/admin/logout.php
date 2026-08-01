<?php

session_start();

// Admin session delete
session_unset();

session_destroy();

// Login page par wapas bhejo
header("Location: login.php");

exit();

?>