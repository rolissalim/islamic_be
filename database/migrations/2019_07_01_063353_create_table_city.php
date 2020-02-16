<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('fullname', 50);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('country_id', 100)->index()->nullable();
            $table->timestamps();

            $table->foreign('country_id')
                    ->references('id')
                    ->on('country')
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
        Schema::dropIfExists('city');
        Schema::table('city', function(Blueprint $table) {
            $table->dropForeign('city_country_id_foreign');
        });

        Schema::table('city', function(Blueprint $table) {
            $table->dropIndex('city_country_id_foreign');
        });

        Schema::table('city', function(Blueprint $table) {
            $table->string('country_id')->change();
        });
    }
}
