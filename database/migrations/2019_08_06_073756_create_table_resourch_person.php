<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResourchPerson extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('resource_person', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('fullname');
            $table->text('alamat')->nullable();
            $table->string('phonenumber', 15)->nullable();
            $table->string('education_degree')->nullable();
            $table->string('image')->nullable();
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
    public function down() {
        Schema::dropIfExists('resource_person');

        Schema::table('resource_person', function(Blueprint $table) {
            $table->dropForeign('resource_person_city_id_foreign');
        });

        Schema::table('resource_person', function(Blueprint $table) {
            $table->dropIndex('resource_person_city_id_foreign');
        });

        Schema::table('resource_person', function(Blueprint $table) {
            $table->string('city_id')->change();
        });
    }

}
