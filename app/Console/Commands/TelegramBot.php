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
    protected $description = 'Start telegram bot webhook';

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
            $telegram = new Telegram(env('TELEGRAMM_API_KEY'), env('TELEGRAMM_API_NAME'));

            $telegram->useGetUpdatesWithoutDatabase();

            $telegram->addCommandClass(FoodStartCommand::class);

            // Handle telegram getUpdates request
            $telegram->handleGetUpdates();
            // $result = $telegram->handleGetUpdates();
            // logger($result);
        } catch (TelegramException $e) {
            // log telegram errors
            logger( $e->getMessage() );
        }
    }
}
