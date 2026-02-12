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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();

            // Estadi on es juga el partit
            $table->foreignId('estadi_id')
                  ->constrained('estadis')
                  ->cascadeOnDelete();

            // Equips
            $table->foreignId('equip_local_id')
                  ->constrained('equips')
                  ->cascadeOnDelete();

            $table->foreignId('equip_visitant_id')
                  ->constrained('equips')
                  ->cascadeOnDelete();

            // Resultat (ex: "2 - 1")
            $table->string('resultat', 10);

            $table->timestamps();

           
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
