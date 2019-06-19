<?php


namespace application\models;

use application\core\Model;

class Photo extends Model {

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
                    'path' => '',
                ];
                $this->db->query('INSERT INTO gallery VALUES (:image_id, :user_id, NOW(), :path)', $params);
                $lastId = $this->db->lastInsertId();
                echo $lastId;
                move_uploaded_file($fileTmpName, $targetDir);
                echo 'success';
            } else {
                foreach ($errors as $val) {
                    echo $val;
                }
            }
        }
    }

    public function displayGallery() {

//        $params = [
//            'login' => $login,
//        ];

        $data = $this->db->row("SELECT * FROM `gallery` ORDER BY `user_id`");
        echo "<form action='/photo/gallery' method='post'";
        foreach ($data as $key => $val) {
            $image = '<img src="' . $val['path'] . '" width="" height="150">';
            $hidden = '<input type="hidden" name="path" value="' . $val['path'] . '">';
            $delete = '<input type="submit" name="delete" value="delete">';
            echo $image;
            echo $hidden;
            echo $delete;
        }
        echo "</form>";
    }

    public function deletePhoto($path) {
        $params = [
            'id' => $path,
        ];
        //echo $path;
        $this->db->row("DELETE FROM `gallery` WHERE id = :id", $params);
        unlink($path);
    }

}