<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->mediumText('description')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('price_base', 10, 2)->default(0);
            $table->decimal('price_sale', 10, 2)->default(0);
            $table->enum('status', [
                'pending',
                'wait',
                'active',
                'unactive',
                'suspended',
            ])->default(App\Models\Order::ORDER_STATUS['OPEN']);
            $table->integer('user_id');
            $table->timestamps();
        });

        // foreign key meta to user
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on('products');
        // });
        // table product meta
        Schema::create('order_meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 50)->require();
            $table->text('meta_value')->nullable();
        });

        Schema::table('order_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('orders');
    }
};
