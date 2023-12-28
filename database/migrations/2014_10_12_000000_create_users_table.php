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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('email')->unique()->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->date('birth_date')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('job')->nullable()->default(null);
            $table->string('company')->nullable()->default(null);
            $table->text('bio')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
