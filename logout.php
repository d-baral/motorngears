<?php
session_start();
    $_SESSION['loginid']=NULL;
    header('location:index.php');
?>