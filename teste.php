<?php 

                        //CLASSE BOTAO
                        //$classe_botao = 'fas fa-plus'; //ADICIONAR
                        $classe_botao = 'fas fa-search'; //PESQUISAR

                        //ACAO BOTAO
                        $pagina_acao = 'permissoes.php';

                        //PLACEHOLDER BOTAO
                        if (!empty($filtro_cd_matricula)){
                            $placeholder_botao = $filtro_cd_matricula;
                        }else{
                            $placeholder_botao= 'LOGIN';
                        }

                        //CONSULTA_LISTA
                        $consulta_lista = "SELECT DISTINCT usu.*
                                        FROM dbasgu.USUARIOS usu
                                        INNER JOIN dbasgu.PAPEL_USUARIOS pu
                                            ON pu.CD_USUARIO = usu.CD_USUARIO
                                        WHERE usu.SN_ATIVO = 'S'";

                        $result_lista = oci_parse($conn_ora, $consulta_lista);																									

                        //EXECUTANDO A CONSULTA SQL (ORACLE)
                        oci_execute($result_lista);            

                    ?>

                    <script>

                        //LISTA
                        var countries = [     
                        <?php
                            while($row_lista = oci_fetch_array($result_lista)){	
                                echo '"'. $row_lista['CD_USUARIO'] .'"'.',';                
                            }
                        ?>
                        ];

                    </script>

                    <?php
                        //AUTOCOMPLETE
                        include 'autocomplete_solicitande.php';

                    ?>