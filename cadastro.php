<?php
    
    include("conexao.php");

    $conexao = conectar();

    if(isset($_POST["bt_cadastrar"])){
        $nome = $_POST["txt_nome"];      
        $email = $_POST["txt_email"];      
        $senha = $_POST["txt_senha"]; 
        
        $sql = "insert into tbl_usuario(nome,email,senha) values('".$nome."','".$email."','".$senha."')";
        
        
        mysqli_query($conexao,$sql);
        echo("<script> alert('Sucesso') </script>");
    }
?>

<!DOCTIPE>
<html>
    <head>
        <title> Cadastro </title>
        <link href="css/styleCadastroUsuario.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="content">
            <div id="cadastro">
                <div id="titulo_caixa">Cadastro</div>
                <form method="post" action="cadastro.php">
                    <div class="titulo">Nome:</div>
                    <div class="campo"> 
                        <input type="text" name="txt_nome" class="caixa" required>
                    </div>
                    <div class="titulo"> E-mail: </div>
                    <div class="campo"> 
                        <input type="email" name="txt_email" class="caixa"required>  
                    </div>
                    <div class="titulo"> Senha: </div>
                    <div class="campo"> 
                        <input type="password" name="txt_senha"required class="caixa"> 
                    </div>
                    <div id="botao">
                        <a href="#">
                            <div class="botao_voltar">
                                Voltar
                            </div>
                        </a>

                        <input class="botao" type="submit" name="bt_cadastrar" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>