<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Symfony\Component\HttpFoundation\Request;

class TelegramSetHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:hook';

    protected $hook_url;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set telegram bot webhook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->hook_url = config('url') . '/webhook';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Create Telegram API object
            $telegram = new Telegram(config('telegram.key'), config('telegram.name'));

            // Set webhook
            $result = $telegram->setWebhook($this->hook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
            }
        } catch (TelegramException $e) {
            // log telegram errors
            echo $e->getMessage();
            logger($e->getMessage());
        }
    }
}
