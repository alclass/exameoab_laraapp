<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeAreasTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('knowledgeareas', function (Blueprint $table) {
      $table->smallIncrements('id');
      $table->smallInteger('parent_ka_id')->unsigned()->nullable();
      $table->foreign('parent_ka_id')
        ->references('id')->on('knowledgeareas')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->string('name', 70);
      $table->string('short_description', 100)->nullable();
      $table->string('wiki_url', 255)->nullable();
      // $table->string('slash_sep_path_from_root_to_node', 100)->nullable();
      // $table->string('slash_sep_list_encompassing_subtree', 255)->nullable();;
      $table->nullableTimestamps();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('knowledgeareas');
  }
}
