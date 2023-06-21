<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colabora', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('habilitado')->default(1);
            $table->foreignId('diagrama_id')
            ->nullable()
            ->constrained('diagrama')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnUpdate()
            ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colabora');
    }
}
