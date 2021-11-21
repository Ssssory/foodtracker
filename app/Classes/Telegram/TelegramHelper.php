<?php
namespace App\Classes\Telegram;

use App\Models\Client;
use App\Models\Order;
use App\Models\Point;
use Carbon\Carbon;
use Exception;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class TelegramHelper
{
    public static function sendMessage($id, $message): void {
        new Telegram(env('TELEGRAMM_API_KEY'), env('TELEGRAMM_API_NAME'));

        Request::sendMessage([
            'chat_id' => $id,
            'text'    => $message,
        ]);
    }

    public static function associateUserWithOrder($hash, $chat_id): Point
    {
        try { 
            $data = json_decode(base64_decode($hash));
            $point_id = $data->point;
            $order_id = $data->orderId;

            $order = Order::where(['order_id' => $order_id, 'point_id' => $point_id])
                ->whereDate('created_at', '>=', Carbon::createFromTimeString('00:00'))
                ->first();
        } catch (Exception $e) {
            logger($e->getMessage());
            // TODO: don't save this point.
            $point = new Point;
            $point->login = 'default';
            $point->password = 'default';
            $point->restaurant_id = 1;
            $point->name = 'default';
            return $point;
        }
        
        if ($order) {
            $client = Client::where([
                'messenger_type' => 'telegram', 
                'messenger_id' => $chat_id
                ])
                ->first();
            if (!$client) {
                $client = Client::create(['messenger_id' => $chat_id]);
            }
            $order->client()->associate($client);
            $order->save();
            return $order->point;
        }

        return Point::find($point_id);
    }
}
