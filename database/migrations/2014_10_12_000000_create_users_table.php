<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('status', 10)->nullable();
            $table->string('email')->unique();
            $table->string('phonenumber', 15)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status_account')->default(true);
            $table->string('image')->nullable();           
            $table->string('api_token');
            $table->string('password');
            $table->string('role_user_id', 100)->index()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $table->foreign('role_user_id')
        ->references('id')
        ->on('role_user')
        ->onDelete('cascade')
        ->onUpdate('cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_role_user_id_foreign');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropIndex('users_role_user_id_foreign');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->string('role_user_id')->change();
        });
    }
}
