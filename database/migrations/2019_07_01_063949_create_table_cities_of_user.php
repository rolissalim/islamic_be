<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCitiesOfUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_of_user', function (Blueprint $table) {
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
        Schema::dropIfExists('cities_of_user');

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->dropForeign('cities_of_user_users_id_foreign');
        });

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->dropIndex('cities_of_user_users_id_foreign');
        });

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->string('user_id')->change();
        });

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->dropForeign('cities_of_user_city_id_foreign');
        });

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->dropIndex('cities_of_user_city_id_foreign');
        });

        Schema::table('cities_of_user', function(Blueprint $table) {
            $table->string('city_id')->change();
        });
    }
}
