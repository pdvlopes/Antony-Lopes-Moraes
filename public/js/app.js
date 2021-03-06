$(function() {


    $('#Empresa').change(function(event) {
        var empresa = event.currentTarget.value;
        Codempresa = empresa.substr(0, 1);

        $.ajax({
            typ: 'get',
            url: '/Empresa/Seleciona/',
            data: { Codempresa: Codempresa },
            datatype: 'json',
            success: function(retorno) {

                $.each(retorno, function(Id, val) {
                    console.log(val);
                });

            }
        });
    });

    $('#PesquisaNome').keydown(function(e) {

        var buscacliente = $(this).val();

        switch (e.keyCode) {

            case 113:
                $('#Limpar').focus();
            case 120:
                $('#Finalizar').focus();
            case 13:
                {
                    $('#resultado_cliente').html("");
                    if (buscacliente.length > 0)
                        $.ajax({
                            type: 'get',
                            url: "/Clientes/PesquisaNome/",
                            data: { 'Nome': buscacliente },
                            datetype: 'json',

                            success: function(retorno) {

                                if (retorno.Clientes.length > 0) {

                                    $.each(retorno.Clientes, function(Id, val) {
                                        if (val.Nome === '') {
                                            Nome = val.Razao;
                                        } else {
                                            Nome = val.Nome;
                                        }
                                        if (val.Cpf === '') {
                                            Cpf = val.Cnpj;
                                        } else {
                                            Cpf = val.Cnpj;
                                        }
                                        $('#resultado_cliente').append(' <a style ="color:red;" href="#"" id=' + val.Id + '>' + Nome + ' | CNPJ: ' + Cpf + '</a><p></p>');

                                    });

                                } else {
                                    $('#resultado_cliente').html("<p>N??o h?? Dados para esta consulta.</p>");
                                }
                            }
                        });
                }
        }
    });



    $('#buscar').keydown(function(e) {

        var buscatexto = $(this).val();

        switch (e.keyCode) {

            case 113:
                $('#Limpar').focus();
            case 120:
                $('#Finalizar').focus();
            case 13:
                {
                    $('#resultado_busca').html("");
                    if (buscatexto.length > 0)
                        $.ajax({
                            type: 'get',
                            url: "/Produtos/LocDesc/",
                            data: { 'Descricao': buscatexto },
                            datetype: 'json',

                            success: function(retorno) {

                                if (retorno.Produtos.length > 0) {

                                    $.each(retorno.Produtos, function(Id, val) {

                                        $('#resultado_busca').append(' <a href="#"" id=' + val.Id + '>' + val.Descricao + ' | R$' + val.ValorUnitario + '</a><p></p>');

                                    });

                                } else {
                                    $('#resultado_busca').html("<p>N??o h?? Dados para esta consulta.</p>");
                                }
                            }
                        });
                }
        }
    });


    $('body').on('click', '#resultado_busca a', function() {

        var dadosProduto = $(this).attr('id');
        var splitdados = dadosProduto.split(':');

        quantidade = prompt('Digite a quantidade: ');
        Peso = prompt('Digite o Peso: ');
        Preco = prompt('Digite o Pre??o: ');

        if ((!isNaN(quantidade)) && (quantidade > 0)) {
            if ((!isNaN(Peso)) && (Peso > 0))
                if ((!isNaN(Preco)) && (Preco > 0))

                    $.ajax({
                    method: 'get',
                    url: '/Produtos/Inserir',
                    data: { id: splitdados[0], 'Quantidade': quantidade, 'Preco': Preco, 'Peso': Peso },
                    datetype: 'json',
                    success: function(retorno) {
                        window.location.href = '/Pedidos/Carrinho';

                    }
                });
        } else
            alert('Digite um n??mero v??lido.');


    });
});


$('body').on('click', '#resultado_cliente a', function() {

    var dadosCliente = $(this).attr('id');
    var splitdados = dadosCliente.split(':');

    $.ajax({
        method: 'get',
        url: '/Clientes/Inserir',
        data: { id: splitdados[0] },
        datetype: 'json',
        success: function(retorno) {
            window.location.href = '/Pedidos/Carrinho';
        }
    });



});