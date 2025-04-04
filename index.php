<?php
//Incluir o arquivo de conexão de banco
include('conexao.php');

//Verifiva se os campos emai e senha foram enviados via POST
if(isset($_POST['email']) || isset($_POST['senha']))
{

    //verificar se o campo email esta vazio
    if(strlen($_POST['email'] == 0)){
        echo "Preencha seu e-mail";
    }
    //verificar se o campo senha esta vazio
    else if(strlen($_POST['senha'] == 0)){
        echo "Preencha sua senha";
    }
    else {
        //Proteje contra SQL Injection escapando caracteres especiais
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        //Consulta no banco de dados se exitem o usuario e senha
        $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL:" . $mysqli->error);

        //Obtém o número de registros encontrados
        $quantidade = $sql_query->num_rows;

        if($qusntidade == 1){
            //Obtém os dados do usuário
            $usuario = $sql_query->fetch_assoc();
            
            //Inicia a sessão, caso ainda não tenha sido iniciada
            if(!isset($_SESSION)){
                session_start();
            }
            
            //Armazena informações do usuário na sessão 
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="sumit">Enviar</button>
        </p>
</body>
</html>