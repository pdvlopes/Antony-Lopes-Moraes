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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Nome',200);
            $table->string('Cnpj',15);
            $table->string('Cpf',15);
            $table->string('Rg',20);
            $table->string('Ie',20);
            $table->string('Razao',200);
            $table->string('Fantasia',200);
            $table->string('Endereco',200);
            $table->string('Bairro',100);
            $table->string('Cidade',100);
            $table->integer('Numero');
            $table->string('Cep',15);
            $table->string('UF',5);
            $table->string('Telefone',20);
            $table->string('Email',100);
            $table->string('Contato',100);
            $table->string('Prazo',100);
            $table->string('Observacao',200);
            $table->string('Conta',20);
            $table->string('Agencia',20);
            $table->string('Tipo',50);
            $table->integer('CodigoVendedor');
            $table->decimal('Limite',19,2);
            $table->string('Bloqueio');
            $table->string('Exterior');
            $table->string('Juridico');
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
        Schema::dropIfExists('clientes');
    }
};
