<?php
// Create admin user (run once)
$hashed = password_hash("admin123", PASSWORD_DEFAULT);
echo $hashed;
?>
