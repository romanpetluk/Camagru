<?php


namespace application\models;

use application\core\Model;

class Photo extends Model {

//    const SHOW_BY_DEFAULT = 5;

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
//                move_uploaded_file($fileTmpName, $targetDir);
                echo 'ASD';
                move_uploaded_file($fileTmpName, $_SERVER['DOCUMENT_ROOT'] . '/' . $targetDir);
                echo 'success';
            } else {
                foreach ($errors as $val) {
                    echo $val;
                }
            }
        }
    }

//    public static function getLatestPhoto($count = self::SHOW_BY_DEFAULT) {
//        $count = intval($count);
//
//
//
//    }

    public function displayGallery() {

        return $this->db->row("SELECT * FROM `gallery` ORDER BY `user_id`");
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

    public function countLike($imageId) {
        $params = [
            'image_id' => $imageId,
        ];
        $data = $this->db->column('SELECT COUNT(*) FROM `likes` WHERE image_id = :image_id', $params);
        echo $data;
    }

    public function deletePhoto($path) {
        $params = [
            'path' => $path,
        ];
        $this->db->row("DELETE FROM `gallery` WHERE path = :path", $params);
        $path = trim($path, '/');
        if (file_exists($path)) {
            unlink($path);
        }
    }

}