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
      $table->increments('id');
      $table->year('ano');
      $table->tinyInteger('seq_ano');
      $table->string('banca', 20)->default('FGV');
      $table->tinyInteger('seq_banca');
      $table->date('exame_date')->nullable();
      $table->integer('n_inscritos')->nullable();
      $table->integer('n_aprovados')->nullable();
      $table->tinyInteger('graudificuldade')->nullable();
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
