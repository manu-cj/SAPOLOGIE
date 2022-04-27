<?php


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog</title>
</head>

<div class="menu">
    <nav>
        <a href="?c=home">Acceuil</a>
        <a href="?c=profil">Profil</a>
        <a href="?c=login">Se connecter</a>
        <a href="?c=register">S'inscrire</a>
    </nav>

</div>

<?php
$page = isset($_GET['c']) ? Routeur::secureUrl($_GET['c']) : 'home';
$action = isset($_GET['a']) ? Routeur::secureUrl($_GET['a']) : 'index';


switch ($page) {
    case 'home':
        Routeur::route('HomeController', $action);
        break;
    case 'profil':
        Routeur::route('UserController', $action);
        break;
    case 'login':
        Routeur::route('LoginController', $action);
        break;
    case 'register':
        Routeur::route('RegisterController', $action);
        break;
    default:
        ErrorController::error404($page);
}


?>

<div class="footer">

</div>


<script src="assets/js/app.js"></script>
</body>
</html>