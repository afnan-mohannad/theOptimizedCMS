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
        Schema::dropIfExists('settings');
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('display_name',100)->nullable();
            $table->text('value',500)->nullable();
            $table->boolean('status')->default(1);
            $table->string('settingType')->nullable();
            $table->string('key')->nullable();
            $table->string('fieldType')->nullable();
            $table->string('group')->nullable();

            $table->timestamps();
        });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
