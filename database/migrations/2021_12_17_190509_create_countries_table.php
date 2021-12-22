<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Country')->unique();
            $table->string('CountryCode');
            $table->string('Slug')->unique();
            $table->integer('NewConfirmed');
            $table->integer('TotalConfirmed');
            $table->integer('NewDeaths');
            $table->integer('TotalDeaths');
            $table->integer('NewRecovered');
            $table->integer('TotalRecovered');
            $table->date('Date');
            $table->dateTime();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
