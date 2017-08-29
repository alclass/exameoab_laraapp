<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcquestionKnowledgeareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('mcquestion_knowledgearea', function (Blueprint $table) {
        $table->integer('mcquestion_id')->unsigned();
        $table->foreign('mcquestion_id')->references('id')->on('mcquestions');
        $table->smallInteger('knowledgearea_id')->unsigned();
        $table->foreign('knowledgearea_id')->references('id')->on('knowledgeareas');
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
        Schema::dropIfExists('mcquestion_knowledgearea');
    }
}
