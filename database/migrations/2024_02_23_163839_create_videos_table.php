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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Episode::class)->index();
            $table->morphs('uploader');
            $table->boolean('status')->index()->default(0);
            $table->text('iframe');
            $table->integer('duration')->nullable();
            $table->dateTime('visible_after')->nullable()->index();
            $table->timestamps();
            $table->index(["status", "visible_after"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
