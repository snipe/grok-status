<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_groups', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->integer('account_id');
            $table->integer('ordering')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('email_notifications')->default(1);
            $table->boolean('slack_notifications')->default(1);
            $table->boolean('text_notifications')->default(0);
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
        Schema::dropIfExists('service_groups');
    }
}
