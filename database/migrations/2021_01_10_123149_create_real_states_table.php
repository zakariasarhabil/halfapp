<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_states', function (Blueprint $table) {
            $table->id();
            $table->string('creator');
            $table->string('type_offer');
            $table->string('type_RealState');
            $table->integer('space');
            $table->integer('price')->nullable();
            $table->integer('price_meter')->nullable();
            $table->string('facade');
            $table->string('video')->nullable();
            $table->string('location');
            $table->string('evaluation');
            $table->string('age')->nullable();
            $table->integer('number_apartment');
            $table->boolean('furnished');
            $table->boolean('duplex');
            $table->boolean('driver_room');
            $table->boolean('addition');
            $table->boolean('cellar');
            $table->boolean('elevator');
            $table->boolean('magnifier');
            $table->string('earth_type')->nullable();
            $table->integer('annual_income')->nullable();
            $table->text('specification');
            $table->string('number_offices');
            $table->string('type_owner');
            $table->string('name_owner');
            $table->string('phone');
            $table->string('phone_two')->nullable();
            $table->string('Edited_by')->nullable();

            $table->foreignId('office_owners_id')->nullable()->constrained();
            // $table->foreignId('marketers_id')->nullable()->constrained();



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
        Schema::dropIfExists('real_states');
    }
}
