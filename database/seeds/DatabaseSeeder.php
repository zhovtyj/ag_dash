<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(OrderStatusesSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ClientStatusTableSeeder::class);
    }
}
