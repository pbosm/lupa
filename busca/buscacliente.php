<?php
require_once "../database/conn.php";
require_once "../menu/menu.php";
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
                        <form class="form-inline" action="../busca/buscacliente.php?id=$id&nome=$nome'" method="POST">
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

             <!-- order details list -->
             <div class="details">
                 <div class="recentOrders">
                     <div class="cardHeader">
                         <h2>Clientes cadastrados</h2>
                         <!-- <a href="#" class="btn">Ver todos</a> -->
                     </div>
                     <table>
                         <thead>
                             <tr>
                                <td>Nome</td>
                                <td>E-mail</td>
                                <td>Sexo</td>
                                <td>Data de emissão</td>
                                <td>Opções</td>
                             </tr>                            
                         </thead>
                         <tbody>
                       <tr>
                            <?php
                                $pesquisar = $_POST['pesquisar'];

                                $sql = "SELECT * FROM clientes where nome like '%$pesquisar%'";
                                $resultado = $conn->query($sql);
 
                                while ($registro = $resultado->fetch_array())
                                {                                                                  
                                    $id     =  $registro[0];
                                    $nome   =  $registro[1];
                                    $email  =  $registro[2];
                                    $sexo   =  $registro[3];  
                                    $data   =  $registro[4];                                                                 
                                     
                                    $id        = htmlentities($id, ENT_QUOTES, "UTF-8");
                                    $nome      = htmlentities($nome, ENT_QUOTES, "UTF-8");
                                    $email     = htmlentities($email, ENT_QUOTES, "UTF-8");
                                    $sexo      = htmlentities($sexo, ENT_QUOTES, "UTF-8");
                                    $data      = htmlentities($data, ENT_QUOTES, "UTF-8");
                                   
                                    echo "<tr>
                                    <td> $nome</td>
                                    <td> $email</td>
                                    <td> $sexo</td>
                                    <td> $data</td>
                                    <td width=280px><a href='../view/viewupdate?id=$id' class='button' style='position: relative;padding: 5px 10px;background: var(--green);text-decoration: none;color: var(--white);border-radius: 6px;'>Editar</a>
                                    <a width=280px><a href='../delete.php?id=$id&nome=$nome' class='button' style='position: relative;padding: 5px 10px;background: var(--red);text-decoration: none;color: var(--white);border-radius: 6px;'>Excluir</a>
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