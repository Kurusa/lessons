<?php

class Vk {

    const API = "https://api.vk.com/method/";
    const AUTH = "https://oauth.vk.com/";
    const V = 5.73;


    public function api($method, $params) {
        //викликати do(), підставивши url

        $url = self::API . $method;

        return $this->do($url, $params);
    }

    public function auth($method, $params) {

        $url = self::AUTH . $method;

        return $this->do($url, $params);
    }

    private function do($url, $params) {
    //спільна робота для api і auth

        $extra = array("v" => self::V);

        $params = http_build_query(array_merge($extra, $params));

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url . '?' . $params);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $result;
    }

}

