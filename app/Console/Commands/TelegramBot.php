<?php

namespace App\Console\Commands;

use App\Bot\FoodStartCommand;
use Illuminate\Console\Command;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get telegram bot messages and send answers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            $telegram = new Telegram(config('app.telegram.key'), config('app.telegram.name'));

            $telegram->useGetUpdatesWithoutDatabase();

            $telegram->addCommandClass(FoodStartCommand::class);

            // Handle telegram getUpdates request
            $telegram->handleGetUpdates();
        } catch (TelegramException $e) {
            // log telegram errors
            logger($e->getMessage());
        }
    }
}
