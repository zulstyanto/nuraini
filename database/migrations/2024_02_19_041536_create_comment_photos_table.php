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
        Schema::create('comment_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment_content');
            $table->timestamp('comment_date')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_photos');
    }
};
