<?php
if (isset($_SESSION['user'])) {
    if ($_GET['id'] === $_SESSION['user']['id']) {
        ?>
        <a href="?c=profil&a=add-character&id=<?= $_SESSION['user']['id'] ?>" id="addCharacter">Ajouter un personnage</a>
        <?php
    }
}