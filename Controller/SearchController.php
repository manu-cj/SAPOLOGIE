<?php


class SearchController extends AbstractController
{

    public function index()
    {
        $this->render('public/search');
        if (isset($_POST['search'])) {
            header("Location:?c=search&result=".$_POST['user']."");
        }
        if (isset($_GET['result'])) {
            $result = htmlentities($_GET['result']);
            echo $result;

        }
    }
}