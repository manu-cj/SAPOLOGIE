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
    default:
        ErrorController::error404($page);
}


?>

<div class="footer">

</div>


<script src="assets/js/app.js"></script>
</body>
</html>