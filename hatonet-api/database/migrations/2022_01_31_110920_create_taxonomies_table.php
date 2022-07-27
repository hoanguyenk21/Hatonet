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
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 100)->unique();
            $table->integer('parent')->default(0);
            $table->integer('user_id');
            $table->tinyText('type')->default(App\Models\Taxonomy::TAXONOMY_TYPE['POST']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
};
