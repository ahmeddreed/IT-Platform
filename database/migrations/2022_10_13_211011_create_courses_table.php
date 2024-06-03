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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("title");
            $table->text("description");
            $table->foreignId('user_id')->constrained('users')->nullOnUpdate()->cascadeOnDelete();
            $table->foreignId('br_id')->constrained('branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('lg_id')->constrained('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("image")->nullable();
            $table->string("state")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
};
