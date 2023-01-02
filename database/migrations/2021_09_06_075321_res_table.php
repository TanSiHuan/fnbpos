<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ResTable', function (Blueprint $table) {
            $table->string('table_id')->primary();
            $table->string('table_code');
            $table->string('table_description');
            $table->string('Current_SO')->nullable();
            $table->string('table_status');
            $table->string('table_active');
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
        //
    }
}
