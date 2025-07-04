<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('locale')->index();

            $table->string('title',500);
            $table->text('excerpt',65535)->nullable();
            $table->longText('body')->nullable();
            $table->string('meta_title',500)->nullable()->default(null);
            $table->longText('meta_description')->nullable()->default(null);

            $table->string('location',500)->nullable()->default(null);
            $table->text('picture',65535)->nullable()->default(null);
            $table->text('cover_picture',65535)->nullable()->default(null);
            $table->string('file')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->boolean('featured')->default(0)->index();
            $table->boolean('is_active')->default(1)->index();
            $table->boolean('watermark')->nullable();
            $table->integer('order')->default(1)->nullable();
            $table->bigInteger('reads')->unsigned()->default(0)->index();
            $table->timestamps();

            $table->unsignedBigInteger('author_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
