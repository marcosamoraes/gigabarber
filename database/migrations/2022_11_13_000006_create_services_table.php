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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('client_uuid')->constrained('clients', 'uuid');
            $table->foreignUuid('category_uuid')->constrained('categories', 'uuid');
            $table->string('title', 20);
            $table->string('description', 100)->nullable();
            $table->decimal('value', 10, 2);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('services');
    }
};
