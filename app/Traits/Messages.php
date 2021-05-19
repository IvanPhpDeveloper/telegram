<?php


namespace App\Traits;


trait Messages
{
    public function sendMessage( $message,$id){

        $url = "https://api.telegram.org/bot1729387319:AAF5r7bki-UL6n4q7XfUdr1r5mSmNQRGBxc/sendMessage";
        $postfields = array(
            'chat_id' => "$id",
            'text' => "$message",
            'parse_mode'    => 'HTML',
        );

        $this->send($url, $postfields);

    }


    public function send($url, $postfields){



        if (!$curld = curl_init()) {
            exit;
        }
        curl_setopt($curld, CURLOPT_POST, true);
        curl_setopt($curld, CURLOPT_POSTFIELDS, http_build_query($postfields));
        curl_setopt($curld, CURLOPT_URL,$url);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curld);
        curl_close ($curld);
        return $output;


    }
}
