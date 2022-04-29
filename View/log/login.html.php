<?php
if ( AbstractController::getSession('user')) {
    header('LOCATION: ?c=home');
}
?>
<form method="post" action="?c=login" id="login">
    <table>
        <tr>
            <td><label for="mail">Adresse e-mail :</label></td>
            <td><input type="email" name="mail" id="mail" required></td>
        </tr>
        <tr>
            <td><label for="password">Password :</label></td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="send"></td>
        </tr>
    </table>
</form>
