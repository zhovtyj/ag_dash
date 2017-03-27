<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionServiceOptionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_service_optionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscription_service_id')->unsigned();
            $table->integer('service_optional_description_id')->unsigned();
            $table->boolean('subscribed');
            $table->integer('price')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_service_optionals');
    }
}
