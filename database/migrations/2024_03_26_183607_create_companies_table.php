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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigInteger('recnum', 20)->unique()->autoIncrement()->index()->unsigned();
            $table->decimal('codigo', 4, 0)->unsigned()->index();
            $table->decimal('empresa', 4, 0);
            $table->string('sigla', 40);
            $table->string('razao_social', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
