<?php
// Démarre la session dans le cas ou elle n est pas démarrée
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

header('content-type : text/html; charset="UTF-8"');
mb_internal_encoding("UTF-8");


// Front Controller
require '../app/Autoloader.php';
App\Autoloader::register();


if(isset($_GET['p'])) {
    $p = $_GET['p'];
    }
    else {
    $p = 'home';
    }



//plutot que de require les pages, on execute et stocke le resultat dans une variable
ob_start();
//tout ce qui suit est stocké dans une variable
    if($p === 'home') {
        require '../pages/home.php';
        }

        elseif($p === 'login') {
        require 'login.php';
        }

        elseif($p === 'logout') {
            require '../pages/logout.php';
        }

        elseif($p === 'register') {
        require 'register.php';
        }

        elseif($p === 'forum') {
        require '../pages/page_forum.php';
        }

        elseif($p === 'topic') {
        require '../pages/page_topic.php';
        }

        elseif($p === 'account') {
        require 'account.php';
        }

        elseif($p === 'confirm') {
            require 'confirm.php';
        }

        elseif($p === 'modif') {
            require 'modif_account.php';
        }

        elseif($p === 'forget') {
        require 'forget.php';
        }

        elseif($p === 'reset') {
        require 'reset.php';
        }

        elseif($p === 'newForum') {
        require 'newForum.php';
        }

        elseif(($p === 'reset') && (isset($_GET['id'])) && (isset($_GET['token']))){
        require '../pages/contr_reset.php';

    }
$content = ob_get_clean();

//require du layout ou se trouve $content
require '../pages/templates/default.php';

?>