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

    if(@$_SESSION['cd_usu'] != ''){

        $consulta_count_mes = "SELECT * FROM servicos";

    }else{        

        $consulta_count_mes = "SELECT * FROM servicos WHERE sn_ti <> 'S'";
    }
    
    $result_count_mes = mysqli_query($conn, $consulta_count_mes);

    while($row_count_mes = mysqli_fetch_array($result_count_mes)){

        $cd_serv = $row_count_mes['cd_servico'];

        echo '</br><div class="row justify-content-center">';       

            if($row_count_mes['sn_ti'] == 'S'){

                echo '<div class="col-md-11" style="border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(80, 9, 165);">';

            }else{

                echo '<div class="col-md-11" style="border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(128, 191, 255);">';
            }
            

                echo '<div class="col-md-12" style="text-align: center !important;">
                      <b style="font-size: 16px; color: #444444; text-align: left !important;">' . $row_count_mes['servico'] .'</b></br>'; 
                    
                    ////////////////////////
                    //BARRAS STATUS DIARIO//
                    //////////////////////// 
                    
                    $consulta_barras = "SELECT * FROM vw_status_diario WHERE cd_servico = $cd_serv 
                                        ORDER BY                                        
                                        substr(dia,7,4) * 1 ASC,
                                        substr(dia,4,2) * 1 ASC,
                                        substr(dia,1,2) * 1 ASC";

                    $result_barras = mysqli_query($conn, $consulta_barras);    

                    while($row_barras = mysqli_fetch_array($result_barras)){

                        if($row_barras['qtd_ocorrencias'] >= 1){

    ?>  
                            <!-------->
                            <!--ERRO-->
                            <!-------->                           

                            <a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" 
                            title="<?php echo $row_barras['dia']; ?>" 
                            data-content="
                                <?php 

                                    $consulta_erro = "SELECT * FROM vw_status_diario_detalhe 
                                                      WHERE cd_servico = $cd_serv
                                                      AND dia = '" . $row_barras['dia'] . "'";

                                    $result_erro = mysqli_query($conn, $consulta_erro);    

                                    while($row_erro = mysqli_fetch_array($result_erro)){                                                

                                        echo 'Problema: '. $row_erro['ds_ocorrencia'];
                                        echo '</br>Início: '. $row_erro['dt_inicio_conv'];

                                        if(isset($row_erro['dt_fim_conv'])){

                                            echo '</br>Fim: '. $row_erro['dt_fim_conv'] . '</br>';

                                        }else{

                                            echo '</br>Fim: Em correção' . '</br>';
                                        }                                       

                                    }
                                ?>
                            ">

                            <?php 

                                if($row_barras['tp_ocorrencia'] == 'M'){

                                    //MANUTENCAO
                                    echo '<img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_manu.png" height="25px" width="5px" class="d-inline-block align-top" > </a>';

                                }else{

                                    //ERRO
                                    echo '<img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_erro.png" height="25px" width="5px" class="d-inline-block align-top" > </a>';
                                
                                }

                            ?>
                            

<?php
                        }else{

                            //////
                            //OK//
                            //////

                            echo '<a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" title="'. $row_barras['dia'] .'" 
                            data-content="Nenhum problema relatado nesse dia">
                            <img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_ok.png" height="25px" width="5px" class="d-inline-block align-top" > </a>';

                        }     
                    }             
                   
                    ////////////////////////
                    //ESTABILIDADE SERVICO//
                    ////////////////////////

                    $consulta_estabilidade = "SELECT * FROM vw_estabilidade_total WHERE cd_servico = $cd_serv";
                    $result_estabilidade = mysqli_query($conn, $consulta_estabilidade);
                    $row_estabilidade = mysqli_fetch_array($result_estabilidade);

                    echo '<center>' . $row_estabilidade['porc_estab'] . '% de estabilidade (Últimos 90 dias) </center>';
?>
                
                </div>
            
            </div>

        </div>       

    <?php } ?>

<!----------------------->
<!--DETALHE ANO MÊS DIA-->
<!----------------------->    
</br>
<div class="row justify-content-center" style="background-color: #f9f9f9;">
    <div class="col-md-11" >
        
        <?php

            ///////
            //ANO//
            ///////

            if(@$_SESSION['cd_usu'] != ''){

                $consulta_anos = "SELECT DISTINCT substr(dia,7,4) AS ano FROM vw_status_diario_detalhe";
        
            }else{                

                $consulta_anos = "SELECT DISTINCT substr(dia,7,4) AS ano FROM vw_status_diario_detalhe  WHERE sn_ti <> 'S'";

            }            

            $result_anos = mysqli_query($conn, $consulta_anos);    

            while($row_anos = mysqli_fetch_array($result_anos)){

        ?>
                <div class="col-md-12" style="border-radius: 3px; color : #fff; background-color :#6996EF;">
                    <h3 style="font-size: 24px;"><?php echo $row_anos['ano'];?></h3>
                </div>

        <?php 

                ///////
                //MES//
                ///////

                if(@$_SESSION['cd_usu'] != ''){

                    $consulta_mes = "SELECT DISTINCT substr(dia,4,2) AS mes FROM vw_status_diario_detalhe
                                 WHERE substr(dia,7,4) = " . $row_anos['ano'];
            
                }else{       
                    
                    $consulta_mes = "SELECT DISTINCT substr(dia,4,2) AS mes FROM vw_status_diario_detalhe
                                 WHERE substr(dia,7,4) = " . $row_anos['ano'] .
                                 " AND sn_ti <> 'S'";
    
                }   

                $result_mes = mysqli_query($conn, $consulta_mes);    

                while($row_mes = mysqli_fetch_array($result_mes)){
        ?>

                    <div style="padding: 0px !important; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">
                                                
                        <h4><?php echo $row_mes['mes'] . '/' . $row_anos['ano']; ?></h4>
                        
                    </div>

        <?php 
                    ///////
                    //DIA//
                    ///////

                    if(@$_SESSION['cd_usu'] != ''){

                        $consulta_dias = "SELECT DISTINCT substr(vd.dia,1,2) as dia_aux,
                                      substr(vd.dia,4,2) AS mes_aux,
                                      substr(vd.dia,7,4) AS ano_aux,
                                      DATE_FORMAT(vd.dt_inicio, '%d/%m/%Y') AS dt_inicio
                                      FROM vw_status_diario_detalhe vd
                                      WHERE substr(vd.dia,7,4) = " . $row_anos['ano'] . 
                                      " AND substr(vd.dia,4,2)  = " . $row_mes['mes'];
                
                    }else{       

                        $consulta_dias = "SELECT DISTINCT substr(vd.dia,1,2) as dia_aux,
                                      substr(vd.dia,4,2) AS mes_aux,
                                      substr(vd.dia,7,4) AS ano_aux,
                                      DATE_FORMAT(vd.dt_inicio, '%d/%m/%Y') AS dt_inicio
                                      FROM vw_status_diario_detalhe vd
                                      WHERE substr(vd.dia,7,4) = " . $row_anos['ano'] . 
                                      " AND substr(vd.dia,4,2)  = " . $row_mes['mes'] .
                                      " AND sn_ti <> 'S'";        
                    }   

                    $result_dias = mysqli_query($conn, $consulta_dias);    

                    while($row_dias = mysqli_fetch_array($result_dias)){                                        

                        $count_script = $row_dias['ano_aux'] . $row_dias['mes_aux'] . $row_dias['dia_aux'];
                        $data_extensa = $row_dias['dia_aux'] . '/' . $row_dias['mes_aux'] . '/' . $row_dias['ano_aux'];
        ?>
                        <div class="col-md-4" style="text-align: left;" onclick="mostrar_dia<?php echo $count_script;?>()" >
                            <div id="seta-<?php echo $count_script;?>">
                                <h5><?php echo $data_extensa . ' <i class="fas fa-chevron-right" ></i>';?></h5>
                            </div>
                            <div  id="baixo-<?php echo $count_script;?>">
                                <h5><?php
                                    echo $data_extensa . ' <i class="fas fa-chevron-down"></i>';
                                ?></h5>
                            </div>
                        </div>
                                                            
                            <div class="col-md-9">
                                <div class="col-md-12" style="text-align: left; margin-top: 20px !important; margin-bottom: 20px; padding: 0px; background-color : #fff; border-style: solid; border-radius: 5px;border-width: thin; border-color: #6996EF; "  id= "<?php echo $count_script;?>">
                                    
                                    <?php

                                        ////////////////
                                        //DETALHE DIAS//
                                        ////////////////

                                        if(@$_SESSION['cd_usu'] != ''){

                                            $consulta_dias_detalhes = "SELECT *
                                            FROM vw_status_diario_detalhe vd
                                            WHERE substr(vd.dia,7,4) = " . $row_anos['ano'] . 
                                            " AND substr(vd.dia,4,2)  = " . $row_mes['mes'] .      
                                            " AND substr(vd.dia,1,2)  = " . $row_dias['dia_aux'];
                                    
                                        }else{       

                                            $consulta_dias_detalhes = "SELECT *
                                            FROM vw_status_diario_detalhe vd
                                            WHERE substr(vd.dia,7,4) = " . $row_anos['ano'] . 
                                            " AND substr(vd.dia,4,2)  = " . $row_mes['mes'] .      
                                            " AND substr(vd.dia,1,2)  = " . $row_dias['dia_aux'] .
                                            " AND sn_ti <> 'S'";

                                        }   

                                        $result_dias_detalhes = mysqli_query($conn, $consulta_dias_detalhes); 

                                        while($row_dia_while_detalhes = mysqli_fetch_array($result_dias_detalhes)){
                                        
                                            ?>
                                            
                                                <h6>
                                                    
                                                    <?php 
    
                                                        $tp_ocorr = $row_dia_while_detalhes['tp_ocorrencia']; 
    
                                                        $cor_barra = "#6996EF";
                                                        $aviso = "";
    
                                                        if($tp_ocorr == 'M'){
    
                                                            $cor_barra = "#FF970A";
    
                                                            $aviso = "<i class='fas fa-info-circle' style='font-size: 14px;'></i> 
                                                                        Manutenção Preventiva";
                                                            
                                                        }
                                                    
                                                        echo "<div style='background-color: " . $cor_barra . "; color: #ffffff; text-align:center;'>";
                                                            echo $row_dia_while_detalhes['servico'] . ' - ' . $row_dia_while_detalhes['titulo'] . ' ' . $aviso;                                                                                   
    
                                                        echo "</div>";
    
                                                        echo "<div style='padding: 10px;'>";
    
                                                            echo 'Problema:</br>'. $row_dia_while_detalhes['ds_ocorrencia'];
                                                            //echo $row_dia_while['ds_detalhada'];
                                                            if(@$row_dia_while_detalhes['ds_detalhada'] == ''){
                                                                echo '</br></br>Solução:</br>Em correção';
                                                            }else{
                                                                echo '</br></br>Solução:</br>'. $row_dia_while_detalhes['ds_detalhada'];
                                                            }
    
                                                            if($row_dia_while_detalhes['dt_fim'] == '1970-01-01 01:00:00'  || $row_dia_while_detalhes['dt_fim'] == ''){
                                                                echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia_while_detalhes['dt_inicio'])) .' Fim: Em correção';
                                                            }else{
                                                                echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia_while_detalhes['dt_inicio'])) .' Fim: '. date('d/m/Y h:i:s', strtotime($row_dia_while_detalhes['dt_fim']));
                                                            }
    
                                                        echo "</div>";
                                                    
                                                    ?>
                                                
                                                </h6>
                                    
                                    <?php } ?>                                                                     

                                </div>
                            </div>
                        
                        <script>

                            var dia<?php echo $count_script;?> = document.getElementById("<?php echo $count_script;?>");
                            var seta_baixo<?php echo $count_script;?> = document.getElementById("baixo-<?php echo $count_script;?>");
                            var seta<?php echo $count_script;?> = document.getElementById("seta-<?php echo $count_script;?>");

                            seta_baixo<?php echo $count_script; ?>.style.display = 'none';
                            dia<?php echo $count_script; ?>.style.display = 'none';

                            var aberto;
                            function mostrar_dia<?php echo $count_script;?>(){
                                if(dia<?php echo $count_script;?>.style.display == 'none'){    
                                    dia<?php echo $count_script;?>.style.display = 'block';
                                    seta_baixo<?php echo $count_script;?>.style.display = 'block';
                                    seta<?php echo $count_script;?>.style.display = 'none';
                                }else{
                                    dia<?php echo $count_script;?>.style.display = 'none';
                                    seta_baixo<?php echo $count_script;?>.style.display = 'none';
                                    seta<?php echo $count_script;?>.style.display = 'block';
                                }
                            }

                        </script>
        <?php
                    }

        ?>
                    
        <?php 
                }

            }

        ?>

        </br>
        </br>
        </br>  
        
        </div>
        
    </div>
</div>

<?php

    include "rodape_oco.php";

?>