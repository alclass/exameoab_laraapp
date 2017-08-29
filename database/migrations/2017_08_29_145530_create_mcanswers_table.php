<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcanswersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('mcanswers', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('mcquestion_id');
      $table->foreign('mcquestion_id')->references('id')->on('mcquestions');
      $table->tinyInteger('position'); // maps to LETTER (A B C D E)
      $table->text('texto_escolha');
      $table->boolean('true_or_false_if_application')->nullable();
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
    Schema::dropIfExists('mcanswers');
  }
}
