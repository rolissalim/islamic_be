<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCityUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_user', function (Blueprint $table) {
            $table->string('id', 100)->primary();         
            $table->string('user_id', 100)->index()->nullable();
            $table->string('city_id', 100)->index()->nullable();
            $table->timestamps();

            $table->foreign('city_id')
                    ->references('id')
                    ->on('city')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('city_user');

        Schema::table('city_user', function(Blueprint $table) {
            $table->dropForeign('city_user_city_id_foreign');
        });

        Schema::table('city_user', function(Blueprint $table) {
            $table->dropIndex('city_user_city_id_foreign');
        });

        Schema::table('city_user', function(Blueprint $table) {
            $table->string('city_id')->change();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('city_user_users_id_foreign');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropIndex('city_user_users_id_foreign');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->string('user_id')->change();
        });
    }
}
