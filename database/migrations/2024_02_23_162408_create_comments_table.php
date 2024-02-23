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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->morphs('commentable');
            $table->foreignIdFor(\App\Models\Comment::class)->index()->nullable();
            $table->foreignIdFor(\App\Models\User::class)->index();
            $table->integer('points');
            $table->string('comment', 1000);
            $table->boolean('status')->index();
            $table->boolean('spoiler')->index();
            $table->timestamps();
       //     $table->index(["commentable_type", "commentable_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
