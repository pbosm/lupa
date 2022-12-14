<?php
require_once "./database/conn.php";
require_once "./menu/menu.php";
?>
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
                         <h2>Clientes e seus imóveis</h2>
                     </div>
                     <table>
                         <thead>
                             <tr>
                                <td>Nome proprietário</td>                                
                                <td>CPF</td>
                                <td>Nome do imóvel</td>
                                <td>Cidade</td>
                                <td>Bairro</td>
                                <td>Data de emissão</td>
                             </tr>                            
                         </thead>
                         <tbody>
                       <tr>
                            <?php

                                $sql = "SELECT imoveis.nome, imoveis.bairro, imoveis.cidade, imoveis.clientes_idclientes, clientes.nome, clientes.cpf, clientes.data
                                from imoveis join clientes
                                on clientes.id = imoveis.clientes_idclientes
                                order by clientes.nome;";
                                $resultado = $conn->query($sql);
 
                                while ($registro = $resultado->fetch_array())
                                {                                                                  
                                    $nomeimovel   =  $registro[0];
                                    $bairro       =  $registro[1];
                                    $cidade       =  $registro[2]; 
                                    $nomePro      =  $registro[4];
                                    $cpf          =  $registro[5];
                                    $data         =  $registro[6];

                                     
                                    $nomePro      = htmlentities($nomePro, ENT_QUOTES, "UTF-8");
                                    $cpf          = htmlentities($cpf, ENT_QUOTES, "UTF-8");
                                    $nomeimovel   = htmlentities($nomeimovel, ENT_QUOTES, "UTF-8");
                                    $cidade       = htmlentities($cidade, ENT_QUOTES, "ISO-8859-1");
                                    $bairro       = htmlentities($bairro, ENT_QUOTES, "ISO-8859-1");
                                    $data         = htmlentities($data, ENT_QUOTES, "UTF-8");
                                   
                                    echo "<tr>
                                    <td> $nomePro</td>
                                    <td> $cpf</td>
                                    <td> $nomeimovel</td>
                                    <td> $cidade</td>
                                    <td> $bairro</td>
                                    <td> $data</td>
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

    </script>

</body>
</html>