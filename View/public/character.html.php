<?php

    $id = $_GET['id'];
    if (isset($_GET['id'])) {
        if ($_GET['id']=== '') {
            $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }




function getRandomName(string $regularName)
{
    $infos = pathinfo($regularName);
    try {
        $bytes = random_bytes(15);
    } catch (Exception $e) {
        $bytes = openssl_random_pseudo_bytes(15);
    }
    return bin2hex($bytes) . '.' . $infos['extension'];
}


if (isset($_FILES["characterImage"])) {
    $alert = [];
    $allowedMimeTypes = ['text/plain', 'image/jpeg', 'image/png'];
    if (in_array($_FILES["characterImage"]['type'], $allowedMimeTypes)) {
        if ($_FILES["characterImage"]['error'] === 0) {
            $tmp_name = $_FILES["characterImage"]["tmp_name"];

            $name = getRandomName($_FILES["characterImage"]["name"]);
            if (!is_dir('uploads')) {
                mkdir('uploads', '0755');
            }
            move_uploaded_file($tmp_name, 'uploads/' . $name);

            echo '<p class="alert-succes" style="font-size: 1em; width: 100%">upload réussi !</p><br>';
            $_SESSION['picture'] = $name;

        } else {
            echo '<p class="alert-error" style="font-size: 1em; width: 100%">Une erreur s\'est produite lors de l\'upload du fichier!</p>';
        }
    } else {
        echo '<br><p class="alert-error" style="font-size: 1em; width: 100%">le type du fichier n\'est pas autorisé !</p>';

    }
}

