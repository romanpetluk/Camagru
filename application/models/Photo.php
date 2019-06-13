<?php


namespace application\models;

use application\core\Model;

class Photo extends Model {

    private function getExtension($fileName) {

    }

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
            if($fileSize >2097152) {
                $errors[] = 'file > 2 mb';
            }

            if (empty($errors)) {
                $fileNameNew = uniqid('', true). '.' . $fileExt;
                $targetDir = 'public/images/' . $fileNameNew;

                $params = [
                    'image_id' =>null,
                    'user_id' => $_SESSION['account']['user_id'],
                    'path' => $targetDir,
                ];

                move_uploaded_file($fileTmpName, $targetDir);
                $this->db->query('INSERT INTO gallery VALUES (:image_id, :user_id, NOW(), :path)', $params);
                echo 'success';
            } else {
                foreach ($errors as $val) {
                    echo $val;
                }
            }
        }
    }



}