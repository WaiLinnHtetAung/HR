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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('nrc')->nullable();
            $table->string('photo')->nullable();
            $table->string('employee_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('address')->nullable();
            $table->foreignId('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreignId('dep_id')->nullable()->references('id')->on('departments')->onDelete('cascade');
            $table->date('join_date')->nullable();
            $table->boolean('is_present')->default(true);
            $table->timestamp('pw_changed_date')->default(now());
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
