<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('image')->nullable();
            $table->foreignId('category_id')->constrained(); // reference to category id
            $table->dateTime('date_published');
            $table->integer('comment_count')->default(0);
            $table->string('language'); // en, bm
            $table->string('link');
            $table->text('summary');
            $table->foreignId('author_id')->nullable()->constrained(); // stories can have 0 author
            $table->text('full_story');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
