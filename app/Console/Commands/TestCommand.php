<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'enter a name';

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
        $name = $this->ask('What is your name?');

        if ($name == 'athul') {

            $this->info('welcome ' . $name);

            // $orders = Order::pluck('customer_name');
            // $order = $this->anticipate('customer with your order?', function ($orders) {
            //     $a = $orders->toArray();
            //     return $a;
            // });

            $order = $this->anticipate('customer with your order?', ['Taylor DD', 'Dayle']);


            if ($this->confirm('Do you wish to continue?', true)) {
                $this->info('good morning ' . $name . ' have a nice day!');
            } else {
                $this->error('you refuced to continue!');
            }
        } else {
            $this->error('unauthorized user');
        }
        return 0;
    }
}
