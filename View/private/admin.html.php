<?php
if (!AbstractController::getRole('admin')) {
    header('Location: ?c=home');
}
