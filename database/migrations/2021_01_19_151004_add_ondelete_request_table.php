<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndeleteRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(["office_owners_id"]);
            $table->foreign('office_owners_id')
                  ->references('id')
                  ->on('office_owners')
                  ->onDelete('cascade');

            $table->dropForeign(["marketers_id"]);
            $table->foreign('marketers_id')
                  ->references('id')
                  ->on('marketers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(["office_owners_id"]);
            $table->foreign('office_owners_id')
                  ->references('id')
                  ->on('office_owners');

            $table->dropForeign(["marketers_id"]);
            $table->foreign('marketers_id')
                        ->references('id')
                        ->on('marketers');
        });
    }
}
