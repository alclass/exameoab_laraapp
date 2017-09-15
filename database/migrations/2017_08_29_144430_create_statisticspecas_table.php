<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePecasTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('pecas', function (Blueprint $table) {
      $table->increments('id');
      $table->smallInteger('peca_id')->unsigned();
      $table->smallInteger('oab_area_id')->unsigned();
      $table->tinyInteger('occurred_in_exam_n')->unsigned();
      $table->tinyInteger('banca_id')->unsigned();
      $table->tinyInteger('graudificuldade')->unsigned()->nullable();
      $table->tinyInteger('perc_aprovacao')->unsigned()->nullable();
      $table->nullableTimestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('pecas');
  }
}
