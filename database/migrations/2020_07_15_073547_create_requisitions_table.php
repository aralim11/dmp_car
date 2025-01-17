<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('req_user_id');
            $table->integer('user_id')->nullable();
            $table->integer('car_id')->nullable();
            $table->integer('requisition_type');
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->integer('realesed_by')->nullable();
            $table->dateTime('realesed_date')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('requisitions');
    }
}
