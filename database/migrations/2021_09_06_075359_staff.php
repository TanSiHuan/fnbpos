<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Staff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Staff', function (Blueprint $table) {
            $table->string('staff_id')->primary();
            $table->string('staff_name');
            $table->string('staff_email');
            $table->string('staff_restaurant');
            $table->string('staff_password');
            $table->string('staff_contact');
            $table->string('staff_branch');
            $table->string('counter');
            $table->string('admin');
            $table->string('super_admin');
            $table->string('owner');
            $table->string('staff_active');
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
