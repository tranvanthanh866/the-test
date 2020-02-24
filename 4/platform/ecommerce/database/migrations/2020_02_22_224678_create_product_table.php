<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name', 120);
            $table->longText('product_content')->nullable();
            $table->integer('category_id');
            $table->decimal('price', 8,2)->nullable();
            $table->longText('product_slug');
            $table->string('description', 400)->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->string('status', 60)->default('publish');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
