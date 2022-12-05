<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            //カラムの作成 https://laraweb.net/surrounding/4821/
            $table->increments('id');
            $table->string('title',100);
            $table->integer('status');
            $table->text('content')->comment('詳細内容');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos', function (Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropForeign('todos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
