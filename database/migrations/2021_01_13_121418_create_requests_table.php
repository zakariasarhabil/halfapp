<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name_client');
            $table->string('number');
            $table->string('type_realstate');
            $table->string('type_request');
            $table->integer('space_min');
            $table->integer('space_max');
            $table->integer('price_min');
            $table->integer('price_max');
            $table->text('information');
            $table->string('status')->default('new');

            $table->foreignId('office_owners_id')->nullable()->constrained();
            $table->foreignId('marketers_id')->nullable()->constrained();



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
        Schema::dropIfExists('requests');
    }
}
