<?php

namespace App\Bot;

use App\Classes\Messages;
use App\Classes\Telegram\TelegramHelper;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class FoodStartCommand extends UserCommand
{
    protected $name = 'start';                           // Your command's name
    protected $description = 'Asohsiate user and order'; // Your command description
    protected $usage = '/start';                         // Usage of your command
    protected $version = '1.0.0';                        // Version of your command

    public function execute(): ServerResponse
    {
        $inputMessage = $this->getMessage();            // Get Message object

        $chat_id = $inputMessage->getChat()->getId();   // Get the current Chat ID

        $hash = $inputMessage->getText(true);

        $point = TelegramHelper::associateUserWithOrder($hash, $chat_id);

        $allTexts = $point->notifications;
        if ($allTexts) {
            foreach ($allTexts as $text) {
                if ($text->type === 'start' && $text->active === true) {
                    $message = $text->message;
                }
            }
        }
        if (empty($message)) {
            $message = Messages::getDefaultMessages()['default_start_text'];
        }

        $data = [
            'chat_id' => $chat_id,
            'text'    => $message
        ];

        return Request::sendMessage($data);
    }
}

