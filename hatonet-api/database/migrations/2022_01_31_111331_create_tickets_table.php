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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 100)->unique();
            $table->integer('term_id')->nullable();
            $table->integer('user_id');
            $table->timestamps();

            // status
            $table->enum('status', [
                'pending',
                'wait',
                'active',
                'confirm',
                'suspended',
            ])->default(App\Models\Ticket::TICKET_STATUS['OPEN']);

        });

        // foreign key tickets to user
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id');
            $table->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');
        });

        // table
        Schema::create('ticket_comment', function (Blueprint $table) {
            $table->id();
            $table->text('comment_content');
            $table->string('comment_attachment', 100)->nullable();
            $table->integer('user_id');
            $table->tinyInteger('comment_rating')->default(-1);
        });

        Schema::table('ticket_comment', function (Blueprint $table) {
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
