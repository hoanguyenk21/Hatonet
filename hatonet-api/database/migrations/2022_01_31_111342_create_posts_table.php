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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 100)->unique();
            $table->string('thumbnail', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('term_id')->nullable();
            $table->integer('user_id');
            $table->integer('view')->default(0);
            $table->enum('type', ['post', 'page'])->default(App\Models\Post::POST_TYPE['POST']);;
            $table->enum('status', [
                'pending',
                'wait',
                'active',
                'deactive',
                'suspended',
            ])->default(App\Models\Post::POST_STATUS['PUBLISH']);
            $table->timestamps();
        });

        // foreign key post to taxonomy
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id')->nullable();
            $table->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');
        });

        /**
         * Relation POST_META to POST
         */

        Schema::create('post_meta', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key', 50)->require();
            $table->json('meta_value')->nullable();
        });

        Schema::table('post_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
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
        Schema::dropIfExists('post_meta');
    }
};
