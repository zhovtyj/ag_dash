<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('business_name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country');
            $table->string('business_owners_name');
            $table->string('business_owners_email');
            $table->string('business_owners_phone');
            $table->string('business_owners_fax')->nullable();
            $table->string('business_owners_phone1')->nullable();
            $table->string('business_website');
            $table->integer('years_in_business')->nullable();
            $table->string('business_license')->nullable();
            $table->string('payment_types_accepted')->nullable();
            $table->string('products_or_brands_offered')->nullable();
            $table->text('business_description')->nullable();
            $table->text('business_hours')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
