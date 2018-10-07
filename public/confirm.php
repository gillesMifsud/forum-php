<?php
session_start();

require_once '../app/Autoloader.php';
App\Autoloader::register();

$user_id = $_GET['id'];
$token   = $_GET['token'];

// Charge les donnees user de la base
$user_id2 = App\Table\User::getTokenUser($user_id);

// Compare donnees chargees avec les $_GET
if($user_id2->CONFIRMATION_TOKEN == $token) {
    // Reset du CONFIRMATION_TOKEN et remplissage du champ CONFIRMED_AT
    $reset = App\Table\User::resetToken($user_id2->ID_USER);

    $_SESSION['auth'] = $user_id2->ID_USER;
    $_SESSION['flash']['success'] = 'Compte validé avec succès!';
    header('location:index.php?p=account');
} else {
    // Stocke messsages d'erreur (messages flash st stockés 1 page) en session
    $_SESSION['flash']['danger'] = 'Token plus valide';

    header('location:index.php?p=login');
}