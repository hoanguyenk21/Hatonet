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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique()->nullable();
            $table->string('password', 100);
            // verify account
            $table->string('name', 50);
            $table->string('short_name', 50)->nullable();
            $table->mediumText('description')->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('banner', 1000)->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('phone', 15)->unique()->nullable();
            $table->double('rating')->nullable();
            $table->string('provider_id', 50)->unique()->nullable();

            $table->enum('roles', [
                'admin',
                'manager',
                'member',
                'company',
            ])->default(App\Models\User::USER_ROLES['COMPANY']);

            $table->enum('status', [
                'pending',
                'expired',
                'active',
                'suspended',
            ])->default(App\Models\User::USER_STATUS['PENDING']);


            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /**
         * Relation USER_META to USER
         */

        Schema::create('user_meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 50)->require();
            $table->text('meta_value')->nullable();
        });

        Schema::table('user_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_meta');
    }
};
