<?php
if ($_SESSION['role'] !== 'admin') {
    header('Location: ?c=home');
}
