<?php
require_once "../database/conn.php";
?>
<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<title> Projeto – Imobiliária</title>
<link rel="stylesheet" type="text/css" href="../css/styleview.css">
</head>
<body>
    <div class="container">
        <div class="navigantion">
            <ul>
                <li>
                    <a href="#">
                        <span class="lupaimg"><img src="../img/lupa-logo1.png" width="100px"></span>
                        <span class="title">Projeto – Imobiliária</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php">
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
                    <a href="../clientes.php">
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
                        <form class="form-inline" action="../busca/buscacliente.php" method="POST">
                            <input type="text" placeholder="Pesquisar clientes" name="pesquisar">
                            <ion-icon name="search-outline"></ion-icon>           
                        </form>                                               
                    </label>
                 </div>
                 <!-- userimg-->
                 <div class="user">
                    <img src="../img/lupa-logo.png">
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

                <?php

                $id   = $_GET['id'];

                $sql = "SELECT * FROM clientes WHERE id = $id";
                $resultado = $conn->query($sql);

                $registro = mysqli_fetch_assoc($resultado);
                ?>
             <div class="details">
                 <div class="recentOrders">
                     <div class="cardHeader">
                         <h2>Editando o cliente <?php echo $registro['nome']?></h2>
                     </div>
                        <form action="../update.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $registro['id'];?>"> <br> <br>

                        <input type="text" name="nome" placeholder="Digite seu nome" value="<?php echo $registro['nome'];?>"> <br> <br>
                        
                        <input type="text" name="cpf" placeholder="Digite seu cpf" value="<?php echo $registro['cpf'];?>"> <br> <br>
                        
                        <input type="email" name="email" placeholder="Digite seu email" value="<?php echo $registro['email'];?>"> <br> <br>
                        
                        <input type="date" name="data" placeholder="Data emissão" value="<?php echo $registro['data'];?>"> <br> <br>
                        
                        <button name="editar" type="submit" class="btn btn-success" style='position: relative;padding: 5px 10px;background: var(--green);text-decoration: none;color: var(--white);border-radius: 6px;'>Editar</button>

                        </form>
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