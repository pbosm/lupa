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

        //funcao para verificar se tem o mesmo email no bd
        function VerificarEmail($conn, $email){
            //indo no bd
            $sqlverifica = "SELECT email FROM clientes WHERE email = '$email'"; 
            $conn->query($sqlverifica);

            //Se o PHP receber do MySQL o valor 1 para a consulta anterior, significa que o MySQL já encontrou cadastros no banco de dados, 
            if($conn->affected_rows == 1) {
                exit("<p> Email já cadastrado!!!</p>
                <button>
                <a href='clientes.php'>Home
                </button>");
            }
        }         

        $nome      = $conn->escape_string(trim($_POST['nome']));
        $cpf       = $conn->escape_string(trim($_POST['cpf']));
        $email     = $conn->escape_string(trim($_POST['email']));
        $data      = $conn->escape_string(trim($_POST['data']));

        $erros = [];

        if(empty($nome)){
            $erros[] =  "Campo Nome vazio!!!"; 
        }if(empty($cpf)) {
            $erros[] =  "Campo CPF vazio!!!";
        }if(empty($email)) {
            $erros[] =  "Campo E-mail vazio!!!";
        }if(empty($data)) {
            $erros[] =  "Campo Data vazio!!!";
        }if(ValidaEmail($email) == true){
            $erros[] =  "Email invalido!!!!";
        }if(VerificarEmail($conn, $email)){
            $erros[] = "";
        }elseif(ValidaCpf($cpf) == false) {
            $erros[] =  "CPF cadastrado invalido!!!!";
        }

        if(!empty($erros)) {
            foreach ($erros as $erro) {
                echo "$erro <a href='clientes.php'>Voltar</a><br><br>";
            }
        } else {

        $sql = "INSERT clientes values (null, '$nome', '$cpf', '$email', '$data')";
        $conn->query($sql);

        if($conn == true){
            echo "<p> $nome cadastrado com sucesso! </p>
            <button>
            <a href='clientes.php'>Página clientes
            </button>";
        } else {
            echo "<br>Não cadastrado!!!";
        }

        }                         

?>