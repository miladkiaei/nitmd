<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrySegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_segments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('segment_type', 4);
            $table->unsignedBigInteger('entry_id');
            $table->string('content');
            $table->tinyInteger('order');
            $table->foreign('entry_id')->references('id')->on('entries');
            $table->foreign('segment_type')->references('code')->on('entry_segment_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_segments');
    }
}
