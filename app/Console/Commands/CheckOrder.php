<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CheckOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:check {order_number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if an order exists and display its details';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderNumber = $this->argument('order_number');

        $order = Order::where('order_number', $orderNumber)
            ->with(['customer', 'items.product'])
            ->first();

        if (!$order) {
            $this->error("Order not found: {$orderNumber}");
            return 1;
        }

        $this->info("Order found: {$order->order_number}");
        $this->line("Status: {$order->status}");
        $this->line("Customer ID: {$order->customer_id}");

        if ($order->customer) {
            $this->line("Customer Email: {$order->customer->email}");
            $this->line("Customer Name: {$order->customer->first_name} {$order->customer->last_name}");
        } else {
            $this->warn("Customer not found for this order!");
        }

        $this->line("Total Amount: Ksh " . number_format($order->total_amount, 2));
        $this->line("Created: {$order->created_at}");

        return 0;
    }
}
