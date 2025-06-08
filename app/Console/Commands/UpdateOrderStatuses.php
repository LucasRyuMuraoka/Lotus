<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-order-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Order::where('status', 'Em preparo')
            ->where('created_at', '<=', now()->subMinutes(5))
            ->update(['status' => 'Em entrega']);

        Order::where('status', 'Em entrega')
            ->where('updated_at', '<=', now()->subMinutes(5))
            ->update(['status' => 'Entregue']);

        return Command::SUCCESS;
    }
}
