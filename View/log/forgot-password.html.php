<?php

?>
<form method="post" action="?c=forgot-password&verification">
    <label for="mail">Saisissez l'adrese e-mail de votre compte :</label>
    <br>
    <input type="mail" name="mail" placeholder="Veuillez entrer votre adresse e-mail" required>
    <br>
    <label for="captcha">Entrer le texte du captcha :</label><br>
    <br>
    <input name="captcha" type="text" id="captcha" placeholder="Entrer le captcha ci-dessous" required><br>
    <br>
    <label for="captchaImg">Captcha :</label><br>
    <br>
    <img src="/assets/captcha/captcha.php" alt="captcha de vérification"/>
    <br>

    <input type="submit" name="forgot-password">

</form>
