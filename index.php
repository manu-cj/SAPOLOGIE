<?php
use App\Controller\ErrorController\ErrorController;

session_start();

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
<div class="menu">
    <nav>
        <a href="?c=home">W.O.S</a>
        <form action="?c=search" method="post">
            <input type="text" value="" name="user" placeholder="recherche"/>
            <input type="submit" name="search" value="🔎"/>
        </form>
        <a href="?c=login">Se connecter</a>
        <a href="?c=register">S'inscrire</a>
        <a href="?c=profil">Profil</a>
        <h3 style="color: red">Faire une page contact</h3>
    </nav>

</div>

<?php
require __DIR__. '/require.php';

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