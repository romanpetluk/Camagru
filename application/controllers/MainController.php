<?php


namespace application\controllers;

use application\core\Controller;
use application\core\Model;


class MainController extends Controller
{

    public function indexAction() {
        $this->view->render('indexActionPAGE');
    }

    public function aboutAction() {
        $this->view->render('aboutActionPAGE');
    }

    public function contactAction() {
        $this->view->render('contactActionPAGE');
    }

    public function postAction() {
        $this->view->render('postActionPAGE');
    }
}