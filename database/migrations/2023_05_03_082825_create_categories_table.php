<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->string('slug',500)->unique();
            $table->text('picture', 65535)->nullable();
            $table->text('main_design', 65535)->nullable();
            $table->text('color', 500)->nullable();
            $table->integer('show_main')->nullable();
            $table->integer('order')->default(1)->nullable();
            $table->integer('items')->nullable();
            $table->integer('items_plugin')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
        Schema::create('category_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();
     
            // Foreign key to the main model
            $table->unsignedBigInteger('category_id');
            $table->unique(['category_id', 'locale']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
     
            // Actual fields you want to translate
            $table->string('name',500);
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_translations');
    }
}
