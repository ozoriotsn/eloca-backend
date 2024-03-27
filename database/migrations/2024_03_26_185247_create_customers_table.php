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
        Schema::disableForeignKeyConstraints();

        Schema::create('customers', function (Blueprint $table) {
            $table->bigInteger('recnum',20)->unique()->autoIncrement()->index()->unsigned();
            $table->decimal('empresa', 4, 0)->unsigned()->index();
            $table->decimal('codigo', 14, 0);
            $table->string('razao_social', 255);
            $table->enum('tipo', ["PJ","PF"]);
            $table->string('cpf_cnpj', 14);
            $table->foreign('empresa')->references('codigo')->on('companies');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
