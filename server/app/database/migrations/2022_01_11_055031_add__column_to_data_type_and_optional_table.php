<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDataTypeAndOptionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamic_items', function (Blueprint $table) {
            //
            $table->integer('data_type_id')->after('label');
            $table->boolean('required')->after('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynamic_items', function (Blueprint $table) {
            //
            $table->dropColumn('data_type_id');
            $table->dropColumn('required');
        });
    }
}
