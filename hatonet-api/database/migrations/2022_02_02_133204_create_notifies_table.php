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
        Schema::create('notifies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('actision')->default(0);
            $table->string('type', 20)
                ->default(App\Models\Notify::NOTIFY_TYPE['SYSTEM']);
            $table->integer('user_id');
            $table->text('user_receive')
                ->default(App\Models\Notify::NOTIFY_RECIVE['ALL']);
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
        Schema::dropIfExists('notifies');
    }
};
