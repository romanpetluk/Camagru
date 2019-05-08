<?php


namespace application\controllers;

use application\core\Controller;
use application\core\Model;


class MainController extends Controller
{

    public function indexAction() {

        $result = $this->model->getNews();
        $vars = [
            'news' => $result,
        ];

        $this->view->render('PAGE', $vars);
    }
}