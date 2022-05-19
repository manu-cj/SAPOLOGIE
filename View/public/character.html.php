<?php

    $id = $_GET['id'];
    if (isset($_GET['id']) ) {
        if ($_GET['id']=== '' ) {
            $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }
    if (!isset($_GET['id'])) {
        $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
        if (count($alert) > 0) {
            $_SESSION['alert'] = $alert;
            header('LOCATION: ?c=home');
        }
    }


function checkImage($image) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $image);
        if (strpos($mtype, 'image/') === 0) {
            echo "C'est une image";


        }
        else {
            echo "C'est pas une image";
            header('LOCATION: ?c=home');
        }
        finfo_close($finfo);
}

//function to change the name of the image

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
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        if (in_array($_FILES["characterImage"]['type'], $allowedMimeTypes)) {
            if ($_FILES["characterImage"]['error'] === 0) {
                $tmp_name = $_FILES["characterImage"]["tmp_name"];
                $name = getRandomName($_FILES["characterImage"]["name"]);
                if (!is_dir('uploads')) {
                    mkdir('uploads', '0755');
                }
                move_uploaded_file($tmp_name, 'uploads/' . $name);
                $alert = '<p class="alert-succes" style="font-size: 1em; width: 100%">upload réussi !</p><br>';
                $_SESSION['picture'] = $name;

            } else {
                $alert[] = '<p class="alert-error" style="font-size: 1em; width: 100%">Une erreur s\'est produite lors de l\'upload du fichier!</p>';
            }
        } else {
            $alert[] = '<br><p class="alert-error" style="font-size: 1em; width: 100%">le type du fichier n\'est pas autorisé !</p>';
        }
    if (count($alert) > 0) {
        $_SESSION['alert'] = $alert;
        header('LOCATION: ?c=character&id='.$_GET['id']);
    }
}



