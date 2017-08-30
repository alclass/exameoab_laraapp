<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEOConcursosTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('eoconcursos', function (Blueprint $table) {
      $table->smallIncrements('id');
      $table->date('ano')->year();  // year
      $table->tinyInteger('seq_ano')->unsigned();
      $table->string('banca', 20)->default('FGV');
      $table->tinyInteger('seq_banca')->unsigned();
      $table->date('exam_date')->nullable();
      $table->integer('n_inscritos')->unsigned()->nullable();
      $table->integer('n_aprovados')->unsigned()->nullable();
      $table->tinyInteger('graudificuldade')->unsigned()->nullable();
      $table->text('comentario_editor')->nullable();
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
      Schema::dropIfExists('eoconcursos');
  }
}
