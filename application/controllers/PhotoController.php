<?php


namespace application\controllers;

use application\core\Controller;

class PhotoController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    public function galleryAction() {

        $this->model->displayGallery();

//        if (!empty($_POST)) {
//            var_dump($_POST);
//            $this->model->deletePhoto($_POST['path']);
//        }

        $this->view->render('gallery');
    }

    public function selfieAction() {
        if (!empty($_FILES['image']['name'])) {
            //var_dump($_FILES['image']);
            $this->model->uploadImage($_FILES['image']);
            unset($_FILES['image']);
        }



        $this->view->render('selfie');
    }
}

