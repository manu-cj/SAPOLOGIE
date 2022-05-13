<?php
if (isset($_SESSION['role']['admin'])) {
    header('Location: ?c=home');
}
