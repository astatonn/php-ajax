 <!-- CAMPOS DE PESQUISA -->
 <div class="container">
    <h1>Listar Histórico</h1>
        <!-- CONSULTA SQL -->
        <?php 
            include "../functions/connectDB.php";
            include "../functions/nameDisplay.php";
            $connection = OpenCon (); // ABERTURA DE CONEXÃO
            $i=0; // CONTADOR PARA DISPLAY DE ID 

            // RECEBER DADOS DO JAVASCRIPT
            $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
            $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
            $historico_transacoes_mes = filter_input(INPUT_POST, 'historico_transacoes_mes', FILTER_SANITIZE_NUMBER_INT);
            $historico_transacoes_ano = filter_input(INPUT_POST, 'historico_transacoes_ano', FILTER_SANITIZE_NUMBER_INT);
            $historico_transacoes_tipo = filter_input(INPUT_POST, 'historico_transacoes_tipo', FILTER_SANITIZE_NUMBER_INT);

            // CALCULAR O INÍCIO DE VISUALIZAÇÃO
            $inicio = ($pagina*$qnt_result_pg) - $qnt_result_pg;
        
        if ($historico_transacoes_ano == 9999 && $historico_transacoes_mes == 13 && $historico_transacoes_tipo == 00){
            $sql = "SELECT * FROM `receita` UNION  ALL SELECT id, tipo, valor, data,observacao,fonte,login,gdhregistro, null FROM despesa ORDER BY gdhregistro DESC LIMIT $inicio, $qnt_result_pg;";
            $data = mysqli_query($connection, $sql);
            
            if (($data) AND ($data->num_rows !=0)){
        ?>

        <table class="table table-striped table-hover table-sm" id="historicotransacoes">
        <thead class="thead-dark">
            <th>id</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Observação</th>
            <th>Fonte</th>
            <th>Registrador por</th>
            <th>Data de Registro</th>
            <th></th>
            <th></th>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_row($data)){ ?>
            <?php echo '<td>'.$i.'</td>'; $i++; ?>
            <?php echo '<td>'.nameDisplay($row[1]).'</td>';?>
            <?php echo '<td>R$ '.$row[2].'</td>';?>
            <?php echo '<td>'.$row[3].'</td>';?>
            <?php echo '<td>'.$row[4].'</td>';?>
            <?php echo '<td>'.$row[5].'</td>';?>
            <?php echo '<td>'.$row[6].'</td>';?>
            <?php echo '<td>'.$row[7].'</td>';?>
            <td>V</td>
            <td>B</td>

        </tbody>
    
        <?php }

        // CONTADOR DE RESULTADOS PARA PAGINAÇÃO
        $soma = "SELECT COUNT(id) as num_result FROM uniaoregistro;";
        $result_pg = mysqli_query($connection, $soma);
        $row_pg = mysqli_fetch_assoc($result_pg);
        $qnt_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
        
        // LIMITAR LINKS ANTES E DEPOIS

        $max_links = 2;
        
        echo "<nav aria-label='paginacao'>";
        echo "</table><ul class='pagination'><li class='page-item'><a class='page-link'  href ='#' onclick='listar_resultados(1, $qnt_result_pg)'>Primeira</a></li>"; //DIRECIONA PARA A PRIMEIRA PÁGINA
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1;$pag_ant++){
            if ($pag_ant >= 1){
            echo "<li class='page-item'><a class='page-link' href ='#' onclick='listar_resultados($pag_ant, $qnt_result_pg)'>$pag_ant</a></li>"; // MOSTRA AS DUAS PÁGINAS ANTERIORES
            }
        }

        echo "<li class='page-item'><span class='page-link'>$pagina</span></li>"; // MOSTRA A PÁGINA ATUAL 

        for($pag_post = $pagina + 1; $pag_post <= $pagina + $max_links;$pag_post++){
            if ($pag_post <= $qnt_pg){
            echo "<li class='page-item'><a class='page-link' href ='#' onclick='listar_resultados($pag_post, $qnt_result_pg)'>$pag_post</a></li></nav>"; // MOSTRA AS DUAS PÁGINAS ANTERIORES
            }
        }

        echo "<li class='page-item'><a class='page-link'href ='#' onclick='listar_resultados($qnt_pg, $qnt_result_pg)'>Última</a></li></ul>"; // DIRECIONA PARA A ÚLTIMA PÁGINA 
    }
        else {
            echo '<div class="alert alert-danger" role="alert">
            Nenhum resultado encontrado.
          </div>';
        } 
    }
?>
    
</div>
