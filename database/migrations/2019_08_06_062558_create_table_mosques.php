<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMosques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosque', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('fullname', 50)->unique();
            $table->text('address');
            $table->string('phonenumber', 20)->nullable()->unique();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('city_id', 100)->index()->nullable();
            $table->timestamps();

            $table->foreign('city_id')
                    ->references('id')
                    ->on('city')
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
        Schema::dropIfExists('mosque');
        
        Schema::table('mosque', function(Blueprint $table) {
            $table->dropForeign('mosque_city_id_foreign');
        });

        Schema::table('mosque', function(Blueprint $table) {
            $table->dropIndex('mosque_city_id_foreign');
        });

        Schema::table('mosque', function(Blueprint $table) {
            $table->string('city_id')->change();
        });
    }
}
