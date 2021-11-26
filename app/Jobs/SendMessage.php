<?php

namespace App\Jobs;

use App\Classes\Messages;
use App\Classes\Telegram\TelegramHelper;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->order->client && $this->order->status === 'READY') {
            $message = Messages::getDefaultMessages()['default_ready_repeat_text'];
            TelegramHelper::sendMessage($this->order->client->messenger_id, $message);
        }
    }
}
