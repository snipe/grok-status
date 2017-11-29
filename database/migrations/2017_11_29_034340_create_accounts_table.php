<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function ($table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('subscription_id');
            $table->string('company_name');
            $table->string('stripe_plan');
            $table->string('subdomain');
            $table->string('custom_domain')->nullable()->default(null);
            $table->string('slack_api_token');
            $table->string('slack_endpoint');
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
        Schema::dropIfExists('accounts');
    }
}
