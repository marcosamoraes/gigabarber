<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->foreignUuid('client_id')->constrained();
            $table->string('cep', 8);
            $table->string('address', 50);
            $table->string('number', 4);
            $table->string('area', 50);
            $table->string('complement', 50)->nullable();
            $table->string('city', 50);
            $table->string('state', 2);
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
        Schema::dropIfExists('client_addresses');
    }
};
