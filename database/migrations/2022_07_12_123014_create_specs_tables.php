<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('specs_cpus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('specs_vendors');  //TODO onDelete, onUpdate
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('data');
            $table->integer('position')->default(0);
            $table->foreignId('author_id')->constrained('users'); //TODO onDelete, onUpdate
            $table->timestamps();
        });

        Schema::create('specs_gpus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('specs_vendors');  //TODO onDelete, onUpdate
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('data');
            $table->integer('position')->default(0);
            $table->foreignId('author_id')->constrained('users'); //TODO onDelete, onUpdate
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
        Schema::dropIfExists('specs_cpus');
        Schema::dropIfExists('specs_gpus');
        Schema::dropIfExists('specs_vendors');
    }
}
