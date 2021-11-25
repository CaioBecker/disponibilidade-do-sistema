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
                                     $result_oco = mysqli_query($conn ,$consulta_oco);
                                     while($row_oco = mysqli_fetch_array($result_oco)){
                                         echo "'" . $row_oco['MES'] . "',";
                                     }
                                  ?>],
                        datasets: [{
                        label: 'Resultado',
                            data: [<?php
                                    $result_oco = mysqli_query($conn ,$consulta_oco);
                                     while($row_oco = mysqli_fetch_array($result_oco)){
                                         echo "'" . $row_oco['DISPONIBILIDADE'] . "',";
                                     }
                                  ?>],
                            borderWidth: 2,
                            pointStyle: 'rectRot',
                            pointBorderWidth: 3,
                            pointHoverBorderWidth: 4,
                            backgroundColor: [
                                <?php
                                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                                while($row_oco = mysqli_fetch_array($result_oco)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                  ?>
                            ],
                            borderColor: [
                                <?php
                                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                                while($row_oco = mysqli_fetch_array($result_oco)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                  ?>
                            ],
                            pointBackgroundColor: [<?php
                                    $result_oco = mysqli_query($conn ,$consulta_oco);
                                     while($row_oco = mysqli_fetch_array($result_oco)){
                                        echo "'rgba". $row_oco['RGB'] . "',";
                                     }
                                  ?>],
                            pointBorderColor: [<?php
                                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                                while($row_oco = mysqli_fetch_array($result_oco)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                  ?>],
                        },{
                            label: 'Meta',
                            data: [<?php
                                    $result_oco = mysqli_query($conn ,$consulta_oco);
                                    while($row_oco = mysqli_fetch_array($result_oco)){
                                         echo "'90',";
                                    }
                                    ?>],
                            borderWidth: 2,
                            pointStyle: 'rectRot',
                            pointBorderWidth: 3,
                            pointHoverBorderWidth: 4,
                            backgroundColor: [
                                <?php
                                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                                while($row_oco = mysqli_fetch_array($result_oco)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                  ?>
                            ],
                            borderColor: [
                                <?php
                                                $result_oco = mysqli_query($conn ,$consulta_oco);
                                                while($row_oco = mysqli_fetch_array($result_oco)){
                                                    echo "'rgba". $row_oco['RGB'] . "',";
                                                }
                                  ?>

                            ],  
                            pointBackgroundColor: [<?php
                                                    $result_oco = mysqli_query($conn ,$consulta_oco);
                                                    while($row_oco = mysqli_fetch_array($result_oco)){
                                                        echo "'rgba". $row_oco['RGB'] . "',";
                                                    }
                                                   ?>], 
                            pointBorderColor: [<?php
                                                    $result_oco = mysqli_query($conn ,$consulta_oco);
                                                    while($row_oco = mysqli_fetch_array($result_oco)){
                                                        echo "'rgba". $row_oco['RGB'] . "',";
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
