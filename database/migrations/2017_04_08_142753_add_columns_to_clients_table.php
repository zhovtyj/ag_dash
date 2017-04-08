<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->text('keywords')->nullable()->after('business_hours');
            $table->string('logo_url')->nullable();
            $table->string('photo_url1')->nullable();
            $table->string('photo_url2')->nullable();
            $table->string('photo_url3')->nullable();
            $table->string('photo_url4')->nullable();
            $table->string('photo_url5')->nullable();
            $table->string('video_url')->nullable();
            $table->text('social_accounts')->nullable();
            $table->text('citations')->nullable();
            $table->string('website_login')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('keywords');
            $table->dropColumn('logo_url');
            $table->dropColumn('photo_url1');
            $table->dropColumn('photo_url2');
            $table->dropColumn('photo_url3');
            $table->dropColumn('photo_url4');
            $table->dropColumn('photo_url5');
            $table->dropColumn('video_url');
            $table->dropColumn('social_accounts');
            $table->dropColumn('citations');
            $table->dropColumn('website_login');
            $table->dropColumn('notes');
        });
    }
}
