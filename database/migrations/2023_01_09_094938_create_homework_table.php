<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('class_id')->default(0);
            $table->unsignedBigInteger('exam_id')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('link');
            $table->timestamps();

            $table->foreign('class_id')->reference('id')->on('classes')->onDelete('cascade');
            $table->foreign('exam_id')->reference('id')->on('exams')->onDelete('cascade');
            $table->foreign('user_id')->reference('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homework');
    }
};
