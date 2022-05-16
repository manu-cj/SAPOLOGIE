<?php
if (!isset($_SESSION['mail'])) {
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header('Location: ' . $referer);
}
?>

<form method="post" action="?c=reset-password">
    <label for="newPassword">Nouveau Mot de passe :</label>
    <br>
    <input type="password" name="newPassword" id="newPassword" required>
    <br>
    <label for="password-repeat">Repetez le nouveau mot de passe :</label>
    <br>
    <input type="password" name="password-repeat" id="password-repeat" required>
    <br>
    <input type="submit" name="changePassword" value="Confirmer" required>
</form>

