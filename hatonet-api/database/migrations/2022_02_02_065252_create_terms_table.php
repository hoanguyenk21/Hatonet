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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 100)->unique();
            $table->tinyText('type')
                ->default(App\Models\Term::TERM_TYPE['POST']);
        });

        Schema::create('term_other', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('term_id');
            $table->bigInteger('other_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
};
