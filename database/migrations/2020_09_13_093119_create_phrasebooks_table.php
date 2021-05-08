<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhrasebooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('phrasebooks', function (Blueprint $table) {
            $table->id();
            $table->string('id_ID')->comment('Bahasa Indonesia');
            $table->string('vi_VN')->comment('Tiếng Việt');
            $table->string('en_US')->nullable()->comment('(Optional) English');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')
                ->comment('Creator of this phrase');
            $table->unsignedBigInteger('updated_by')->nullable()
                ->comment('User who renew of this phrase');
            $table->unsignedTinyInteger('category_id');

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')
                ->references('id')->on('users')->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('phrasebook_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('phrasebooks');
    }
}
