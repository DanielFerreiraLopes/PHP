<?php

    $login = $_REQUEST['login'];
    $senha = $_REQUEST['senha'];
    


    if (empty($login)) {
        exit("Ta faltando isso aqui");
    }

    if (empty($senha)) {
        exit("Ta faltando isso aqui");
    }


$conexao = new PDO("mysql:host=localhost;port=3306;dbname=php-crud","root","devisate");

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$comando = $conexao->prepare(" SELECT * FROM usuario WHERE login = ? AND senha = ? ");

$comando->execute([ $login, $senha]);

$resultados = $comando->fetchAll(PDO::FETCH_ASSOC);



// 'empty' esta verificando se o array '$resultado' esta vazio
if (empty($resultados)) {
    exit("login ou senha incorretos");
}

$cliente = $resultados[0];

// Sempre depois de uma '$_SESSION' ou quiser mexer com uma seção coloque 'session_start'
session_start();
$_SESSION["usuario"] = $resultados[0];


header("Location: ./../fornt/listagem.php ");
 