<?php
    include("conexao.php");
    $conexao = conectar();
    session_start();
    require_once "verificacao.php";

    $id="";
    $titulo = "";
    $descricao = "";
    $botao = "Salvar";

    // verificando se o botao foi clicado
    if (isset($_POST['btnSalvar'])) {
        //resgatando dos inputs os valores
        $titulo = $_POST['txtTitulo'];
        $descricao = $_POST['txtDescricao'];

        //verificando qual a situação do botão para decidir qual comando será executado
        if($_GET['botao'] == "Salvar"){
            $sql = "INSERT INTO tbl_tarefa(nome, descricao, idUsuario) VALUES('".$titulo."', '".$descricao."', ".$_SESSION['idUsuario'].")";
        } else if($_GET['botao'] == "Editar"){
            $sql = "UPDATE tbl_tarefa SET
            nome = '".$titulo."',
            descricao = '".$descricao."'
            WHERE id = ".$_SESSION['idSessao'];
        }
        // executando o comando e redirecionando a pagina
//        echo($sql);
        mysqli_query($conexao, $sql);
        header('location:home.php');
    }

    // verificando se existe a variavel 'modo' na url
    if (isset($_GET['modo'])) {
        $modo = $_GET['modo'];

        // verificando o valor da variavel e decidindo o que fazer a partir desta informação
        if($modo == 'excluir'){
            $id = $_GET['id'];
            $sql = "DELETE FROM tbl_tarefa WHERE (id = '".$id."');";
            mysqli_query($conexao, $sql);
        } else if ($modo == 'consultar'){
            $id = $_GET['id'];

            $sql = "select * from tbl_tarefa where id = ".$id;
            $result = mysqli_query($conexao, $sql);
            if($tarefa = mysqli_fetch_array($result)){
                $_SESSION['idSessao'] = $id;
                $titulo = $tarefa['nome'];
                $descricao = $tarefa['descricao'];
                $botao = "Editar";
            }
        }
    }

    // função que faz logout do sistema
    function sair() {
        if (isset($_GET['modo'])) {
            $modo = $_GET['modo'];
            if ($modo == 'sair') {
                session_destroy();
                header('location:index.php');
            }
        }
    }
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styleCadastroUsuario.css">
    <title>Home</title>
  </head>
  <body>
    <header>
        <div id="logo">
        </div>
        <div id="cabacalho">

            Gerenciador de Tarefas
        </div>
        <div id="teste">

            <div class="informacoes">
          Bem Vindo, <?php echo $_SESSION['nome']; ?>
      </div>
        <div id="botao_sair">
                <a class="menu" href="home.php?modo=sair" <?php sair() ?>>
                    <div class="sair">
                        Sair
                    </div>
                </a>
            </div>
        </div>

    </header>
      <div id="content_home">
    <main>


    <div class="espacamento"></div>

      <section class="containerCadastro">
        <div class="tituloContainer">
          Cadastro de Tarefas
        </div>
        <form action="home.php?botao=<?php echo $botao; ?>" method="post" name="frmCadastro">
            <section class="containerCampos">
                <div class="campos">
                    <div class="tituloContainer">
                        Titulo
                    </div>
                    <input type="text" name="txtTitulo" value="<?php echo $titulo; ?>" class="caixa_titulo" required>
                </div>
                <div class="campos">
                    <div class="tituloContainer">
                        Descrição
                    </div>
                    <textarea id="txt_area" name="txtDescricao" rows="6" cols="50" required><?php echo $descricao; ?></textarea>
                </div>
                    <div id="area_botao">
                        <div id="area">
                            <input type="submit" name="btnSalvar" value="<?php echo $botao; ?>" class="botao_tarefa">
                        </div>
                    </div>
            </section>
        </form>
      </section>
      <section class="containerLista">
        <div class="tabela">
            <div class="tituloContainer">
                Lista de Tarefas
            </div>
            <div class="linhaTitulo">
                <div class="caixaTitulo">
                    Titulo da Tarefa
                </div>
                <div class="caixaTitulo">
                    Descrição da Tarefa
                </div>
                <div class="opcoes">
                    Opções
                </div>
            </div>
            <div class="caixaTarefas">
                <?php
                    $sql = "select * from tbl_tarefa WHERE idUsuario =".$_SESSION['idUsuario'];
                    $result = mysqli_query($conexao, $sql);
                    while($tarefas = mysqli_fetch_array($result)){
                 ?>
                <div class="linhaTarefa">
                    <div class="caixaTarefa">
                        <?php echo $tarefas['nome']; ?>
                    </div>
                    <div class="caixaTarefa">
                        <?php echo $tarefas['descricao']; ?>
                    </div>
                    <div class="opcoesTarefa">
                        <a class = "menu" href="home.php?modo=consultar&id=<?php echo $tarefas['id']; ?>">
                            Editar
                        </a>
                        |
                        <a class = "menu" href="home.php?modo=excluir&id=<?php echo $tarefas['id']; ?>">
                            Excluir
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
      </section>
    </main>
          </div>
    <footer>
      © COPYRIGHT 2018 - ProCode S.A, TODOS OS DIREITOS RESERVADOS.
    </footer>

  </body>
</html>
