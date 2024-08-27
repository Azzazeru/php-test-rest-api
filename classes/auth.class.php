<?php

require_once '../database/connection/connection.php';
require_once 'responses.class.php';

class auth extends connection
{

    private $token = '';

    public function signIn($reqbody)
    {
        $_responses = new responses;
        $data = json_decode($reqbody, true);
        if (!isset($data['username']) || !isset($data['password'])) {
            return $_responses->error_400();
        } else {
            $username = $data['username'];
            $password = $data['password'];
            $data = $this->getUserData($username);
            if ($data) {
                if ($password == $data[0]['password']) {
                    $verify = $this->createSession($data[0]['user_id']);
                    if ($verify) {
                        $result = $_responses->response_200();
                        $result["result"] = array(
                            "token" => $verify,
                        );
                        return $result;
                    } else {
                        return $_responses->error_500("Interal error");
                    }
                } else {
                    return $_responses->error_401("Invalid Credentials");
                }
            } else {
                return $_responses->error_500();
            }
        }
    }

    private function getUserData($username)
    {
        $_responses = new responses;
        $query = "SELECT * FROM users WHERE username = '$username'";
        $data = parent::getData($query);
        if (isset($data[0]['user_id'])) {
            return $data;
        } else {
            return $_responses->error_500("The user $username not exists");
        }
    }

    private function createSession($user_id)
    {
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");
        $query = "INSERT INTO user_session (user_id, token, status, date) VALUES ('$user_id', '$token', 1, '$date')";
        $verify = parent::nonQuery($query);
        if ($verify) {
            return $token;
        } else {
            return false;
        }
    }

    public function validateSession($token)
    {
        $query = "SELECT * FROM user_session WHERE token = '$token' AND status = 1";
        $res = parent::getData($query);
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }

    public function updateSession($date)
    {
        $query = "UPDATE user_session SET status = 0 WHERE date < '$date' AND status = 1";
        $verify = parent::nonQuery($query);
        if($verify > 0){
            return 1;
        }else{
            return 0;
        }
    }


}
