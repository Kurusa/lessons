<?php

class User {

    public $token;
    public $uid;

    public function __construct($token, $uid) {
        $this->setUID($uid);
        $this->setToken($token);
    }

    public function getToken() {
        return $this->token;
    }

    public function getUID() {
        return $this->uid;
    }


    public function setToken($token) {
        $this->token = $token;
    }


    public function setUID($uid) {
        $this->uid = $uid;
    }
}
