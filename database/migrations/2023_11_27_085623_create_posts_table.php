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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->timestamps();
        });
 
        Schema::create('post_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('telegram_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('customer_id')->constrained('customers');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->string('local_media_file');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('subreddit_id')->nullable()->constrained('subreddits');
            $table->foreignId('telegram_channel_id')->nullable()->constrained('telegram_channels');
            $table->foreignId('post_type_id')->constrained('post_types');
            $table->dateTimeTz('posted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_types');
        Schema::dropIfExists('telegram_channels');
    }
};
