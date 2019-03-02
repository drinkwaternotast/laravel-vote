<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNameOfBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('battles', function (Blueprint $table) {
            $table->renameColumn('battle_id', 'photo_you');
            $table->renameColumn('photo_id', 'photo_enemy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('battles', function (Blueprint $table) {
            $table->renameColumn('photo_you', 'battle_id');
            $table->renameColumn('photo_enemy', 'photo_id');
        });
    }
}
