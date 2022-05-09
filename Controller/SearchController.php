<?php


class SearchController extends AbstractController
{

    public function index()
    {
        $this->render('public/search');
        if (isset($_POST['search'])) {
            header("Location:?c=search&result=".$_POST['searchBar']."");
        }
        if (isset($_GET['result'])) {
            if ($_GET['result'] !== '') {
                $result = htmlentities($_GET['result']);
                CharacterManager::getNameCharacter($result);
            }
            else {
                echo '<p class="alert error">Vous n\'avez pas rempli le champs recherche !</p>';
            }
        }
    }
}