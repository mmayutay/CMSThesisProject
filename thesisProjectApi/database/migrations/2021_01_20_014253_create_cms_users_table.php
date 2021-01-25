<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('birthday');
            $table->string('age');
            $table->string('address');
            $table->string('marital_status');
            $table->string('email');
            $table->string('contact_number');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('leader');
            $table->string('category');
            $table->string('isCGVIP');
            $table->string('isSCVIP');
            $table->string('auxilliary');
            $table->string('ministries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_users');
    }
}
