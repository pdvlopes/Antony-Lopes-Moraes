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
        Schema::create('contas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Banco',100);
            $table->decimal('Saldo',19,2);
            $table->string('Agencia',20);
            $table->string('Tipo',20);
            $table->string('Conta',100);
            $table->string('Operacao',20);
            $table->string('Descricao',200);
            $table->integer('CodEmpresa');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_bancarias');
    }
};
