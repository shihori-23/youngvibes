<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schemaファサードでservice_contentsテーブルの作成
        Schema::create('service_contents', function (Blueprint $table) {
            // カラムを作成してゆくぅ〜！
            $table->increments('c_id');
            $table->string('u_id');
            $table->string('img_file')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ロールバック処理(トランザクション障害が起きた際の処理)の記述
        Schema::dropIfExists('service_contents');
    }
}
