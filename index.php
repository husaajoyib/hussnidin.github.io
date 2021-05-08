<?php

class Telebot
{
     const Api_URL='https://api.telegram.org/bot1882350732:AAHFRzZplAohaA1H1L-hhZO1S0YNSTtY4_o/';
     public  function setWebhook($url){
          return $this -> request('setWebhook',[
              'url' => $url
          ]);

     }
     public function request($method,$data){
        $ch = curl_init();

        $url=self::Api_URL.$method;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    public function sendMessage($chat_id,$text){
         return $this -> request("sendMessage",[
             'chat_id' => $chat_id,
             'text' => $text
         ]);
    }
    public function Updates(){
        $update=json_decode(file_get_contents("php://input"));
        return $update -> message;
    }
}

$bot = new Telebot();
$data =$bot -> Updates();
$text =$data -> text;
$chat_id = $data -> chat -> id;
if($text == "salom"){
    $bot -> sendMessage($chat_id,"Asssalomu alaykum");
}

?>