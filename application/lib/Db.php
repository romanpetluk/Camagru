<?php

namespace application\lib;

use PDO;



class Db
{

    protected $db;

    public function __construct() {
        try {
            $config = require 'application/config/database.php';
            require_once 'application/config/setup.php';
            $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . '' . '', $config['user'], $config['password']);
            $this->db->query('USE ' . $config['dbname']);
        } catch (\PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
//                echo 'key = ';
//                var_dump($key);
//                echo '<br>';
//                echo 'val = ';
//                var_dump($val);
//                echo '<br>';
//                echo 'type = ';
//                var_dump($type);
//                echo '<br>';
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

}

//try {
//    self::setConfig();
//    self::$dbh = new PDO('mysql:host='.self::$config['host'], self::$config['username'],
//        self::$config['password'], self::$config['options']);
//    self::$dbh->exec("CREATE DATABASE IF NOT EXISTS ".self::$config['dbname'].";")
//    or die(print_r(self::$dbh->errorInfo(), true));
//
//} catch (PDOException $e) {
//    die("DB ERROR: ". $e->getMessage());
//}
//self::$dbh = null;