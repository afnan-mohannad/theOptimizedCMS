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
            $table->string('name',255);
            $table->longText('bio')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('created_ip',40)->nullable();
            $table->string('last_login_ip',40)->nullable();
            $table->text('avatar',65535)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_date')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('role_id');
            $table->softDeletes();
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
