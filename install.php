<?php

$db = Db::getConnection();

$sql = "CREATE DATABASE IF NOT EXISTS camagru; USE camagru";
$db->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS user (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			login VARCHAR(30) NOT NULL,
			password VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
			status INT(1) NOT NULL
			)";
$db->query($sql);
//$sql = "INSERT INTO user VALUES (NULL, 'roma', '3113', 'dedi2006@ukr.net', '1')";
//$db->query($sql);



//try {
//
//    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $sql = "CCREATE DATABASE IF NOT EXISTS camagru";
////    $sqlTabl = "CREATE TABLE IF NOT EXISTS users (
////			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
////			login VARCHAR(30) NOT NULL,
////			password VARCHAR(30) NOT NULL,
////			status INT(1) NOT NULL
////			)";
//    // use exec() because no results are returned
//    $db->query($sql);
//    echo "Database created successfully<br>";
//}
//catch(PDOException $e)
//{
//    echo $sql . "<br>" . $e->getMessage();
//    echo 'ASD';
//}
//
//$conn = null;

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