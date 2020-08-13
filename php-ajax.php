<!-- VERIFICAÇÃO DE SEGURANÇA DE USUÁRIO LOGAO -->
<?php
        session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['password']) == true) or $_SESSION['profile']!=1)
        {
            session_unset();
            session_destroy();
            echo '<script>alert ("Usuário não tem permissão para acessar essa página");
            window.location = "/siscofin/login.php";
            </script>';      
        }
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS PARA JAVASCRIPT -->
        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        
        <script>
                $('#submit').click(function(){
                
                $.ajax({
                    url: '../functions/historicotransacoes.php',
                    method: 'POST',
                    data: {
                        pagina : 1,
                        qnt_result_pg : 50,
                        historico_transacoes_mes : $('#meshistorico').val(),
                        historico_transacoes_ano : $('#historicoano').val(),
                        historico_transacoes_tipo : $('#tipohistorico').val()
                    },
                    success: function(result){
                        $('#show_data').html(result);
                    }
                });
                
            });
            
        </script>

        <title>Página Inicial</title>
    </head>
    <body>
    
    <!-- NAV BAR -->
    <nav>
        <ul>
            <li>
            <p>SisCoFin - A∴R∴L∴S∴ Esperança e progresso 164 - Nova Santa Rita, RS</p>
            </li>
            <li>
            Dashboard
            </li>
            <li>
            Cadastrar Irmão
            </li>
            <li>
            Gerar Relatório
            </li>
            <li>
            <a href="../adm_pages/historico.php">Histórico de transações</a>
            </li>
            <li>
            Contato
            </li>
            <li>
            Sair
            </li>
        </ul>
    </nav>
            
    <form class="form-inline" method="POST">
            <div class="form-group">
                <label for="historicoano" class="my-1 mr-2">Ano: </label>
                <select name="historicoano" class="custom-select my-1 mr-sm-2" id="historicoano" required>
                            <option value="9999">Todos os Anos</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                        </select>
            </div>
            <div class="form-group">
                <label for="meshistorico" class="my-1 mr-2">Mês: </label>
                <br>
                <select name="meshistorico" id="meshistorico" class="custom-select my-1 mr-sm-2" required>
                            <option value="13">Todos os Meses</option>
                            <option value="01">Jananeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                        <label for="meshistorico" class="my-1 mr-2">Mês: </label>
                <br>
                <select name="tipohistorico" id="tipohistorico" class="custom-select my-1 mr-sm-2" required>
                            <option value="00">Todos os tipos</option>
                            <option value="01">Receitas</option>
                            <option value="02">Despesas</option>
                        </select>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
            <span id="show_data"></span>
        
        


   
  </body>
</html>
