<?php


namespace application\controllers;

use application\core\Controller;
use application\core\View;

class PhotoController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    //Gallery

    public function galleryAction() {

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

        $page = $this->model->pagination();
        $photo = $this->model->getPhoto(1);
        $vars = [
            'photo' => $photo,
            'page' => $page,
        ];
        $this->view->render('gallery', $vars);
    }

    //Selfie
    public function selfieAction() {
        if (!empty($_FILES['image']['name'])) {
            $this->model->uploadImage($_FILES['image']);
            unset($_FILES['image']);
        }

        if (!empty($_POST['path'])) {
            $this->model->deletePhoto($_POST['path'], $_POST['imageId']);
            unset($_POST['path']);
            unset($_POST['imageId']);
        }

        if(!empty($_POST['img'])) {
            $img = str_replace(' ', '+', $_POST['img']);
            $img = base64_decode($img);
            $fileNameNew = uniqid('', true). '.' . 'png';
            file_put_contents('public/images/gallery/'. $fileNameNew, $img);
            imagedestroy($img);

            $this->model->applySticker('public/images/gallery/'. $fileNameNew, $_POST['value']);
        }

        $photo = $this->model->getPhotoThisUser();
        $vars = [
            'photo' => $photo,
        ];
        $this->view->render('selfie', $vars);

    }
}

