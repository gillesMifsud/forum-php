<?php
session_start();
    // Unset du cookie
    setcookie('remember', NULL, -1, "/");
    unset($_SESSION['auth']);
    $_SESSION['flash']['success'] = "Deconnexion réussie";
    header('Location:index.php?p=login');