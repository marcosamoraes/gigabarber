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
        Schema::create('client_hours', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('client_uuid')->constrained('clients', 'uuid');
            $table->enum('day', ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo']);
            $table->time('open_time');
            $table->time('close_time');
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
        Schema::dropIfExists('client_hours');
    }
};
