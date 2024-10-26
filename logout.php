<?php
include('topo.php');
session_start();
$_SESSION['nome'] = null;
session_destroy();
echo "Logout realizado com sucesso!<br>
<a href='acessar.php'>Entrar novamente</a>";
include('final.html');
?>
