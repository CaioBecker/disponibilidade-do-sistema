<?php
session_start();
$data = date("Y-m-d");
$data_ant = date("Y-m-d", strtotime('-89 days', strtotime($data)));

$data_while = $data_ant;
include "cabecalho_oco.php";

$count_script = 1;


//echo $rest;
?>

<div class="div_br"> </div>


<div class="row justify-content-center">
<div class="col-md-8">
    <?php
        $data_hj = date("Y-m-d H:i:s");
        include "sql_erro_hj.php";
        while($row_hj = mysqli_fetch_array($result_hj)){
            ?>
            
            <div class="row-md">
                <div class="col-md-12 " style="color: #fff; background-color: #cf6868; text-align: center;"> <?php
                    echo $row_hj['titulo'];
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

   
   
    <?php

        //STATUS GERAL

        $consulta_servicos_ativos = "SELECT res.cd_servico, REPLACE(res.servico, ' ', ' ') as servico,
                                     CASE 
                                       WHEN res.qtd_dt_inicio = qtd_dt_fim THEN 's'
                                       ELSE 'n'
                                     END AS sn_ativo
                                     FROM (SELECT serv.cd_servico, serv.servico, 
                                            count(dt_inicio) AS qtd_dt_inicio, count(dt_fim) as qtd_dt_fim
                                            FROM servicos serv
                                            INNER JOIN ocorrencias_sistema os
                                              ON os.cd_servico = serv.cd_servico
                                            GROUP BY serv.cd_servico, serv.servico) res";

        $result_servicos_ativos = mysqli_query($conn, $consulta_servicos_ativos);

        echo '</br><div class="row justify-content-center">';
            echo '<div class="col-md-11" style=" text-align: center; border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(128, 191, 255);">';

                echo '<center><b style="font-size: 16px; color: #444444; text-align: center !important;"> Disponibilidades Serviços </b></center>';
                
                while($row_serv_ativos = mysqli_fetch_array($result_servicos_ativos)){

                    //ATIVO
                    if($row_serv_ativos['sn_ativo'] == 's'){

                        echo '  ' . $row_serv_ativos['servico'] . ' <i style="color: green;" class="fas fa-circle"></i>  ';

                    } else {

                        //INATIVO                   
                        echo '  ' . $row_serv_ativos['servico'] . ' <i style="color: red;" class="fas fa-exclamation-circle"> </i>  ';
                        
                    }                 
                
                }

            echo '</div>';
        echo '</div>';

    $count_serv = 0;
    $consulta_count_mes = "SELECT * FROM servicos";
    $result_count_mes = mysqli_query($conn, $consulta_count_mes);


    while($row_count_mes = mysqli_fetch_array($result_count_mes)){

    
    $cd_serv = $row_count_mes['cd_servico'];
    echo '</br><div class="row justify-content-center">';
        echo '<div class="col-md-11" style="border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(128, 191, 255);">';

            $count = 0;
            //echo $data_while;
            echo '<div class="col-md-12" style="text-align: center !important;">
                <b style="font-size: 16px; color: #444444; text-align: left !important;">' . $row_count_mes['servico'] .'</b></br>'; 
                while($data_while <= $data){
                    include "sql_oco.php";
                    //echo @$row_oco['dt_inicio'];
                    if(@$row_oco['dt_inicio'] != ''){
                        if($row_oco_qtd['QTD'] >=2 ){
                            
                                    ?> 
                                    <a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" title="<?php 
                                    echo date('d M Y', strtotime($data_while)) ?>" 
                                        data-content="<?php 
                                        while($row_oco_dias = mysqli_fetch_array($result_oco_dias)){
                                            $rest = substr(@$row_oco_dias['dt_inicio'], -19, 10 );
                                            $fim  = substr(@$row_oco_dias['dt_fim'], -19, 10 );
                                                    
                                            if($rest == $data_while && $fim != '1970-01-01'){ 
                                                $dataIni = date('H:i:s', strtotime(@$row_oco_dias['dt_inicio']));
                                                $dataFim = date('H:i:s', strtotime(@$row_oco_dias['dt_fim']));
                                                        
                                                $dataFuturo = $dataIni;
                                                $dataAtual = $dataFim;
            
                                                $date_time  = new DateTime($dataAtual);
                                                $diff       = $date_time->diff( new DateTime($dataFuturo));
                                                echo 'Problema:'. $row_oco_dias['ds_ocorrencia'] .'<br/>'. $diff->format('%H hrs %I mins'). '<br/>'; 
                                            }else{
                                                echo 'Problema:'. $row_oco_dias['ds_ocorrencia'].'<br/>Estamos trablhando para resolver esse erro<br/>';
                                            }
                                        }?>">
                                    <img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_erro.png" height="25px" width="5px" class="d-inline-block align-top" > </a>
                                    <?php
                        }else{
                            while($row_oco_dias = mysqli_fetch_array($result_oco_dias)){

                                $rest = substr(@$row_oco_dias['dt_inicio'], -19, 10 );
                                $fim  = substr(@$row_oco_dias['dt_fim'], -19, 10 );
                                        
                                if($rest == $data_while && $fim != '1970-01-01'){ 
                                    $dataIni = date('H:i:s', strtotime(@$row_oco_dias['dt_inicio']));
                                    $dataFim = date('H:i:s', strtotime(@$row_oco_dias['dt_fim']));
                                            
                                    $dataFuturo = $dataIni;
                                    $dataAtual = $dataFim;

                                    $date_time  = new DateTime($dataAtual);
                                    $diff       = $date_time->diff( new DateTime($dataFuturo));

                        
                                    echo '<a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" title="'.date('d M Y', strtotime($data_while)).'" 
                                        data-content="Problema:' .$row_oco_dias['ds_ocorrencia'] . '<br/>'. $diff->format('%H hrs %I mins') .'">
                                    <img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_erro.png" height="25px" width="5px" class="d-inline-block align-top" > </a>';
                
                                }else{ 
                                    echo '<a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" title="' . date('d M Y', strtotime($data_while)).'"
                                        data-content="Problema:' .$row_oco_dias['ds_ocorrencia'] . '<br/> Estamos trablhando para resolver esse erro"> 
                                    <img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_hover.png" height="25" width="5px" class="d-inline-block align-top" > </a>';
                                }   
                            }
                        }        
                    }else{

                        echo '<a href="#/" data-toggle="popover" data-html="true" style="text-decoration: none;" title="'.date('d M Y', strtotime($data_while)).'" 
                        data-content="Nenhum problema relatado nesse dia">
                        <img style="margin-top: 5px; margin-bottom: 5px;" src="img/barra_ok.png" height="25px" width="5px" class="d-inline-block align-top" > </a>';
                                
                        $count = $count + 1;    
                    }        
                    $data_while = date("Y-m-d", strtotime('+1 days', strtotime($data_while)));
                }
                $data_while = date("Y-m-d", strtotime('-90 days', strtotime($data)));
                $porcentagem_dias = 100*($count/90);
                ?>
                <center>
                <?php echo substr(@$porcentagem_dias, 0, 5 ) . '% de dias estaveis   (Ultimos 90 dias)';?></center><?php
                ?>
            
            
            </div>
        
        </div>
    </div>


<?php 

$count_serv = $count_serv + 1;
$data_while = $data_ant;

}

?>
</br>
<div class="row justify-content-center" style="background-color: #f9f9f9;">
            <div class="col-md-11" >
                <?php
                for($ano = date("Y"); $ano <= date("Y") + 2; $ano++){
                    include 'sql_oco_ano.php';
                    if($row_ano['QTD'] > 0){
                        ?>
                       
                        <div class="col-md-12" style="border-radius: 3px; color : #fff; background-color :#6996EF;">
                            <h3 style="font-size: 24px;"><?php echo $ano;?></h3>
                        </div>
                        <?php
                   
                        for($count_mes = 1; $count_mes <= 12; $count_mes++){
                            include 'sql_oco_mes.php';
                            //echo $row_mes['QTD'];
                            ?>
                            <div class="row justify-content-center" style=" padding: 0px !important; background-color: #f9f9f9;" >
                                <?php
                                    if($row_mes['QTD'] > 0){
                                        if($count_mes == '1'){
                                            ?>                                
                                            <div style="padding: 0px !important; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">
                                                
                                                <h4><?php echo 'Janeiro';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '2'){
                                            ?>                                
                                            <div style=" padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Fevereiro';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '3'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Março';?></h4>
                                            </div>
                                            <?php 
                                        }else if($count_mes == '4'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Abril';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '5'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Maio';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '6'){
                                            ?>                                
                                            <div style="padding: 0px;  text-align: left;border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Junho';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '7'){
                                            ?>                                
                                            <div style="padding: 0px;  text-align: left;border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Julho';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '8'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Agosto';?></h4>
                                            </div>
                                            <?php 
                                        }else if($count_mes == '9'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Setembro';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '10'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Outubro';?></h4>
                                            </div>
                                            <?php
                                        }else if($count_mes == '11'){
                                            ?>
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Novembro';?></h4>
                                            </div>
                                            <?php 
                                        }else if($count_mes == '12'){
                                            ?>                                
                                            <div style="padding: 0px; text-align: left; border-bottom-width: thin;border-bottom-style: solid;border-bottom-color: #6996EF; " class="col-8">

                                                <h4><?php echo 'Dezembro';?></h4>
                                            </div>
                                            <?php 
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="row justify-content-center" style="padding: 0px !important; background-color: #f9f9f9;">
                                <div class="col-8">
                                    <?php

                        
                                    for($count_dias = 1; $count_dias <=31; $count_dias ++){ 

                                        //echo $count_script;
                                        $qtd_repita_dia = 0;
                                        include 'sql_oco_dia.php';

                                        $valida_data = '0';
                                        
                                        while($row_dia = mysqli_fetch_array($result_dia)){                                           

                                            if( date('d/m/Y', strtotime($row_dia['dt_inicio'])) <> $valida_data){ 

                                                $valida_data = date('d/m/Y', strtotime($row_dia['dt_inicio']));

                                                if($row_qtd_dia['QTD'] > 1){
                                                    $qtd_repita_dia = $qtd_repita_dia +1;
                                                    ?>
                                                    <div class="col-md-4" style="text-align: left;" onclick="mostrar_dia<?php echo $count_script; echo $qtd_repita_dia;?>()" >
                                                        <div id="seta-<?php echo $count_script  .''. $qtd_repita_dia ?>">
                                                            <h5 ><?php echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-right" ></i>';?></h5>
                                                        </div>
                                                        <div  id="baixo-<?php echo $count_script; echo $qtd_repita_dia?>">
                                                            <h5><?php
                                                                echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-down"></i>';
                                                            ?></h5>
                                                        </div>
                                                    </div>
                                                                                       
                                                        <div class="col-md-9">
                                                            <div class="col-md-12" style="text-align: left; margin-top: 20px !important; margin-bottom: 20px; padding: 0px; background-color : #fff; border-style: solid; border-radius: 5px;border-width: thin; border-color: #6996EF; "  id= "<?php echo $count_script; echo $qtd_repita_dia?>">
                                                                <?php while($row_dia_while = mysqli_fetch_array($result_dia_aux)){
                                                                    //echo $consulta_dia;
                                                                    ?>
                                                                    
                                                                        <h6>
                                                                            
                                                                            <?php 
                                                                            
                                                                                echo "<div style='background-color: #6996EF; color: #ffffff; text-align:center;'>";
                                                                                    echo $row_dia_while['titulo'];
                                                                                echo "</div>";

                                                                                echo "<div style='padding: 10px;'>";

                                                                                    echo 'Problema:</br>'. $row_dia_while['ds_ocorrencia'];

                                                                                    if(@$row_dia_while['ds_detalha'] == ''){
                                                                                        echo '</br></br>Solução:</br>Estamos trabalhando para resolver esse erro';
                                                                                    }else{
                                                                                        echo '</br></br>Solução:</br>'. $row_dia_while['ds_detalhada'];
                                                                                    }

                                                                                    if($row_dia_while['dt_fim'] == '1970-01-01 01:00:00'){
                                                                                        echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia_while['dt_inicio'])) .' Fim: não foi resolvido ainda';
                                                                                    }else{
                                                                                        echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia_while['dt_inicio'])) .' Fim: '. date('d/m/Y h:i:s', strtotime($row_dia_while['dt_fim']));
                                                                                    }

                                                                                echo "</div>";
                                                                            
                                                                            ?>
                                                                        
                                                                        </h6>
                                                            
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    
                                                    <script>

                                                        var dia<?php echo $count_script; echo $qtd_repita_dia?> = document.getElementById("<?php echo $count_script; echo $qtd_repita_dia?>");
                                                        var seta_baixo<?php echo $count_script; echo $qtd_repita_dia?> = document.getElementById("baixo-<?php echo $count_script; echo $qtd_repita_dia?>");
                                                        var seta<?php echo $count_script; echo $qtd_repita_dia?> = document.getElementById("seta-<?php echo $count_script; echo $qtd_repita_dia?>");

                                                        seta_baixo<?php echo $count_script; echo $qtd_repita_dia ?>.style.display = 'none';
                                                        dia<?php echo $count_script; echo $qtd_repita_dia ?>.style.display = 'none';

                                                        var aberto;
                                                        function mostrar_dia<?php echo $count_script; echo $qtd_repita_dia?>(){
                                                            if(dia<?php echo $count_script; echo $qtd_repita_dia?>.style.display == 'none'){    
                                                                dia<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'block';
                                                                seta_baixo<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'block';
                                                                seta<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'none';
                                                            }else{
                                                                dia<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'none';
                                                                seta_baixo<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'none';
                                                                seta<?php echo $count_script; echo $qtd_repita_dia?>.style.display = 'block';
                                                            }
                                                        }

                                                    </script>
                                                    <?php

                                                        

                                                }else{
                                                    ?>
                                                    <div class="col-md-4" style="text-align: left;" onclick="mostrar_dia<?php echo $count_script ?>()" >
                                                        <div id="seta-<?php echo $count_script?>">
                                                            <h5 ><?php echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-right" ></i>';?></h5>
                                                        </div>
                                                        <div  id="baixo-<?php echo $count_script ?>">
                                                            <h5><?php
                                                                echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-down"></i>';
                                                            ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="col-md-12" style="text-align: left; margin-top: 20px !important; margin-bottom: 20px; padding: 0px; background-color : #fff; border-style: solid; border-radius: 5px;border-width: thin; border-color: #cf6868; "  id= "<?php echo $count_script ?>">
                                                            <h6><?php 

                                                                echo "<div style='background-color: #cf6868; color: #ffffff; text-align:center;'>";
                                                                    echo $row_dia['titulo'];
                                                                echo "</div>";

                                                                echo "<div style='padding: 10px;'>";
                                                        
                                                                    echo 'Problema:</br>'. $row_dia['ds_ocorrencia'];
                                                                    if($row_dia['ds_detalhada'] == ''){
                                                                        echo '</br></br>Solução:</br> Estamos trabalhando para resolver esse problema';
                                                                    }else{
                                                                        echo '</br></br>Solução:</br>'. $row_dia['ds_detalhada'];
                                                                    }
                                                                    if($row_dia['dt_fim'] == '1970-01-01 01:00:00'){
                                                                        echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia['dt_inicio'])) .' Fim: não foi resolvido ainda';
                                                                    }else{
                                                                        echo '</br> Inicio: '. date('d/m/Y h:i:s', strtotime($row_dia['dt_inicio'])) .' Fim: '. date('d/m/Y h:i:s', strtotime($row_dia['dt_fim']));
                                                                    }

                                                                echo "</div>";

                                                            ?></h6>
                                                        </div>
                                                    </div>
                                                    <script>

                                                        var dia<?php echo $count_script ?> = document.getElementById("<?php echo $count_script ?>");
                                                        var seta_baixo<?php echo $count_script ?> = document.getElementById("baixo-<?php echo $count_script ?>");
                                                        var seta<?php echo $count_script ?> = document.getElementById("seta-<?php echo $count_script ?>");

                                                        seta_baixo<?php echo $count_script ?>.style.display = 'none';
                                                        dia<?php echo $count_script ?>.style.display = 'none';

                                                        var aberto;
                                                        function mostrar_dia<?php echo $count_script ?>(){
                                                            if(dia<?php echo $count_script ?>.style.display == 'none'){
                                                                dia<?php echo $count_script ?>.style.display = 'block';
                                                                seta_baixo<?php echo $count_script ?>.style.display = 'block';
                                                                seta<?php echo $count_script ?>.style.display = 'none';
                                                            }else{
                                                                dia<?php echo $count_script ?>.style.display = 'none';
                                                                seta_baixo<?php echo $count_script ?>.style.display = 'none';
                                                                seta<?php echo $count_script ?>.style.display = 'block';                                                        
                                                            }
                                                        }

                                                    </script>
                                          <?php }

                                        }

                                        }
                                        $count_script = $count_script + 1;
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }  
                    }
                }
            ?>
        </div>
        
    </div>
</div>
        </br>
        </br>
        </br>  
<?php

include "rodape_oco.php";

?>