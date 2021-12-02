<?php

namespace App\Http\Controllers;

use App\Bot\FoodStartCommand;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class BotController extends Controller
{
    /**
     *
     * @return void
     */
    public function __invoke()
    {
        try {
            // Create Telegram API object
            $telegram = new Telegram(env('TELEGRAMM_API_KEY'), env('TELEGRAMM_API_NAME'));

            $telegram->useGetUpdatesWithoutDatabase();

            $telegram->addCommandClass(FoodStartCommand::class);

            $telegram->handle();
        } catch (TelegramException $e) {
            // log telegram errors
            logger($e->getMessage());
        }
    }
}
