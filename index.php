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
        $id = $usuario['id'];
        
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['idUsuario'] = $id;
        header("location:home.php");
    } else {
        echo "<script>"."alert('Usuário ou Senha incorretos!! Verifique os dados e tente novamente.')"."</script>";
    }

}

?>

<html>
    <head>
        <title> Entrar | Gerenciador de Tarefas </title>
        <link rel="stylesheet" type="text/css" href="css/styleCadastroUsuario.css">
        <meta charset="utf-8">
    </head>
    <body>
<!--        <img src="imagens/background.jpg">-->
        <div id="content">
            <div id="cadastro">
                <div id="centro">
                    <div id="titulo">
                        Área de Login
                    </div>
                </div>
                <form name="frmLogin" action="index.php" method="get">
                        <div class="titulo">Usuário:</div>
                        <div class="campo">
                            <input class="caixa" type="text" name="txtEmail">
                        </div>
                        <div class="titulo">Senha:</div>
                        <div class="campo">
                                <input class="caixa" type="password" name="txtSenha">
                        </div>
                            <input class="botao" type="submit" name="btnEntrar" value="ENTRAR"/>
                        <div id="referencia">
                            <a href="cadastro.php">Quero me cadastrar</a>
                        </div>
                </form>
            </div>
        </div>
    </body>
</html>
