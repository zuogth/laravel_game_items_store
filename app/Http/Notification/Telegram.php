<?php

namespace App\Http\Notification;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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

            $bot_token = env('BOT_TOKEN');
            $chat_id = env('CHAT_ID');

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
                return;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return;
        }
    }
}
