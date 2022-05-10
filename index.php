<?php

use App\Controller\ErrorController\ErrorController;

session_start();
require __DIR__ . '/require.php';

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/media/4887179.png">
    <title>W.O.S</title>
</head>
<body>
<header>
    <div class="menu">
        <div id="logo"><a href="?c=home">W.O.S</a></div>
        <div id="searchBar">
            <form action="?c=search" method="post">
                <input type="text" value="" name="searchBar" placeholder="recherche"/>
                <input type="submit" name="search" value="🔎"/>
            </form>
        </div>
        <div class="homeProfil">
            <div class="home">
                <a href="?c=home" title="Accueil"><i class="fas fa-home"></i></a>
            </div>
            <?php
            if (!AbstractController::getSession('user')) {
                ?>
                <a href="?c=login" id="login">Se connecter</a>
                <a href="?c=register" id="register">S'inscrire</a>
                <?php
            }
            ?>
            <?php
            if (AbstractController::getSession('user')) {
            ?>
            <div class="profil">
                <ul><i class="fas fa-user-alt" title="menu"></i></ul>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="profilMenu">
        <div id="profil">
            <nav>
                <ul>
                    <li><a href="?c=profil&id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
                    <?php
                    if (AbstractController::getRole('admin')) {
                        ?>
                        <li><a href="?c=espace-admin">Espace-Admin</a></li>
                        <?php
                    }
                    ?>
                    <li><a href="?c=logout">Se déconnecter</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<?php
if (isset($_SESSION['alert']) && count($_SESSION['alert']) > 0) {
    $errors = $_SESSION['alert'];
    unset($_SESSION['alert']);
    foreach ($errors as $error) { ?>
        <div class="alert alert-error"><?= $error ?></div> <?php
    }
}

$page = isset($_GET['c']) ? Routeur::secureUrl($_GET['c']) : 'home';
$action = isset($_GET['a']) ? Routeur::secureUrl($_GET['a']) : 'index';

switch ($page) {
    case 'home':
        Routeur::route('HomeController', $action);
        break;
    case 'profil':
        Routeur::route('UserController', $action);
        break;
    case 'search':
        Routeur::route('SearchController', $action);
        break;
    case 'character':
        Routeur::route('CharacterController', $action);
        break;
    case 'picture':
        Routeur::route('PictureController', $action);
        break;
    case 'login':
        Routeur::route('LoginController', $action);
        break;
    case 'register':
        Routeur::route('RegisterController', $action);
        break;
    case 'logout':
        Routeur::route('LogoutController', $action);
        break;
    case 'delete':
        Routeur::route('DeleteController', $action);
        break;
    case 'espace-admin':
        Routeur::route('AdminController', $action);
        break;
    default:
        ErrorController::error404($page);
}
?>
<footer>
    <div class="footerMenu"><a href="?c=contact" title="Contact">Contact</a></div>
</footer>

<script src="https://kit.fontawesome.com/d8438e7f2f.js" crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>
</body>
</html>