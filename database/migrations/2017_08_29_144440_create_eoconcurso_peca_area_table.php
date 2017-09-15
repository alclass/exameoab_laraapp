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
    Schema::create('eoconcurso_peca_area', function (Blueprint $table) {
      $table->smallInteger('eoconcurso_id')->unsigned();
      $table->smallInteger('peca_id')->unsigned();
      $table->tinyInteger('oab_area_id')->unsigned();
      $table->primary(['eoconcurso_id', 'peca_id', 'oab_area_id']);
      $table->foreign('eoconcurso_id')
        ->references('id')->on('eoconcursos');
      $table->foreign('peca_id')
        ->references('id')->on('pecas');
        $table->foreign('oab_area_id')
          ->references('id')->on('knowledgeareas');
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
      Schema::dropIfExists('eoconcurso_peca_area');
  }
}
