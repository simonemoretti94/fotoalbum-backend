<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->text('description', 2000)->nullable();
            $table->string('cover_image');
            $table->boolean('published')->nullable();
            //$table->boolean('featured_photo')->nullable();	// in evidenza
            //$table->boolean('draft')->nullable(); // bozza
            $table->string('slug')->nullable();
            $table->timestamp('upload_date')->useCurrent();
            $table->integer('file_size')->nullable();
            $table->string('format')->nullable();
            $table->string('copyright')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
