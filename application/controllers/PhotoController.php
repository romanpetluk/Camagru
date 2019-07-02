<?php


namespace application\controllers;

use application\core\Controller;

class PhotoController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    //Gallery

    public function galleryAction() {

//        $urlExplode = explode('/', $_SERVER["REDIRECT_URL"]);
//        $page = end($urlExplode);
//        $photo = $this->model->getLatestPhoto($page);

        var_dump($_POST);

        $photo = $this->model->getLatestPhoto();
        $photo = $this->model->getCountLike($photo);
        $photo = $this->model->getComments($photo);


        if (isset($_POST['comment'])) {
            if (!empty($_POST['comment'])) {
                $this->model->addComment($_POST['image_id'], $_POST['comment']);
            }
            unset($_POST['image_id']);
            unset($_POST['comment']);
        }

        if (!empty($_POST['image_id'])) {
            if (!empty($_SESSION['account'])) {
                if ($this->model->checkLike($_POST['image_id'])) {
                    $this->model->addLike($_POST['image_id']);
                } else {
                    $this->model->deleteLike($_POST['image_id']);
                }
            } else {
                $this->view->redirect('account/login');
            }
            unset($_POST['image_id']);
        }

        $vars = [
            'photo' => $photo,
        ];
//        debug($photo);
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

