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
      $table->smallIncrements('id');
      $table->string('nome', 100);  // year
      $table->text('description')->nullable();
      $table->text('generic_model')->nullable();
      $table->boolean('is_autonoma')->default(false);
      $table->boolean('is_incidental')->default(false); // example: E.P.E. (Exceção de Pré-Executividade)
      $table->boolean('is_recursal')->default(false);
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
