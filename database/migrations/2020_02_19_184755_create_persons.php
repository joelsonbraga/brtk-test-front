<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unique();
            $table->uuid('uuid')->unique();
            $table->string('cpf', 20)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 30)->unique();

            $table->index('email');
            $table->index('cpf');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
