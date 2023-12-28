<?php

namespace App\Http\Notification;

use GuzzleHttp\Client;
use App\Http\Services\notification\Exception;

class Telegram
{
    // sent message to telegram
    public static function sendMessage($message)
    {
        try {
            $client = new Client([
                // Base URI is used with relative requests
                "base_uri" => "https://api.telegram.org",
            ]);

            $bot_token = "6838864822:AAGWS22EAFPhfJl5GGbSeTVmsvI5NKF_6f0";
            $chat_id = "5273636179";

            $response = $client->request("GET", "/bot$bot_token/sendMessage", [
                "query" => [
                    "chat_id" => $chat_id,
                    "text" => $message,
                    "parse_mode" => "HTML",
                ]
            ]);
            $body = $response->getBody();
            $arr_body = json_decode($body);

            if ($arr_body->ok) {
                echo "Message posted.";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
