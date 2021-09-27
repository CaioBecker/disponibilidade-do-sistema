<?php
session_start();
$data = date("Y-m-d");
$data_ant = date("Y-m-d", strtotime('-90 days', strtotime($data)));

$data_while = $data_ant;
include "cabecalho_oco.php";

$count_script = 1;


//echo $rest;
?>
<style>
p{
    padding-left: 900px;
}


</style>
<center>
<div class="row">
<div class="col-md-12">
    <?php
        $data_hj = date("Y-m-d H:i:s");
        include "sql_erro_hj.php";
        while($row_hj = mysqli_fetch_array($result_hj)){
            ?>
            <center>
            <div class="row-md">
                <div class="col-md-8 " style="color: #fff; background-color: #6996EF;"> <?php
                    echo $row_hj['ds_ocorrencia'];
            ?>
                </div>
                <div class="col-md-8 caixa_aviso" > <?php
                echo 'Descrição: '. $row_hj['ds_detalhada'];

            ?>
                </div>
                <div class="col-md-8 caixa_aviso_b" > <?php
                echo 'Fora do ar desde: '. date("d/m/Y H:i", strtotime($row_hj['dt_inicio']));
            
            ?>  
                </div>
            </div>
            </center>
        </br>
        <?php
        }
        ?>
        

    </div>
</div>
</center>
    </br>
   
<div class="row-md" >

    <center>
    <div class="col-md-12" >
    
    </br>
        <div class="row-md">
            <div class="col-md-10" style="border-style: solid; border-radius: 7px;border-width: thin; border-color: rgb(128, 191, 255);">
                </br>
                    <?php
                        $count = 0;
                        while($data_while <= $data){
                            include "sql_oco.php";
                            
                            if(@$row_oco['dt_inicio'] != ''){
                                $rest = substr(@$row_oco['dt_inicio'], -19, 10 );
                                $fim  = substr(@$row_oco['dt_fim'], -19, 10 );
                                
                                //echo $data_while;
                                //echo $rest;
                                if($rest == $data_while && $fim != '1970-01-01'){ 
                                $dataIni = date('H:i:s', strtotime(@$row_oco['dt_inicio']));
                                    $dataFim = date('H:i:s', strtotime(@$row_oco['dt_fim']));
                                    
                                    $dataFuturo = $dataIni;
                                    $dataAtual = $dataFim;

                                    $date_time  = new DateTime($dataAtual);
                                    $diff       = $date_time->diff( new DateTime($dataFuturo));
                                

                                    
                                    ?>
                                <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                                data-content="<?php echo $diff->format('%H hrs %I mins');
                                                    echo ' Descrição: '. $row_oco['ds_ocorrencia']; ?>">
                                <img src="img/barra_erro.png" height="25px" width="5px" class="d-inline-block align-top" > </a>
                    <?php }else{ ?>
                            
                                <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                                data-content="Erro não resolvido"> 
                                <img src="img/barra_hover.png" height="25" width="5px" class="d-inline-block align-top" > </a>
                        <?php 
                            }           
                        }else{ 
                        ?>
                        
                        <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                        data-content="Nenhum erro reladato neste dia"> 
                        <img src="img/barra_ok.png" height="25px" width="5px" class="d-inline-block align-top" > </a>
                        
                    <?php                     
                    $count = $count + 1;    
                    }        
                    $data_while = date("Y-m-d", strtotime('+1 days', strtotime($data_while)));
                    //echo $count;
                }
                $porcentagem_dias = 100*($count/100);
                ?><center><?php echo $porcentagem_dias . '% de dias estaveis';?></center><?php
                ?>
            </div>
            </center>
        </div>
        <p>Ultimos 90 dias</p>
    </div>    
    </br>
</div>
<div class="row-md">
    <div class="col-md-5">
        <?php
            for($ano = date("Y"); $ano <= date("Y") + 2; $ano++){
                include 'sql_oco_ano.php';
                if($row_ano['QTD'] > 0){
                        ?>
                            <h3><?php echo $ano?></h3>
                        <?php
                   
                        for($count_mes = 1; $count_mes <= 12; $count_mes++){
                            include 'sql_oco_mes.php';
                            //echo $row_mes['QTD'];
                            ?>
                            <div class="row">
                                <div style="color: #fff; background-color: #6996EF" class="col-md-4">
                                <?php
                                    if($row_mes['QTD'] > 0){
                                        if($count_mes == '1'){
                                            echo 'Janeiro';
                                        }else if($count_mes == '2'){
                                            echo 'Fevereiro';
                                        }else if($count_mes == '3'){
                                            echo 'Março';
                                        }else if($count_mes == '4'){
                                            echo 'Abril';
                                        }else if($count_mes == '5'){
                                            echo 'Maio';
                                        }else if($count_mes == '6'){
                                            echo 'Junho';
                                        }else if($count_mes == '7'){
                                            echo 'Julho';
                                        }else if($count_mes == '7'){
                                            echo 'Agosto';
                                        }else if($count_mes == '8'){
                                            echo 'Setembro';
                                        }else if($count_mes == '9'){
                                            echo 'Outubro';
                                        }else if($count_mes == '10'){
                                            echo 'Novembro';
                                        }else{
                                            echo 'Dezembro';
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                            <?php

                        
                            for($count_dias = 1; $count_dias <=31; $count_dias ++){ 

                                //echo $count_script;
                            
                                include 'sql_oco_dia.php';
                            
                                while($row_dia = mysqli_fetch_array($result_dia)){
                               
                                    ?>
                                    <div class="col-md-4" onclick="mostrar_dia<?php echo $count_script ?>()" >
                                        <div id="seta-<?php echo $count_script ?>">
                                            <?php 
                                                echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-right" ></i>';
                                            ?>
                                        </div>
                                        <div id="baixo-<?php echo $count_script ?>">
                                            <?php
                                                echo date('d/m/Y', strtotime($row_dia['dt_inicio'])).' <i class="fas fa-chevron-down"></i>';
                                            ?>
                                        </div>
                                    </div>
                                    <div  id= "<?php echo $count_script ?>">
                                        <?php 
                                            echo $row_dia['ds_ocorrencia'];
                                        ?>
                                    </div>
                                    <script>

                                        var dia<?php echo $count_script ?> = document.getElementById("<?php echo $count_script ?>");
                                        var seta_baixo<?php echo $count_script ?> = document.getElementById("baixo-<?php echo $count_script ?>");
                                        var seta<?php echo $count_script ?> = document.getElementById("seta-<?php echo $count_script ?>");

                                        seta_baixo<?php echo $count_script ?>.style.display = 'none';
                                        dia<?php echo $count_script ?>.style.display = 'none';

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
                                    <?php
                               
                                }

                                $count_script = $count_script + 1;
                            
                            }
                        }  
                    }
            }
        ?>
    </div>
</div>
<?php

include "rodape_oco.php";

?>