<?php

session_start();

session_unset();

session_destroy();

// Redirect to the homepage (index.php)
header("Location: index.php");
exit();
?>
