<?php 

include ("conexao.php");

$conexao = conectar();



if(isset($_GET["btn"])){
    $email = $_GET["txtemail"];
    $senha = $_GET["txtsenha"];
    
    $sql = "select * from tbl_usuario where email = '".$email."' and senha = '".$senha."'";
    
    $retorno = mysqli_query($conexao, $sql);
    if($usuario = mysqli_fetch_assoc($retorno)){
        
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
                
                <form method="get">
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