<?php

include 'conexao.php';

$v_valor = filter_input(INPUT_GET,'filtro');
$tipo = filter_input(INPUT_GET,'tipo');

if ($v_valor != '' && $tipo != '' ){
 $consulta_servico = "SELECT * FROM servicos WHERE cd_servico = '$v_valor' and servico like '%$tipo%' 
                    ORDER BY cd_servico";

$qtd_consulta_servico = "SELECT count(*) as qtd FROM servicos WHERE cd_servico = '$v_valor' and servico like '%$tipo%' 
                    ORDER BY cd_servico";
                    //echo $qtd_consulta_servico;

}else if($v_valor != '' && $tipo == ''){
     $consulta_servico = "SELECT * FROM servicos WHERE cd_servico = '$v_valor'
                    ORDER BY cd_servico";
    $qtd_consulta_servico = "SELECT count(*) as qtd FROM servicos WHERE cd_servico = '$v_valor' 
                    ORDER BY cd_servico";
//echo $consulta_servico;
}else if($v_valor == '' && $tipo != ''){
     $consulta_servico = "SELECT * FROM servicos WHERE servico like '%$tipo%'
                    ORDER BY cd_servico";
    $qtd_consulta_servico = "SELECT count(*) as qtd FROM servicos WHERE servico like '%$tipo%' 
                    ORDER BY cd_servico";
}else{
    $consulta_servico = "SELECT * FROM servicos 
                    ORDER BY cd_servico";
    
}

$result_servico = mysqli_query($conn ,$consulta_servico);
@$qtd_result_servico = mysqli_query(@$conn ,@$qtd_consulta_servico);

@$row_qtd = mysqli_fetch_array(@$qtd_result_servico);
?>