<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndeleteMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketers', function (Blueprint $table) {
            $table->dropForeign(["office_owners_id"]);
            $table->foreign('office_owners_id')
                  ->references('id')
                  ->on('office_owners')
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
        Schema::table('marketers', function (Blueprint $table) {
            $table->dropForeign(["office_owners_id"]);
            $table->foreign('office_owners_id')
                  ->references('id')
                  ->on('office_owners');
        });
    }
}
