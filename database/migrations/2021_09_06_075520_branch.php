<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Branch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Branch', function (Blueprint $table) {
            $table->string('branch_id')->primary();
            $table->string('branch_name');
            $table->string('branch_contact');
            $table->string('branch_address');
            $table->string('branch_restaurant');
            $table->string('branch_table_amount');
            $table->string('branch_currency');
            $table->string('branch_active');
            $table->string('current_cash');
            $table->string('branch_updateBy');
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
