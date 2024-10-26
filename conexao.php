<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'formulariojoslaine';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
$conn = $conexao // pra dar certo com os dois tutoriais 


//if($conexao->connect_errno)
//{
//    echo "Erro";
//}
//else
//{
    //echo "conexão efeituada com sucesso";
//}

?>