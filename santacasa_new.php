<?php

    session_start();
    include "cabecalho_oco.php";
    include 'conexao.php';

?>

<!------------------>
<!--DETALHES ATUAL-->
<!------------------>

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <?php

            $consulta_hj = "SELECT * FROM vw_status_atual where qtd_ocorrencias >= 1";

            $result_hj = mysqli_query($conn, $consulta_hj);
            
            while($row_hj = mysqli_fetch_array($result_hj)){

                $tp_ocorr = $row_hj['tp_ocorrencia']; 

                $cor_barra = "#cf6868";
                $aviso = "";

                if($tp_ocorr == 'M'){

                    $cor_barra = "#FF9D0A";

                    $aviso = "<i class='fas fa-info-circle' style='font-size: 14px;'></i> 
                            Manutenção Preventiva";
                                                                                        
                }

                ?>
                
                <div class="row-md">
                    <div class="col-md-12 " style="color: #fff; background-color: <?php echo$cor_barra; ?> ; text-align: center;"> <?php
                        echo $row_hj['servico'] . ' - ' . $row_hj['titulo'] . ' ' . $aviso;
                ?>
                    </div>
                    <div class="col-md-12 caixa_aviso" > <?php
                    echo 'Problema: '. $row_hj['ds_ocorrencia'];

                ?>
                    </div>
                    <div class="col-md-12 caixa_aviso_b" > <?php
                    echo 'Fora do ar desde: '. date("d/m/Y H:i", strtotime($row_hj['dt_inicio']));
                
                ?>  
                    </div>
                </div>
            
            </br>
            
            <?php
            }
            ?>
            

    </div>
</div>  

<!---------------------->
<!--ESTABILIDADE ATUAL-->
<!---------------------->

<?php

    //STATUS GERAL

    if(@$_SESSION['cd_usu'] != ''){

        $consulta_servicos_ativos = "SELECT * FROM vw_status_atual";

    }else{        

        $consulta_servicos_ativos = "SELECT * FROM vw_status_atual WHERE sn_ti <> 'S'";

    }

    $result_servicos_ativos = mysqli_query($conn, $consulta_servicos_ativos);

    echo '<div class="row justify-content-center">';
        echo '<div class="col-md-11" style=" text-align: center; border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(128, 191, 255);">';

            echo '<center><b style="font-size: 16px; color: #444444; text-align: center !important;"> Disponibilidades Serviços </b></center>';
            
            while($row_serv_ativos = mysqli_fetch_array($result_servicos_ativos)){

                //ATIVO
                if($row_serv_ativos['tp_ocorrencia'] == 'V'){

                    echo '  ' . $row_serv_ativos['servico'] . ' <i style="color: green;" class="fas fa-circle"></i>  ';

                } else {

                    if($row_serv_ativos['tp_ocorrencia'] == 'M'){

                        //MANUTENCAO
                        echo '  ' . $row_serv_ativos['servico'] . ' <i style="color: orange;" class="fas fa-info-circle"></i> ';

                    }else{

                        //INATIVO                   
                        echo '  ' . $row_serv_ativos['servico'] . ' <i style="color: red;" class="fas fa-exclamation-circle"> </i>  ';
                    }
                }               
           
            }

        echo '</div>';
    echo '</div>';

?>

<!-------------------------->
<!--STATUS ULTIMOS 90 DIAS-->
<!-------------------------->

<?php

    include "rodape_oco.php";

?>