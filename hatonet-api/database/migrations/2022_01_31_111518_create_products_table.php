<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.`
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 225);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 100)->unique();
            $table->integer('qty')->default(1);
            $table->integer('price_base')->default(0);
            $table->integer('price_sale')->default(0);
            $table->integer('price_other')->default(0);
            $table->integer('user_id');
            $table->double('rating')->nullable();
            $table->enum('status', [
                'pending',
                'wait',
                'active',
                'deactive',
                'suspended',
            ])->default(App\Models\Product::PRODUCT_STATUS['PENDING']);
            $table->timestamps();
        });

        // foreign key meta to taxonomy

        /**
         * Relation PRODUCT_META to PRODUCT
         */

        Schema::create('product_meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 50)->require();
            $table->json('meta_value')->nullable();
        });

        Schema::table('product_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('products');
    }
};
