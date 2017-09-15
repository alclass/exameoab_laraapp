<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscquestionsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up() {
    Schema::create('discquestions', function (Blueprint $table) {
      $table->increments('id');
      $table->smallInteger('eoconcurso_id')->unsigned()->nullable();
      $table->foreign('eoconcurso_id')->references('id')->on('eoconcursos');
      $table->smallInteger('level1_knowledgearea_id')->unsigned()->nullable();
      $table->foreign('level1_knowledgearea_id')->references('id')->on('knowledgeareas');
      $table->char('uf', 2)->nullable(); // this is to archive older state based exams (RJ, SP etc); null means NATIONAL
      $table->tinyInteger('graudificuldade')->unsigned()->nullable();
      $table->boolean('is_peca')->default(false);
      $table->boolean('peca_id')->nullable();
      $table->boolean('is_assunto_letra_de_lei')->default(false);
      $table->boolean('is_assunto_jurisprudencial')->default(false);
      $table->boolean('is_assunto_interpretativo')->default(false);
      $table->boolean('is_pacificado_if_jurisprudencial')->default(false);
      $table->text('enunciado');
      $table->text('resp_gab_oficial')->nullable();
      $table->text('resp_editor')->nullable();
      $table->text('comentario_editor')->nullable();
      $table->nullableTimestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('discquestions');
  }
}
