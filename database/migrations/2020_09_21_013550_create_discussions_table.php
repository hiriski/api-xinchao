<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            /**
             * $table->string('slug')->unique();
             */
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('hits')->default(0);
            $table->softDeletes();
            $table->timestamps();

            /** foreign keys */
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('topic_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('discussions');
    }
}
