<?php


namespace application\controllers;

use application\core\Controller;
use application\core\Model;


class MainController extends Controller
{

    public function indexAction() {
        $this->view->render('indexActionPAGE');
    }
}