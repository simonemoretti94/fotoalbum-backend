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
            $table->unsignedBigInteger('author_id'); // foreign key to users	|many to one|
            $table->string('slug')->default('default-slug')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();  // foreign key to categories	|many to one|
            $table->boolean('featured_photo')->nullable();	// in evidenza
            $table->boolean('draft')->nullable(); // bozza
            $table->timestamp('upload_date')->useCurrent();
            $table->integer('file_size')->nullable();
            $table->string('format')->nullable();
            $table->string('copyright')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
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
