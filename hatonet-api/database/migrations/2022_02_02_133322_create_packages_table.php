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
        Schema::create('packages', function (Blueprint $table) {
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
            $table->string('user_name');
            $table->integer('service_id');
            $table->dateTime('start_day')->nullable();
            $table->dateTime('stop_day')->nullable();
            $table->timestamps();
        });

        // foreign key meta to user
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on('products');
        // });
        // table product meta
        Schema::create('package_meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 50)->require();
            $table->text('meta_value')->nullable();
        });

        Schema::table('package_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
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
