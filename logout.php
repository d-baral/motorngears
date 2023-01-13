<?php
session_start();
unset($_SESSION['loginid']);
header('location:index.php');
?>