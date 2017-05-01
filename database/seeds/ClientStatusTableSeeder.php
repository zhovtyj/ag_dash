<?php

use Illuminate\Database\Seeder;
use App\ClientStatus;

class ClientStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status1 = new ClientStatus();
        $status1->name = 'Account Created';
        $status1->save();

        $status2 = new ClientStatus();
        $status2->name = 'Ready To Sell';
        $status2->save();

        $status3 = new ClientStatus();
        $status3->name = 'In Progress';
        $status3->save();

        $status4 = new ClientStatus();
        $status4->name = 'Follow Up Needed';
        $status4->save();

        $status5 = new ClientStatus();
        $status5->name = 'Closed (Won)';
        $status5->save();

        $status6 = new ClientStatus();
        $status6->name = 'Closed (Lost)';
        $status6->save();
    }
}
