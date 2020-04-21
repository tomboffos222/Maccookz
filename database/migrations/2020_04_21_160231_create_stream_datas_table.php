<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_data', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->text('socket_id');
            $table->string('stream_name');
            $table->text('viewers');
            $table->text('comments');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream_datas');
    }
}
