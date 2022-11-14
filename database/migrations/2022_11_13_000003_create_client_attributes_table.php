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
        Schema::create('client_attributes', function (Blueprint $table) {
            $table->foreignUuid('client_uuid')->constrained('clients', 'uuid')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('public_email')->nullable();
            $table->string('image')->default('/storage/book-bg.jpg');
            $table->string('primary_color')->default('#9E8A78');
            $table->string('text_color')->default('#FFF');
            $table->text('description_footer')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->text('opening_hours')->nullable();
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
        Schema::dropIfExists('client_attributes');
    }
};
