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
        // Creating users table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // User ID (auto-increment)
            $table->string('name'); // User's name
            $table->string('email')->unique(); // Unique email
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // User's password
            $table->integer('phone')->nullable(); // Optional phone number
            $table->enum('user_type', ['patient', 'doctor', 'admin'])->default('patient');
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

        // Creating password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email field
            $table->string('token'); // Token for password reset
            $table->timestamp('created_at')->nullable(); // Token creation timestamp
        });

        // Creating sessions table for user sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID
            $table->foreignId('user_id')->nullable()->index(); // User ID reference
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // User's browser information
            $table->longText('payload'); // Session data payload
            $table->integer('last_activity')->index(); // Timestamp of last activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('appointments'); // Drop appointments table first
        Schema::dropIfExists('users'); // Drop users table
        Schema::dropIfExists('password_reset_tokens'); // Drop password reset tokens table
        Schema::dropIfExists('sessions'); // Drop sessions table
    }

};
