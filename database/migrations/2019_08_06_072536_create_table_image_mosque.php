<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImageMosque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_mosque', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('path')->unique();
            $table->string('mosque_id', 100)->index()->nullable();
            $table->timestamps();

            $table->foreign('mosque_id')
                    ->references('id')
                    ->on('mosque')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_mosque');
        
        Schema::table('image_mosque', function(Blueprint $table) {
            $table->dropForeign('image_mosque_mosque_id_foreign');
        });

        Schema::table('image_mosque', function(Blueprint $table) {
            $table->dropIndex('image_mosque_mosque_id_foreign');
        });

        Schema::table('image_mosque', function(Blueprint $table) {
            $table->string('mosque_id')->change();
        });
    }
}
