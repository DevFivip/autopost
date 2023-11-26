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
        Schema::create('subreddits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tags');
            $table->boolean('verification');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('customer_subreddits', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('subreddit_id')->constrained('subreddits');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subreddits');
        Schema::dropIfExists('customer_subreddits');
    }
};
