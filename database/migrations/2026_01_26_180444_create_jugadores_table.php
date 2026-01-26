<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('jugadores', function (Blueprint $table) {
            $table->id();

            $table->string('nom');
            $table->unsignedInteger('edat');
            $table->string('posicio');

            $table->foreignId('equip_id')
                  ->constrained('equips')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
