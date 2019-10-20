<?php

namespace application\lib;
use PDO;

class CreateDb
{
    protected $dbh;

    public function createDb(){
        $config = require 'config/database.php';
        try {
            $this->dbh = new PDO('mysql:host=' . $config['dns'] . ';dbname=' . '', $config['user'], $config['password']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }

        try {
            $this->dbh->query("CREATE DATABASE IF NOT EXISTS " . $config['dbname'] . '; USE ' . $config['dbname']);
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }

        try {
            $sql = "CREATE TABLE IF NOT EXISTS `accounts` (
                    `user_id` INT AUTO_INCREMENT,
                    `email` VARCHAR(254) NOT NULL,
                    `login` VARCHAR(30) NOT NULL,
                    `password` VARCHAR(256) NOT NULL,
                    `token` VARCHAR(30) NOT NULL,
                    `notify` INT(1) NOT NULL,
                    `status` INT(1) NOT NULL,
                    PRIMARY KEY (`user_id`));
                                 
                    CREATE TABLE IF NOT EXISTS `gallery` (
                    `image_id` INT AUTO_INCREMENT,
                    `user_id` INT NOT NULL,
                    `login` VARCHAR(30) NOT NULL,
                    `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `path` VARCHAR(256) NOT NULL,
                    PRIMARY KEY (`image_id`),
                    FOREIGN KEY (`user_id`) REFERENCES accounts(`user_id`));
                    
                    CREATE TABLE IF NOT EXISTS `likes` (
                    `like_id` INT AUTO_INCREMENT,
                    `user_id` INT NOT NULL,
                    `image_id` INT NOT NULL,
                    PRIMARY KEY (`like_id`),
                    FOREIGN KEY (`user_id`) REFERENCES accounts(`user_id`),
                    FOREIGN KEY (`image_id`) REFERENCES gallery(`image_id`));
                     
                    CREATE TABLE IF NOT EXISTS `comments` (
                    `comment_id` INT AUTO_INCREMENT,
                    `image_id` INT NOT NULL,
                    `user_id` INT NOT NULL,
                    `login` VARCHAR(8) NOT NULL,
                    `comment` TEXT NOT NULL,
                    PRIMARY KEY (`comment_id`),
                    FOREIGN KEY (`user_id`) REFERENCES accounts(`user_id`),
                    FOREIGN KEY (`image_id`) REFERENCES gallery(`image_id`));
         ";
            $this->dbh->query($sql);
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }

    public function dropDb() {
        $config = require 'config/database.php';
        try {
            $this->dbh = new PDO('mysql:host=' . $config['dns'] . ';dbname=' . '', $config['user'], $config['password']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->query('DROP DATABASE IF EXISTS ' . $config['dbname']);
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}