<?php


namespace application\controllers;

use application\core\Controller;

class PhotoController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    public function galleryAction() {

        $photo = $this->model->displayGallery();

//        var_dump($photo);
        $vars = [
            'photo' => $photo,
        ];

        if (!empty($_POST['image_id'])) {
            $this->model->countLike($_POST['image_id']);
            if ($this->model->checkLike($_POST['image_id'])) {
                $this->model->addLike($_POST['image_id']);
            } else {
                $this->model->deleteLike($_POST['image_id']);
            }
            unset($_POST['image_id']);
        }


        $this->view->render('gallery', $vars);
    }

    public function selfieAction() {
        if (!empty($_FILES['image']['name'])) {
            $this->model->uploadImage($_FILES['image']);
            unset($_FILES['image']);
        }

        $photo = $this->model->displayGallery();
        $vars = [
            'photo' => $photo,
        ];

        if (!empty($_POST['path'])) {
            $this->model->deletePhoto($_POST['path']);
            unset($_POST['path']);
        }

        $this->view->render('selfie', $vars);
    }
}

