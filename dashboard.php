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
    <div class="col-md-12">

    </div>
</div>

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
                                     while($row_resultado = @oci_fetch_array($result_resultado)){
                                         echo "'" . $row_resultado['DS_PERIODO'] . "',";
                                     }
                                  ?>],
                        datasets: [{
                        label: 'Resultado',
                            data: [<?php
                                    @oci_execute($result_resultado);
                                     while($row_resultado = @oci_fetch_array($result_resultado)){
                                         echo "'" . $row_resultado['VL_LANCAMENTO'] . "',";
                                     }
                                  ?>],
                            borderWidth: 2,
                            pointStyle: 'rectRot',
                            pointBorderWidth: 3,
                            pointHoverBorderWidth: 4,
                            backgroundColor: [
                                'rgba(70, 165, 212, 0.15)',
                            ],
                            borderColor: [
                                'rgba(70, 165, 212, 1)',
                            ],
                            pointBackgroundColor: [<?php
                                    @oci_execute($result_resultado);
                                     while($row_resultado = @oci_fetch_array($result_resultado)){
                                        echo "'rgba(70, 165, 212, 0.15)',";
                                     }
                                  ?>],
                            pointBorderColor: [<?php
                                                @oci_execute($result_resultado);
                                                while($row_resultado = @oci_fetch_array($result_resultado)){
                                                    echo "'rgba(70, 165, 212, 1)',";
                                                }
                                  ?>],
                        },{
                            label: 'Meta',
                            data: [<?php
                                    @oci_execute($result_resultado);
                                    while($row_resultado = @oci_fetch_array($result_resultado)){
                                         echo "'" . $row_resultado['VL_RANG_FIN_FAV'] . "',";
                                    }
                                    ?>],
                            borderWidth: 2,
                            pointStyle: 'rectRot',
                            pointBorderWidth: 3,
                            pointHoverBorderWidth: 4,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',

                            ],  
                            pointBackgroundColor: [<?php
                                                    @oci_execute($result_resultado);
                                                    while($row_resultado = @oci_fetch_array($result_resultado)){
                                                        echo "'rgba(255, 99, 132, 0.15)',";
                                                    }
                                                   ?>], 
                            pointBorderColor: [<?php
                                                    @oci_execute($result_resultado);
                                                    while($row_resultado = @oci_fetch_array($result_resultado)){
                                                        echo "'rgba(255, 99, 132, 1)',";
                                                    }
                                                   ?>], 
                                
                            }]
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
