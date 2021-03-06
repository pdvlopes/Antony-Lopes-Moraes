<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id', 'Nome', 'Cnpj','Cpf', 'Ie','Rg', 'Razao', 'Fantasia', 
    'Endereco', 'Bairro', 'Cidade', 'Cep', 'Telefone', 'Email', 'Contato', 'Prazo',
     'Observacao', 'UF','Conta', 'Agencia','Numero', 'Tipo', 'Limite', 'Exterior', 
     'Juridico'];


}
