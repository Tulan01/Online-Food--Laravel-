<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days_menus', function (Blueprint $table) {
            $table->id();
            $table->text('days_menu_details');
            $table->string('days_menu_image');
            $table->string('days_menu_price');
            $table->integer('days_id');
            $table->string('days_menu_status');
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
        Schema::dropIfExists('days_menus');
    }
}
