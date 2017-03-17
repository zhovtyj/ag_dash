<?php

use Illuminate\Database\Seeder;
use App\OrderStatus;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_new = new OrderStatus;
        $status_new->name = 'New';
        $status_new->save();

        $status_active = new OrderStatus;
        $status_active->name = 'Active';
        $status_active->save();

        $status_completed = new OrderStatus;
        $status_completed->name = 'Completed';
        $status_completed->save();
    }
}
