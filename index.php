<?php
    require_once "verificacao.php";
    //conectando com o banco
    include ("conexao.php");
    $conexao = conectar();

    if (isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        if ($modo == 'sair') {
            session_destroy();
            header('location:index.php');
        }
    }

if(isset($_POST["btn"])){

    // session_start();
    //resgatando as variaveis dos input
    $email = $_POST["txtemail"];
    $senha = $_POST["txtsenha"];

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
        <title> Projeto1 </title>
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

                <form method="post">
                    <div id="login">
                        <div class="cadastro">
                            Usuário:
                            <div class="dados">
                                <input class="input" type="text" name="txtemail" >
                            </div>
                        </div>
                        <div class="cadastro">
                            Senha:
                            <div class="dados">
                                <input class="input" type="text" name="txtsenha" >
                            </div>
                        </div>
                        <div class="cadastro">
                            <button id="botao" type="submit" name="btn" value="entrar">Entrar</button>
                        </div>
                        <div id="referencia">
                            <a id="link" href="cadastro.php">Quero me cadastrar</a>
                        </div>
                    </div>'
                </form>
            </div>


    </body>
</html>
