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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->text('picture',65535)->nullable()->default(null);
            $table->string('button_href',500)->nullable();
            $table->string('button_target',500)->nullable();
            $table->string('button_bg_color',500)->nullable();
            $table->string('button_txt_color',500)->nullable();
            $table->boolean('is_active')->default(1)->index();
            $table->integer('order')->default(1)->nullable();
            $table->timestamps();
        });
        Schema::create('banner_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();
     
            // Foreign key to the main model
            $table->unsignedBigInteger('banner_id');
            $table->unique(['banner_id', 'locale']);
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
     
            // Actual fields you want to translate
            $table->string('heading1_text',500)->nullable();
            $table->string('heading2_text',500)->nullable();
            $table->string('button_text',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('banner_translations');
    }
};
