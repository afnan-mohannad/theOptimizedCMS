<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('permission_id')->nullable()->default(null);

            $table->enum('type',['item','divider'])->default('item');
            $table->integer('parent_id')->nullable();
            $table->integer('order')->default(1)->nullable();
            $table->json('title',50)->nullable();
            $table->json('divider_title',50)->nullable();
            $table->string('url',500)->nullable();
            $table->string('target',50)->default("_self");
            $table->string('icon_class',50)->nullable();
            $table->text('icon_svg')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade');
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
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
        Schema::dropIfExists('menu_items');
    }
}
