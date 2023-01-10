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
        Schema::create('reporting_instructions', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->dateTime('report_date');
            $table->string('interval');
            $table->text('queries')->nullable();
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
        Schema::dropIfExists('reporting_instructions');
    }
};
