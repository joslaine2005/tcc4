<?php
session_start();
if(isset($_SESSION['nome'])){
    $email = $_SESSION['email'];
    $nome = $_SESSION['adm'];
    $id = $_SESSION['id'];
}