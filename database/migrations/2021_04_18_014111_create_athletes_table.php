<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('athletes')) {
            Schema::create(
                'athletes',
                function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('name');
                    $table->string('age');
                    $table->foreignId('country_id')
                        ->constrained()
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
                    $table->foreignId('province_id')
                        ->constrained()
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
                    $table->foreignId('city_id')
                        ->constrained()
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
                    $table->timestamps();
                }
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('athletes')) {
            Schema::table(
                'athletes',
                function (Blueprint $table) {
                    $table->dropForeign(['country_id', 'province_id', 'city_id']);
                }
            );
        }
        Schema::dropIfExists('athletes');
    }
}
