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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('venue');
            $table->dateTime('meeting_date');
            $table->unsignedTinyInteger('approval');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
