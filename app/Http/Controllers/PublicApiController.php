<?php

namespace App\Http\Controllers;

use App\Classes\Messages;
use App\Classes\Telegram\TelegramHelper;
use App\Events\SendMessage;
use App\Http\Requests\AuthBaseRquest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class PublicApiController extends Controller
{

    /**
     *
     * @param AuthBaseRquest $request
     * @return JsonResponse
     */
    public function list(AuthBaseRquest $request): JsonResponse
    {
        $orders = Order::today($request->point)->get();

        $orders->transform(function ($item) {
            return [
                'order_id' => $item->order_id, 
                'external_id' => $item->external_id, 
                'status' => $item->status, 
                'created_at' => $item->created_at
            ];
        });

        return response()->json([
            'orders' => $orders
        ]);
    }

    /**
     *
     * @param AuthBaseRquest $request
     * @return JsonResponse
     */
    public function link(AuthBaseRquest $request): JsonResponse
    {
        $link = env('TELEGRAMM_API_LINK_ANSWER');

        return response()->json([
            'link' => $link,
            'point' => $request->point
        ]);
    }


    public function status(AuthBaseRquest $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required|min:6',
            'status' => 'required',
        ]);

        $order = Order::today($request->point)->where('order_id', $request->order_id)->firstOrFail();

        $order->update(['status' => $request->status]); 

        SendMessage::dispatch($order);

        if ($request->status == 'READY') {
            $message = Messages::getDefaultMessages()['default_ready_text'];
        }

        if ($request->status == 'CALL') {
            $message = Messages::getDefaultMessages()['default_call_text'];
        }

        if (!empty($message) && !empty($order->client_id)) {
            TelegramHelper::sendMessage($order->client->messenger_id, $message);
        }

        return response()->json([
            'order_id' => $order->order_id,
            'external_id' => $order->external_id,
            'status' => $order->status,
            'created_at' => $order->created_at
        ]);
    }


}
