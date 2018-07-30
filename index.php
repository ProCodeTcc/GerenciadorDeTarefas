<?php
    //conectando com o banco
    include ("conexao.php");
    $conexao = conectar();

if(isset($_GET["btnEntrar"])){

    session_start();
    //resgatando as variaveis dos input
    $email = $_GET["txtEmail"];
    $senha = $_GET["txtSenha"];

    $sql = "select * from tbl_usuario where email = '".$email."' and senha = '".$senha."'";

    $retorno = mysqli_query($conexao, $sql);
    if($usuario = mysqli_fetch_array($retorno)){
        $nome = $usuario['nome'];
        $email = $usuario['email'];
        $senha = $usuario['senha'];

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header("location:home.php");
    } else {
        header("location:index.php");
    }

}

?>

<html>
    <head>
        <title> Entrar | Gerenciador de Tarefas </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
    </head>
    <body>

        <header>
            <div id="centro">
                <div id="titulo">
                    Área de Login
                </div>
            </div>
        </header>

            <div id="subtela">

                <form name="frmLogin" action="index.php" method="get">
                    <div id="login">
                        <div class="cadastro">
                            Usuário:
                            <div class="dados">
                                <input class="input" type="text" name="txtEmail">
                            </div>
                        </div>
                        <div class="cadastro">
                            Senha:
                            <div class="dados">
                                <input class="input" type="password" name="txtSenha">
                            </div>
                        </div>
                        <div class="cadastro">
                            <input id="botao" type="submit" name="btnEntrar" value="entrar"/>
                        </div>
                        <div id="referencia">
                            <a id="link" href="cadastro.php">Quero me cadastrar</a>
                        </div>
                    </div>'
                </form>
            </div>


    </body>
</html>
