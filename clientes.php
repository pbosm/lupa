<?php
require_once "./database/conn.php";
?>
<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<title> Projeto – Imobiliária</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class="container">
        <div class="navigantion">
            <ul>
                <li>
                    <a href="#">
                        <span class="lupaimg"><img src="./img/lupa-logo1.png" width="100px"></span>
                        <span class="title">Projeto – Imobiliária</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">     
                        <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>                  
                        <span class="title">Administradores</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
                        <span class="title">Corretores</span>
                    </a>
                </li>
                <li>
                    <a href="clientes.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="business-outline"></ion-icon></span>
                        <span class="title">Imóveis</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">Outros complementares</span>
                    </a>
                </li>
            </ul>
         </div>
         
         <!-- main -->
         <div class="main">
             <div class="topbar">
                 <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                 </div>
                 <!-- search-->
                 <div class="search">
                    <label>
                        <form class="form-inline" action="./busca/buscacliente.php" method="POST">
                            <input type="text" placeholder="Pesquisar clientes" name="pesquisar">
                            <ion-icon name="search-outline"></ion-icon>           
                        </form>                                               
                    </label>
                 </div>
                 <!-- userimg-->
                 <div class="user">
                    <img src="./img/lupa-logo.png">
                 </div>
             </div>

             <!-- cards -->
             <div class="cardBox">
                 <div class="card">
                     <div>
                         <div class="numbers"><?php $sql = "SELECT count(id) from clientes";
                         $resultado = $conn->query($sql); 
                         $registro = mysqli_fetch_assoc($resultado); 
                         echo $registro['count(id)'];?></div>
                         <div class="cardName">Clientes</div>
                     </div>
                     <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                     </div>
                 </div>
                 <div class="card">
                    <div>
                        <div class="numbers"><?php $sql = "SELECT count(idimoveis) from imoveis";
                         $resultado = $conn->query($sql); 
                         $registro = mysqli_fetch_assoc($resultado); 
                         echo $registro['count(idimoveis)'];?></div>
                        <div class="cardName">Imóveis</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="business-outline"></ion-icon>
                    </div>
                </div>
             </div>

             <!-- order details list -->
             <div class="details">
                 <div class="recentOrders">
                     <div class="cardHeader">
                         <h2>Pedidos recentes</h2>
                         <a href="./view/viewcreate.php" class='button' style='position: relative;padding: 5px 10px; margin-right: 50px;background: var(--green);text-decoration: none;color: var(--white);border-radius: 6px;'>Adicionar novo cliente</a>
                     </div>
                     <table>
                         <thead>
                             <tr>
                                <td>Nome</td>
                                <td>E-mail</td>
                                <td>CPF</td>
                                <td>Data de emissão</td>
                                <td>Opções</td>
                             </tr>                            
                         </thead>
                         <tbody>
                       <tr>
                            <?php

                                $sql = "SELECT * FROM clientes";
                                $resultado = $conn->query($sql);
 
                                while ($registro = $resultado->fetch_array())
                                {                                                                  
                                    $id     =  $registro[0];
                                    $nome   =  $registro[1];
                                    $cpf    =  $registro[2];
                                    $email  =  $registro[3]; 
                                    $data   =  $registro[4];                                                               
                                     
                                    $id        = htmlentities($id, ENT_QUOTES, "UTF-8");
                                    $nome      = htmlentities($nome, ENT_QUOTES, "UTF-8");
                                    $cpf       = htmlentities($cpf, ENT_QUOTES, "UTF-8");
                                    $email     = htmlentities($email, ENT_QUOTES, "UTF-8");
                                    $data      = htmlentities($data, ENT_QUOTES, "UTF-8");
                                   
                                    echo "<tr>
                                    <td> $nome</td>
                                    <td> $email</td>
                                    <td> $cpf</td>
                                    <td> $data</td>
                                    <td width=280px><a href='./view/viewupdate?id=$id&nome=$nome' class='button' style='position: relative;padding: 5px 10px;background: var(--green);text-decoration: none;color: var(--white);border-radius: 6px;'>Editar</a>
                                    <a width=280px><a href='delete.php?id=$id&nome=$nome' class='button' style='position: relative;padding: 5px 10px;background: var(--red);text-decoration: none;color: var(--white);border-radius: 6px;'>Excluir</a>
                                    </td>";
                                }
                            ?>
                        </tr>            
                    </tbody>                     
                    </table>
                 </div>
         </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        //add menutoggle
        let toggle = document.querySelector('.toggle');
        let navigantion = document.querySelector('.navigantion');
        let main = document.querySelector('.main');

        toggle.onclick = function()
        {
            navigantion.classList.toggle('active');
            main.classList.toggle('active');            
        }

        //add hovered valss in selected list item
        let list = document.querySelectorAll('.navigantion li');
        function activeLink()
        {
            list.forEach((item) =>
            item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item) =>
        item.addEventListener('mouseover',activeLink));
    </script>

</body>
</html>