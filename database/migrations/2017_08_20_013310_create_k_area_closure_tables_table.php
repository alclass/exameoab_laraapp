<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKAreaClosureTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karea_closuretable', function (Blueprint $table) {
            //$table->increments('id');
            $table->smallInteger('parent_id')->unsigned();
            $table->smallInteger('child_id')->unsigned();
            $table->tinyInteger('depth');
            $table->nullableTimestamps();
            $table->primary(['parent_id','child_id']);
            $table->foreign('parent_id')
              ->references('id')->on('knowledgeareas');
            $table->foreign('child_id')
              ->references('id')->on('knowledgeareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karea_closuretable');
    }
}
