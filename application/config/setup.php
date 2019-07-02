<?php

use application\lib\Db;


$dbh = new Db();
$dbh->query('CREATE DATABASE IF NOT EXISTS ' . 'camagru'. '; USE camagru');

$sql = "CREATE TABLE IF NOT EXISTS `accounts` (
        `user_id` INT AUTO_INCREMENT,
        `email` VARCHAR(254) NOT NULL,
        `login` VARCHAR(8) NOT NULL,
        `password` VARCHAR(256) NOT NULL,
        `token` VARCHAR(30) NOT NULL,
        `status` INT(1) NOT NULL,
        PRIMARY KEY (`user_id`));
                     
        CREATE TABLE IF NOT EXISTS `gallery` (
        `image_id` INT AUTO_INCREMENT,
        `user_id` INT NOT NULL,
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
$dbh->query($sql);

//$dbh->query("INSERT INTO accounts VALUES  (null, 'email', 'login', '311331', 0)");



//CREATE TABLE IF NOT EXISTS accounts (
//    `user_id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                                `email` VARCHAR(50) NOT NULL,
//                                `login` VARCHAR(30) NOT NULL,
//                                `password` VARCHAR(200) NOT NULL,
//                                `token` VARCHAR(30) NOT NULL,
//                                `status` INT(1) NOT NULL

//class Setup {
//
//}
//
//function createDb($dbname) {
//
//    try {
//        $db = new Db();
//        $db->query("CREATE DATABASE IF NOT EXISTS " . $dbname . "; USE camagru");
//    } catch (PDOException $e) {
//        die("DB ERROR: ". $e->getMessage());
//    }
//}
//
//function createTable() {
//
//    try {
//        $db = new Db();
//        $sql = "CREATE TABLE IF NOT EXISTS accounts (
//			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//			email VARCHAR(50) NOT NULL,
//			login VARCHAR(30) NOT NULL,
//			password VARCHAR(200) NOT NULL,
//			confirmed INT(1) NOT NULL
//			)";
//        $db->query($sql);
//    } catch (PDOException $e) {
//        die("DB ERROR: ". $e->getMessage());
//    }
//
//}


//$sql = "INSERT INTO accounts VALUES (NULL, 'dedi2006@ukr.net', 'roma', '311331', '0')";
//$db->query($sql);




/*
 * public static function createDb() {
       try {
           self::setConfig();
           self::$dbh = new PDO('mysql:host='.self::$config['host'], self::$config['username'],
               self::$config['password'], self::$config['options']);
           self::$dbh->exec("CREATE DATABASE IF NOT EXISTS ".self::$config['dbname'].";")
           or die(print_r(self::$dbh->errorInfo(), true));

       } catch (PDOException $e) {
           die("DB ERROR: ". $e->getMessage());
       }
       self::$dbh = null;
   }
/*
public static function fillDb() {
       try {
           self::$dbh->query("CREATE TABLE IF NOT EXISTS `users` (
                               `user_id` INT AUTO_INCREMENT,
                               `email` VARCHAR(254) NOT NULL,
                               `username` VARCHAR(8) NOT NULL,
                               `password` VARCHAR(256) NOT NULL,
                               `confirmed` INT NOT NULL,
                               PRIMARY KEY (`user_id`));

                               CREATE TABLE IF NOT EXISTS `gallery` (
                               `image_id` INT AUTO_INCREMENT,
                               `user_id` INT NOT NULL,
                               `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               `path` VARCHAR(256) NOT NULL,
                               PRIMARY KEY (`image_id`),
                               FOREIGN KEY (`user_id`) REFERENCES users(`user_id`));

                               CREATE TABLE IF NOT EXISTS `likes` (
                               `like_id` INT AUTO_INCREMENT,
                               `user_id` INT NOT NULL,
                               `image_id` INT NOT NULL,
                               PRIMARY KEY (`like_id`),
                               FOREIGN KEY (`user_id`) REFERENCES users(`user_id`),
                               FOREIGN KEY (`image_id`) REFERENCES gallery(`image_id`));
                               ");

       } catch (PDOException $e) {
           die("DB ERROR: ". $e->getMessage());
       }
       self::$dbh = null;
   }
public static function query($sql, $params = []) {
       $statement = self::$dbh->prepare($sql);
       if (!empty($params)) {
           foreach ($params as $key => $value) {
               $statement->bindValue(':'.$key, $value);
           }
       }
       $statement->execute();
       self::$dbh = null;
       return $statement;
   }

   public static function getRow($sql, $params = []) {
       $result = self::query($sql, $params);
       self::$dbh = null;
       return $result->fetchAll(PDO::FETCH_ASSOC);
   }

   public static function getColumn($sql, $params = []) {
       $result = self::query($sql, $params);
       self::$dbh = null;
       return $result->fetchColumn();
   }
prepare, execute, bindvalue

 */



// PDO :: ERRMODE_EXCEPTION //pdf
































/*
 * public static function createDb() {
       try {
           self::setConfig();
           self::$dbh = new PDO('mysql:host='.self::$config['host'], self::$config['username'],
               self::$config['password'], self::$config['options']);
           self::$dbh->exec("CREATE DATABASE IF NOT EXISTS ".self::$config['dbname'].";")
           or die(print_r(self::$dbh->errorInfo(), true));

       } catch (PDOException $e) {
           die("DB ERROR: ". $e->getMessage());
       }
       self::$dbh = null;
   }

public static function fillDb() {
       try {
           self::$dbh->query("CREATE TABLE IF NOT EXISTS `users` (
                               `user_id` INT AUTO_INCREMENT,
                               `email` VARCHAR(254) NOT NULL,
                               `username` VARCHAR(8) NOT NULL,
                               `password` VARCHAR(256) NOT NULL,
                               `confirmed` INT NOT NULL,
                               PRIMARY KEY (`user_id`));

                               CREATE TABLE IF NOT EXISTS `gallery` (
                               `image_id` INT AUTO_INCREMENT,
                               `user_id` INT NOT NULL,
                               `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               `path` VARCHAR(256) NOT NULL,
                               PRIMARY KEY (`image_id`),
                               FOREIGN KEY (`user_id`) REFERENCES users(`user_id`));

                               CREATE TABLE IF NOT EXISTS `likes` (
                               `like_id` INT AUTO_INCREMENT,
                               `user_id` INT NOT NULL,
                               `image_id` INT NOT NULL,
                               PRIMARY KEY (`like_id`),
                               FOREIGN KEY (`user_id`) REFERENCES users(`user_id`),
                               FOREIGN KEY (`image_id`) REFERENCES gallery(`image_id`));
                               ");

       } catch (PDOException $e) {
           die("DB ERROR: ". $e->getMessage());
       }
       self::$dbh = null;
   }
public static function query($sql, $params = []) {
       $statement = self::$dbh->prepare($sql);
       if (!empty($params)) {
           foreach ($params as $key => $value) {
               $statement->bindValue(':'.$key, $value);
           }
       }
       $statement->execute();
       self::$dbh = null;
       return $statement;
   }

   public static function getRow($sql, $params = []) {
       $result = self::query($sql, $params);
       self::$dbh = null;
       return $result->fetchAll(PDO::FETCH_ASSOC);
   }

   public static function getColumn($sql, $params = []) {
       $result = self::query($sql, $params);
       self::$dbh = null;
       return $result->fetchColumn();
   }
prepare, execute, bindvalue

 */



// PDO :: ERRMODE_EXCEPTION //pdf