<?php
if (AbstractController::getSession('user')) {
    header('LOCATION: ?c=home');
}
?>
<form method="post" action="?c=login" id="loginForm">
    <label for="mail">Adresse e-mail :</label>
    <br>
    <input type="email" name="mail" id="mail" required>
    <br>
    <label for="password">Password :</label>
    <br>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" name="send">
    <br>
    <a href="?c=forgot-password">Mot de passe oublié ?</a>
</form>
