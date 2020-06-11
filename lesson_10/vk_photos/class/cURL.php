<?php

class cURL {

    private $curl;

    public function __construct() {
        $this->curl = curl_init();
    }

    public function get($url, $params) {
        $params = http_build_query($params);

        curl_setopt($this->curl, CURLOPT_URL, $url."?".$params);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $result = json_decode(curl_exec($this->curl), true);

        curl_close($this->curl);
        return $result;
    }

    public function post($url, $params) {

        $params = http_build_query($params);

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);

        $result = json_decode(curl_exec($this->curl));

        curl_close($this->curl);
        return $result;
    }

    public function sendFile($url, $file) {
        $curl = curl_init("https://pp.userapi.com/c841329/v841329871/3afe4/aEmSgNB-W5A.jpg");

        $fp = fopen($file, 'wb');

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FILE, $fp);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $result = json_decode(curl_exec($curl));

        fclose($fp);

        curl_close($this->curl);
        return $result;
    }
}