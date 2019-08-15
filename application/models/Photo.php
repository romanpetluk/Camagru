<?php


namespace application\models;

use application\core\Model;
use application\lib\Email;


class Photo extends Model {

    //const SHOW_BY_DEFAULT = 5;

    public function uploadImage($fileUpload) {
        if (isset($fileUpload)) {
            $errors = array();
            $fileName = $fileUpload['name'];
            $fileSize = $fileUpload['size'];
            $fileTmpName = $fileUpload['tmp_name'];

            $fileType = explode('.',  $fileName);
            $fileExt = strtolower(end($fileType));

            $availableExtensions = array('jpeg', 'jpg', 'png');
            if (!in_array($fileExt, $availableExtensions)){
                $errors[] = "Invalid file format";
            }
            if($fileSize >5242880) {
                $errors[] = 'file > 5 mb';
            }

            if (empty($errors)) {
                $fileNameNew = uniqid('', true). '.' . $fileExt;
                $targetDir = 'public/images/gallery/' . $fileNameNew;

                $params = [
                    'image_id' =>null,
                    'user_id' => $_SESSION['account']['user_id'],
                    'path' => '/' . $targetDir,
                ];
                $this->db->query('INSERT INTO gallery VALUES (:image_id, :user_id, NOW(), :path)', $params);
                move_uploaded_file($fileTmpName, $targetDir);
                echo 'success';
            } else {
                foreach ($errors as $val) {
                    echo $val;
                }
            }
        }
    }

    public function getLatestPhoto($page = 1) {

        $offset = ($page - 1) * 5;

        $sql = 'SELECT * FROM gallery ORDER BY creation_date DESC LIMIT 5 OFFSET ' . $offset;

//        return $this->db->row($sql);
        $photo = $this->db->row($sql);
        $photo = $this->getCountLike($photo);
        $photo = $this->getComments($photo);
        return($photo);
    }

//    public function displayGallery() {
    public function getPhotoThisUser() {

        $params = [
            'user_id' => $_SESSION['account']['user_id'],
        ];
        return $this->db->row('SELECT * FROM `gallery` WHERE user_id = :user_id ORDER BY creation_date DESC', $params);

//        return $this->db->row("SELECT * FROM `gallery` ORDER BY `user_id`");
    }

    public function checkLike($imageId) {
        $params = [
            'image_id' => $imageId,
        ];
        $data = $this->db->row('SELECT `user_id` FROM `likes` WHERE image_id = :image_id', $params);
        foreach ($data as $val) {
            if ($val['user_id'] == $_SESSION['account']['user_id']) {
                return false;
            }
        }
        return true;
    }

    public function addLike($imageId) {
        $params = [
            'like_id' => null,
            'user_id' => $_SESSION['account']['user_id'],
            'image_id' => $imageId,
        ];
        $this->db->query('INSERT INTO `likes` VALUES (:like_id, :user_id, :image_id)', $params);
    }

    public function deleteLike($imageId) {
        $params = [
            'image_id' => $imageId,
        ];
        $data = $this->db->row('SELECT `user_id`, `like_id` FROM `likes` WHERE image_id = :image_id', $params);
        foreach ($data as $val) {
            if ($val['user_id'] == $_SESSION['account']['user_id']) {
                $params = [
                    'like_id' => $val['like_id'],
                ];
                $this->db->row("DELETE FROM `likes` WHERE like_id = :like_id", $params);
            }
        }
    }

    public function getCountLike($photo) {

        foreach ($photo as &$val) {
            $params = [
                'image_id' => $val['image_id'],
            ];
            $data = $this->db->column('SELECT COUNT(*) FROM `likes` WHERE image_id = :image_id', $params);
            $val['like'] = $data;
        }
        return $photo;
    }

    public function addComment($imageId, $comment) {
        $params = [
            'comment_id' => null,
            'image_id' => $imageId,
            'user_id' => $_SESSION['account']['user_id'],
            'login' => $_SESSION['account']['login'],
            'comment' => $comment,
        ];
        $this->db->query('INSERT INTO `comments` VALUES (:comment_id, :image_id, :user_id, :login, :comment)', $params);


        $sendMail = new Email();
        $sendMail->sendMail($_SESSION['account']['email'], 'Comment', 'New comment on your photo');

    }

    public function getComments($photo) {

        foreach ($photo as &$val) {
            $params = [
                'image_id' => $val['image_id'],
            ];
//            $sql = 'SELECT `comment` FROM `comments` ORDER BY comment_id DESC LIMIT 5';
//            $data = $this->db->row($sql);
//            $data = $this->db->row('SELECT `comment`, `login`, comment_id FROM `comments` WHERE image_id = :image_id', $params);
            $data = $this->db->row('SELECT * FROM `comments` WHERE image_id = :image_id', $params);

            $val['comment'] = $data;
        }
        return $photo;
    }

    public function deleteComment($commentId) {
        $params = [
            'comment_id' => $commentId,
        ];
        $this->db->query("DELETE FROM `comments` WHERE comment_id = :comment_id", $params);
    }

    //Remove likes and comments on the photo
    public function deletePhoto($path, $imageId) {
        $params = [

            'image_id' => $imageId,
        ];
        $this->db->row("DELETE FROM `likes` WHERE image_id = :image_id", $params);
        $this->db->row("DELETE FROM `comments` WHERE image_id = :image_id", $params);
        $params = [
            'path' => $path,
        ];
        $this->db->row("
 1= :path", $params);

        $path = trim($path, '/');
        if (file_exists($path)) {
            unlink($path);
        }
    }

}