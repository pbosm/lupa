<?php

require_once "./database/conn.php"; //IMPORTANDO A CONEXÃO COM O BD DE DADOS.

$id   = $_GET['id'];  //PEGANDO ID E NOME DA PAGINA ANTERIOR ATRÁVES DO HREF E CLICK NO BOTÃO DE EXCLUIR, METODO GET 
$nome = $_GET['nome'];

$sqlchaveestrangeira = "DELETE FROM `imoveis` WHERE `imoveis`.`clientes_idclientes` = $id"; //antes de excluir o cliente, precisamos excluir caso ele esteja vinculado a outra tabela(chave estrangeira), caso não faça isso o usuário não será excluido mesmo clicando 100x no botão.
$sql = "DELETE FROM clientes where id = $id";


if(mysqli_query($conn, $sqlchaveestrangeira)){
    if(mysqli_query($conn, $sql)){
        header("location: clientes.php"); 
    } else {
        header("location: clientes.php");
    }
}


?>