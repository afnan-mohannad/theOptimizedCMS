<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->string('slug',500)->unique();
            $table->text('picture',65535)->nullable()->default(null);
            $table->text('cover_picture',65535)->nullable()->default(null);
            $table->timestamps();
        });
        Schema::create('page_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();
     
            // Foreign key to the main model
            $table->unsignedBigInteger('page_id');
            $table->unique(['page_id', 'locale']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
     
            // Actual fields you want to translate
            $table->string('title',500);
            $table->text('excerpt',65535)->nullable();
            $table->longText('body',16777215)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_translations');
    }
}
