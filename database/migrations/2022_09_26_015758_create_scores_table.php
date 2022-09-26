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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('name');
            $table->string('major');
            $table->decimal('quiz');
            $table->decimal('task');
            $table->decimal('presence');
            $table->decimal('practice');
            $table->decimal('exam');
            $table->decimal('final_score');
            $table->char('grade');
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
        Schema::dropIfExists('scores');
    }
};
