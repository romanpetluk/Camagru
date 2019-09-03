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
        $photo = $this->model->getLatestPhoto(1);
        //$frame = $this->model->getLatestPhoto(1)
        if (isset($_POST['delete'])) {

            if (!empty($_POST['delete'])) {
                $this->model->deleteComment($_POST['delete']);
            }
            unset($_POST['delete']);
        }

        if (isset($_POST['comment'])) {
            if (!empty($_SESSION['account'])) {
                if (!empty($_POST['comment'])) {
                    $this->model->addComment($_POST['image_id'], $_POST['comment']);
                }
                unset($_POST['image_id']);
                unset($_POST['comment']);
            } else {
                $this->view->redirect('account/login');
            }
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
        $this->view->render('gallery', $vars);
    }

    public function selfieAction() {
        if (!empty($_FILES['image']['name'])) {
            $this->model->uploadImage($_FILES['image']);
            unset($_FILES['image']);
        }

        if (!empty($_POST['filter'])) {
//            debug($_POST['filter']);
            echo $_POST['filter'];
        }

        $photo = $this->model->getPhotoThisUser();
        $vars = [
            'photo' => $photo,
        ];

        var_dump($_POST);
        echo '<br>';
        var_dump($_FILES);

        if (!empty($_POST['path'])) {
            $this->model->deletePhoto($_POST['path'], $_POST['imageId']);
            unset($_POST['path']);
            unset($_POST['imageId']);
        }

        $this->view->render('selfie', $vars);
    }
}

