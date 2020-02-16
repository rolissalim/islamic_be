<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePost extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('post', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->text('theme');
            $table->text('text');
            $table->string('mosque_id', 100)->index()->nullable();
            $table->string('category_id', 100)->index()->nullable();
            $table->string('user_id', 100)->index()->nullable();
            $table->string('resource_person_id', 100)->index()->nullable();
            $table->string('path', 255)->nullable();
            $table->boolean('periodic')->default(false);
            $table->dateTime('post_time');
            $table->timestamps();

            $table->foreign('category_id')
                    ->references('id')
                    ->on('category')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

            $table->foreign('mosque_id')
                    ->references('id')
                    ->on('mosque')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');



            $table->foreign('resource_person_id')
                    ->references('id')
                    ->on('resource_person')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('post');

        Schema::table('post', function(Blueprint $table) {
            $table->dropForeign('post_mosque_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->dropIndex('post_mosque_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->string('mosque_id')->change();
        });

        Schema::table('post', function(Blueprint $table) {
            $table->dropForeign('post_category_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->dropIndex('post_category_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->string('category_id')->change();
        });

        Schema::table('post', function(Blueprint $table) {
            $table->dropForeign('post_resource_person_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->dropIndex('post_resource_person_id_foreign');
        });

        Schema::table('post', function(Blueprint $table) {
            $table->string('resource_person_id')->change();
        });
    }

}
