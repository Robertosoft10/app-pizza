<?php
session_start();
session_destroy();
header('location: /../app-pizza/Admin/index.php');
?>
