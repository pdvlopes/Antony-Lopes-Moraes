<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Despesas;
use App\Classes\ObterDados;
use App\Http\Controllers\ContasBancariasController;

class DespesasController extends Controller
{
    public function Verificar($Dados)
    {

        if (empty($Dados->Total)) {
            echo "<script>
              alert('Preencha a Total');
              javascript:history.back();
            </script>";
            exit;
        }
        if (empty($Dados->Datarecebimento)) {
            echo "<script>
              alert('Preencha a Data do recebimento');
              javascript:history.back();
            </script>";
            exit;
        }
        if (empty($Dados->CodEmpresa)) {
            echo "<script>
              alert('Preencha a Descrição');
              javascript:history.back();
            </script>";
            exit;
        } else {
            return true;
        }
    }
    public function index()
    {
        $ObterDados = new ObterDados();

        return view('Despesas.Despesas', [
            'Empresas'
            =>  $ObterDados->ListaDeEmpresas(),
            'Fornecedor' =>  $ObterDados->ListaDeFornecedores(),
            'Contas' => $ObterDados->ListarContasBancarias(),
        ]);
    }

    public function create(Request $request)
    {
        $Contas = new ContasBancariasController();

        if ($this->Verificar($request)) {

            Despesas::create([
                'Barras' => $request->Barras,
                'Descricao' => $request->Descricao,
                'CodFornecedor' => Isset($request->CodFornecedor) ?Str::substr($request->CodFornecedor, 0, 1):0,
                'Total' => Str_replace(",", ".", $request->Total),
                'TotalDesconto' => isset($request->TotalDesconto) ? Str_replace(",", ".", $request->TotalDesconto) : 0,
                'TotalAcréscimo' => isset($request->TotalAcrescimo) ? Str_replace(",", ".", $request->TotalAcrescimo) : 0,
                'Vencimento' => $request->Vencimento,
                'CodGrupo' => Isset($request->CodGrupo) ? Str::substr($request->CodGrupo, 0, 1) : 0,
                'CodSubGrupo' =>  Isset($request->CodGrupo) ? Str::substr($request->SubGrupo, 0, 1) : 0,
                'Parcelas' => $request->Parcelas,
                'Dataemissao' => $request->Dataemissao,
                'Datarecebimento' => $request->Datarecebimento,
                'Boleta' => $request->boleta,
                'NotaFiscal' => $request->NotaFiscal,
                'Serie' => $request->Serie,
                'CodEmpresa' => Str::substr($request->CodEmpresa, 0, 1)
            ]);
            $Contas->Saque(Str::substr($request->Conta, 0, 1), $request->Total);
            return
                "<script>
                alert('Despesa Salva com sucesso!');
                location = '/Despesas/Novo;
              </script>";
        }
    }

    public function show($id)
    {
        $ObterDados = new ObterDados();

        $Despesas = Despesas::findOrFail($id);

        return view('/Despesas.Ver', [
            'Despesas' => $Despesas,
            'Empresas'
            =>  $ObterDados->ListaDeEmpresas(),
            'Fornecedor' =>  $ObterDados->ListaDeFornecedores()
        ]);
    }

    public function Listartodos(Request $request)
    {

        $Despesas = DB::table('despesas')->join(
            'empresas',
            'despesas.CodEmpresa',
            '=',
            'empresas.id'
        )->select('despesas.*', 'empresas.Razao as Razaoe', 'despesas.CodFornecedor as Razaof')->wherebetween('Datarecebimento', [$request->DataIni, $request->DataFim])->paginate(20);

        return view('/Despesas.Todos', ['Despesas' => $Despesas]);
    }

    public function update(Request $request, $id)
    {
        $Despesas = Despesas::findOrFail($id);

        if ($this->Verificar($request)) {
            $Despesas->Update([
                'Barras' => $request->Barras,
                'Descricao' => $request->Descricao,
                'CodFornecedor' => Isset($request->CodFornecedor) ?Str::substr($request->CodFornecedor, 0, 1):0,
                'Total' => Str_replace(",", ".", $request->Total),
                'TotalDesconto' => isset($request->TotalDesconto) ? Str_replace(",", ".", $request->TotalDesconto) : 0,
                'TotalAcréscimo' => isset($request->TotalAcrescimo) ? Str_replace(",", ".", $request->TotalAcrescimo) : 0,
                'Vencimento' => $request->Vencimento,
                'CodGrupo' => Str::substr($request->CodGrupo, 0, 1),
                'CodSubGrupo' => Str::substr($request->SubGrupo, 0, 1),
                'Parcelas' => $request->Parcelas,
                'Dataemissao' => $request->Dataemissao,
                'Datarecebimento' => $request->Datarecebimento,
                'Boleta' => $request->boleta,
                'NotaFiscal' => $request->NotaFiscal,
                'Serie' => $request->Serie,
                'CodEmpresa' => Str::substr($request->CodEmpresa, 0, 1)
            ]);

            return
                "<script>
          alert('Salvo com Sucesso!');
          location = '/Despesas/Todos';
      </script>";
        }
    }

    public function destroy($id)
    {
        $Despesas = Despesas::findOrFail($id);
        $Despesas->delete();

        return "<script>alert('Deletado com sucesso.');location = '/Despesas/Todos';</script>";
    }
}
