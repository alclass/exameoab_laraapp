<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcquestionsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up() {
    Schema::create('mcquestions', function (Blueprint $table) {
      $table->increments('id');
      $table->smallInteger('eoconcurso_id')->unsigned()->nullable();
      $table->foreign('eoconcurso_id')->references('id')->on('eoconcursos');
      $table->smallInteger('level1_knowledgearea_id')->unsigned()->nullable();
      $table->foreign('level1_knowledgearea_id')->references('id')->on('knowledgeareas');
      $table->char('uf', 2)->nullable(); // this is to archive older state based exams (RJ, SP etc); null means NATIONAL
      $table->tinyInteger('seq_banca')->unsigned();
      $table->tinyInteger('graudificuldade')->unsigned()->nullable();
      $table->boolean('is_assunto_conceitual')->default(true);
      $table->boolean('is_assunto_lei_seca')->default(false);
      $table->boolean('is_assunto_jurisprudencial')->default(false);
      $table->boolean('is_assunto_interpretativo')->default(false);
      $table->boolean('is_pacificado_if_jurisprudencial')->default(false);
      $table->text('enunciado');
      $table->text('comentario_editor')->nullable();
      $table->char('resposta_letra', 1);
      $table->nullableTimestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('mcquestions');
  }
}
