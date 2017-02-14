<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->name = 'Google Analytics';
        $service->price = '100';
        $service->old_price = '200';
        $service->image = '1486893774.png';
        $service->short_description = 'Google Analytics short';
        $service->description = 'Google Analytics description';
        $service->active = '1';

        $service->save();

        $service = new Service();
        $service->name = 'Google Search Console';
        $service->price = '110';
        $service->old_price = '210';
        $service->image = '1486893810.jpg';
        $service->short_description = 'Google Search Console short';
        $service->description = 'Google Search Console description';
        $service->active = '1';

        $service->save();

        $service = new Service();
        $service->name = 'Gmetrix';
        $service->price = '100';
        $service->old_price = '200';
        $service->image = '1486893838.jpg';
        $service->short_description = 'Gmetrix short';
        $service->description = 'Gmetrix description';
        $service->active = '1';

        $service->save();

        $service = new Service();
        $service->name = 'Google Adwords';
        $service->price = '500';
        $service->old_price = '1000';
        $service->image = '1486893866.png';
        $service->short_description = 'Google Adwords short';
        $service->description = 'Google Adwords description';
        $service->active = '1';

        $service->save();
    }
}
