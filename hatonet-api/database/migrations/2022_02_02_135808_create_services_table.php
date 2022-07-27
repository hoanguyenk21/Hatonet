<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->mediumText('description')->nullable();
            $table->dateTime('service_start', $precision = 0);
            $table->dateTime('service_end', $precision = 0);
            $table->decimal('price_base', 10, 2)->default(0);
            $table->decimal('price_sale', 10, 2)->default(0);
            $table->integer('qty')->default(1);
            $table->enum('status', [
                'pending',
                'wait',
                'active',
                'unactive',
                'suspended',
            ])->default(App\Models\Service::SERVICE_STATUS['OPEN']);
            $table->boolean('service_renew')->default(true);
            $table->integer('user_id');
            $table->integer('use_time')->default(1);
            $table->timestamps();
        });

        Schema::create('service_meta', function (Blueprint $table) {
            $table->id();
            $table->boolean('meta_key')->default(false);
            $table->longText('meta_value')->nullable();
        });

        Schema::table('service_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')
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
        Schema::dropIfExists('services');
    }
};
