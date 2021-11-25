<?php
    session_start();
    include 'cabecalho.php';
    include 'js/mensagens.php';
    include 'js/mensagens_usuario.php';
    include 'sql_dashboard.php';
?>

<h11><i class="fas fa-chart-pie"></i> Dashboard</h11>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>
<div class="div_br"> </div>

<div class="row">
    Ano:
    <form type="Post">
    <div class="col-md-8 input-group">
        <input class="input-group form-control " type="text" id="ano_filtro" name="ano_filtro" required>
        <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
    </form>
</div>

<?php
//echo $row_qtd['qtd'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){   
    $temp_v_valor = @$_POST['ano_filtro'];						
    header('Location: dashboard.php.php?pagina=1&filtro=' . $temp_v_valor);	
}

?>

<div class="row justify-content-center" >
    <div style='width: 100%'>
        <canvas id='myChart'></canvas>
            <script>            
                var ctx = document.getElementById('myChart');
                ctx.height = 80;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [<?php
                                      $mes = 1;
                                      while($mes <12){
                                         echo "'" . date('M', strtotime('01-'. $mes .'-2000')) . "',";
                                         $mes = $mes + 1;
                                     }
                                  ?>],
                        datasets: [                            
                            
                            <?php 
                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                while($row_oco = mysqli_fetch_array($result_oco)){

                                    $consulta_oco_serv = "SELECT res.*, 
                                                          SUM(43200) AS MINUTOS_TOTAIS_MES, 
                                                          IFNULL(SUM(TIMESTAMPDIFF(MINUTE, oco.DT_INICIO, oco.DT_FIM)),0) AS MINUTOS_FORA_MES,
                                                          IFNULL(ROUND((1-(SUM(TIMESTAMPDIFF(MINUTE, oco.DT_INICIO, oco.DT_FIM))/SUM(43200)))*100,2),100) AS DISPONIBILIDADE
                                                          FROM (
                                                            SELECT aux_mes.mes AS MES, YEAR(os.DT_INICIO) AS ANO,
                                                            sv.CD_SERVICO, sv.SERVICO, sv.RGB, sv.SN_TI
                                                            FROM aux_mes
                                                            LEFT JOIN servicos sv
                                                            ON 1 = 1
                                                            LEFT JOIN ocorrencias_sistema os
                                                            ON os.CD_SERVICO = sv.CD_SERVICO
                                                            WHERE YEAR(os.DT_INICIO) = IFNULL(" . $valor . ", YEAR(SYSDATE()))
                                                            AND os.CD_SERVICO = " . $row_oco['CD_SERVICO'] . "
                                                            ORDER BY aux_mes.mes ASC) res
                                                            LEFT JOIN ocorrencias_sistema oco
                                                            ON oco.CD_SERVICO = res.CD_SERVICO
                                                            AND res.ANO = YEAR(oco.DT_INICIO)
                                                            AND res.MES = MONTH(oco.DT_INICIO)                         
                                                            GROUP BY res.MES, res.ANO, res.CD_SERVICO, res.SERVICO, res.RGB, res.SN_TI";
                            ?>
                                {

                                    label: <?php echo "'" . $row_oco['SERVICO'] . "',"; ?>
                                        data: [<?php
                                                $result_oco_serv = mysqli_query($conn ,$consulta_oco_serv);
                                                while($row_oco_serv = mysqli_fetch_array($result_oco_serv)){
                                                    echo "'" . $row_oco_serv['DISPONIBILIDADE'] . "',";
                                                }
                                            ?>],
                                        borderWidth: 2,
                                        pointStyle: 'rectRot',
                                        pointBorderWidth: 3,
                                        pointHoverBorderWidth: 4,
                                        backgroundColor: [
                                            <?php
                                                            $result_oco_serv = mysqli_query($conn ,$consulta_oco_serv);
                                                            while($row_oco_serv = mysqli_fetch_array($result_oco_serv)){
                                                                echo "'rgba". $row_oco['RGB'] . "',";
                                                            }
                                            ?>
                                        ],
                                        borderColor: [
                                            <?php
                                                            $result_oco_serv = mysqli_query($conn ,$consulta_oco_serv);
                                                            while($row_oco_serv = mysqli_fetch_array($result_oco_serv)){
                                                                echo "'rgba". $row_oco['RGB'] . "',";
                                                            }
                                            ?>
                                        ],
                                        pointBackgroundColor: [<?php
                                                $result_oco_serv = mysqli_query($conn ,$consulta_oco_serv);
                                                while($row_oco_serv = mysqli_fetch_array($result_oco_serv)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                            ?>],
                                        pointBorderColor: [<?php
                                                            $result_oco_serv = mysqli_query($conn ,$consulta_oco_serv);
                                                            while($row_oco_serv = mysqli_fetch_array($result_oco_serv)){
                                                                echo "'rgba". $row_oco['RGB'] . "',";
                                                            }
                                            ?>],
                                },
                      
                        
                            <?php
                                } 
                            ?>                       
                        ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        //beginAtZero: true,
                                    }
                                }]
                            }
                        }
                    });
                    </script>
    </div>
</div>
<?php 
include 'rodape.php';
?>
