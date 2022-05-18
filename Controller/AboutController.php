<?php
class AboutController extends AbstractController
{

    public function index()
    {
        $this->render('public/about');
        if (!isset($_GET['a'])) {
            header('LOCATION: ?c=about&a=mention-legales');
        }
    }

    public function mention() {
        $this->render('public/mentionLegales');
    }

    public function politique() {
        $this->render('public/politique');
    }
}