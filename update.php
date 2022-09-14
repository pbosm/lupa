<?php   

    require_once "./database/conn.php"; 

    //funcao valida CPF  
    function ValidaCpf($cpf) {
    //Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
             
    //Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }          
    //Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }         
    //Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
            $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
        return true;
    }

    //funcao valida email
    function ValidaEmail($email){
        //Verifica se o email NÃO bate no requisitos
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        } else {
            return true;
        }
    }
    
    $id        = $conn->escape_string(trim($_POST['id']));
    $nome      = $conn->escape_string(trim($_POST['nome']));
    $cpf       = $conn->escape_string(trim($_POST['cpf']));
    $email     = $conn->escape_string(trim($_POST['email']));
    $data      = $conn->escape_string(trim($_POST['data']));

    if(empty($nome)){
        echo "Campo Nome vazio!!!<br><button><a href='clientes.php'>Voltar</button>"; 
    }elseif(empty($cpf)) {
        echo "Campo CPF vazio!!!<br><button><a href='clientes.php'>Voltar</button>";
    }elseif(empty($email)) {
        echo "Campo E-mail vazio!!!<br><button><a href='clientes.php'>Voltar</button>";
    }elseif(empty($data)) {
        echo "Campo Data vazio!!!<br><button><a href='clientes.php'>Voltar</button>";
    }elseif(ValidaEmail($email) == true){
        echo "Email invalido!!!!<button><a href='clientes.php'>Voltar</button>";
    }elseif(ValidaCpf($cpf) == false) {
        echo "CPF cadastrado invalido!!!!<button><a href='clientes.php'>Voltar</button>";
    }else {
    
        $sql = "UPDATE clientes SET `nome` = '$nome', `cpf` = '$cpf', `email` = '$email', `data` = '$data' where id = '$id'";
        $conn->query($sql);

        if(mysqli_query($conn, $sql))
        {
            echo "<p>$nome Alterado com sucesso!!!</p>";
        } else {
            echo "<p>$nome Não foi possivel alterar!!!</p>";
        }
    
        echo"<button>
        <a href='clientes.php'>Voltar
        </button>";
    
        }

?>