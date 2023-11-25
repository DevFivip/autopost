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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->nullable();
            $table->string('reddit_username')->nullable();
            $table->string('reddit_password')->nullable();
            $table->string('reddit_clientId')->nullable();
            $table->string('reddit_clientSecret')->nullable();
            $table->string('imgur_username')->nullable();
            $table->string('imgur_password')->nullable();
            $table->string('imgur_clientId')->nullable();
            $table->string('imgur_clientSecret')->nullable();
            $table->string('telegram_channel')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
