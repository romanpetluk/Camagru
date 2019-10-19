<?php

namespace application\models;

use application\core\Model;
use application\lib\Email;


class Account extends Model {

    public function validate($input, $post ) {
        $rules = [
            'email' => [
                'pattern' => '#^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$#',
                'message' => 'invalid email',
            ],
            'login' => [
                'pattern' => '#^(?=.*[a-zA-Z])[\w]{3,15}$#',
                'message' => 'invalid login',
            ],
            'password' => [
                'pattern' => '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$#',
                'message' => 'invalid password',
            ],
        ];
        foreach ($input as $val) {
            if (!isset($post[$val]) || empty($post[$val]) || !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    public function checkEmailExists($email) {
        $params = [
            'email' => $email,
        ];
        return $this->db->column('SELECT user_id FROM accounts WHERE email = :email', $params);
    }

    public function checkLoginExists($login) {
        $params = [
            'login' => $login,
        ];
        return $this->db->column('SELECT user_id FROM accounts WHERE login = :login', $params);
    }

    public function createToken($Characters) {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 5)), 0 , $Characters);
    }

    public function checkTokenExists($token) {
        $params = [
            'token' => $token
        ];
        return $this->db->column('SELECT user_id FROM accounts WHERE token = :token', $params);
    }

//    public function send_mail($email, $headline, $text) {
//
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
//        $headers .= 'From: <romantest31@gmail.com>' . "\r\n";
//
//        mail($email, $headline, $text, $headers);
//    }
//
    public function activate($token) {
        $params = [
            'token' => $token,
        ];
//        $this->db->query('UPDATE accounts SET token = "" WHERE token = :token', $params);
        $this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
    }

    public function register($post) {
        $token = $this->createToken(30);
        $params = [
            'user_id' => null,
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'token' => $token,
            'notify' => 1,
            'status' => 0,
        ];
        $this->db->query('INSERT INTO accounts VALUES (:user_id, :email, :login, :password, :token, :notify, :status)', $params);

        Email::sendMail($post['email'], 'Register', 'Confirm: http://localhost:8200/account/confirm/' . $token);

    }

    public function checkData($login, $password) {
        $params = [
            'login' => $login,
        ];
        $hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
        if (!$hash or !password_verify($password, $hash)) {
            return false;
        }
        echo 'OK';
        return true;
    }

    public function checkStatus($type, $data ) {
        $params = [
            $type => $data,
        ];

        $status = $this->db->column('SELECT status FROM accounts WHERE '. $type .' = :'. $type, $params);
        if (!$status) {
            $this->error = 'account must be confirmed by email';
            return false;
        }
        return true;
    }

    public function login($login) {

        $params = [
          'login' => $login,
        ];
        $data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
        $_SESSION['account'] = $data[0];

    }

    public function recovery($post) {
        $token = $this->createToken(30);
        $params = [
            'email' => $post['email'],
            'token' => $token,
        ];
        $this->db->query('UPDATE accounts SET token = :token WHERE email = :email', $params);


        Email::sendMail($post['email'], 'Recovery', 'Confirm: http://localhost:8200/account/reset/' . $token);

    }

    public function reset($token) {
        $patern = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$#';
        do {
            $new_password = $this->createToken(8);
        } while (!preg_match($patern ,$new_password));

        $params = [
            'token' => $token,
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
        ];
        $this->db->query('UPDATE accounts SET status = 1, token = "", password = :password WHERE token = :token', $params);
//        $this->send_mail($post['email'], 'Recovery', 'Your new password: ' . $new_password);
        return $new_password;

    }

    public function save($post) {
        $params = [
            'user_id' => $_SESSION['account']['user_id'],
            'email' => $post['email'],
            'login' => $post['login'],
            'notify' => 0,
        ];
        if (isset($post['notify'])) {
            $params['notify'] = 1;
        }

        foreach($params as $key => $val) {
            $_SESSION['account'][$key] = $val;
        }

        if (!empty($post['password'])) {
            $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
            $sql = ', password = :password';
        } else {
            $sql = '';
        }

        $this->db->query('UPDATE accounts SET email = :email, login = :login, notify = :notify'. $sql .' WHERE user_id = :user_id', $params);

    }
}