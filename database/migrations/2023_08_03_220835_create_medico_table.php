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
        Schema::create('medico', function (Blueprint $table): void {
            $table->id();
            $table->string('nome', 100);
            $table->string('especialidade', 100);
            $table->unsignedBigInteger('cidade_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cidade_id')->references('id')->on('cidades')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico');
    }
};
