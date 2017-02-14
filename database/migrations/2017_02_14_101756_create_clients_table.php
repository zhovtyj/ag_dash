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
            $table->string('business_name');
            $table->string('address1');
            $table->string('address2')->default('');
            $table->string('city');
            $table->string('state')->default('');
            $table->string('postcode')->default('');
            $table->string('country');
            $table->string('business_owners_name');
            $table->string('business_owners_email');
            $table->string('business_owners_phone');
            $table->string('business_owners_fax')->default('');
            $table->string('business_owners_phone1')->default('');
            $table->string('business_website');
            $table->integer('years_in_business')->default(0);
            $table->string('business_license')->default('');
            $table->string('payment_types_accepted')->default('');
            $table->string('products_or_brands_offered')->default('');
            $table->text('business_description');
            $table->text('business_hours');
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
