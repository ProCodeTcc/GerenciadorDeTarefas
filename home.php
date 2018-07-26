<?php
    // require_once "verificacao.php";
    include("conexao.php");
    $conexao = conectar();
    session_start();

    $id="";
    $titulo = "";
    $descricao = "";
    $botao = "Salvar";

    if (isset($_POST['btnSalvar'])) {
        $titulo = $_POST['txtTitulo'];
        $descricao = $_POST['txtDescricao'];

        if($_GET['botao'] == "Salvar"){
            $sql = "INSERT INTO tbl_tarefa (nome, descricao) VALUES ('".$titulo."', '".$descricao."')";
        } else if($_GET['botao'] == "Editar"){
            $sql = "UPDATE tbl_tarefa SET
            nome = '".$titulo."',
            descricao = '".$descricao."'
            WHERE id = ".$_SESSION['idSessao'];
        }
        mysqli_query($conexao, $sql);
        header('location:home.php');
    }

    if (isset($_GET['modo'])) {
        $modo = $_GET['modo'];
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
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styleHome.css">
    <title>Home</title>
  </head>
  <body>
    <header>
      Gerenciador de Tarefas
      <div class="informacoes">
          Bem Vindo, <?php echo $_SESSION['nome']; ?>
          <p class="sair">
              <a href="index.php?modo=sair">Sair</a>
          </p>
      </div>
    </header>
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
                    <input type="date" name="txtTitulo" value="<?php echo $titulo; ?>" class="input" required>
                </div>
                <div class="campos">
                    <div class="tituloContainer">
                        Descrição
                    </div>
                    <textarea name="txtDescricao" rows="6" cols="50" required><?php echo $descricao; ?></textarea>
                </div>
                <div class="botao">
                    <input type="submit" name="btnSalvar" value="<?php echo $botao; ?>" class="botaoStyle">
                </div>
            </section>
        </form>
      </section>
      <section class="containerLista">
        <div class="tituloContainer">
          Lista de Tarefas
        </div>
        <div class="tabela">
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
                    $sql = "select * from tbl_tarefa";
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
                        <a href="home.php?modo=consultar&id=<?php echo $tarefas['id']; ?>">
                            Editar
                        </a>
                        |
                        <a href="home.php?modo=excluir&id=<?php echo $tarefas['id']; ?>">
                            Excluir
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
      </section>
    </main>
    <footer>
      © COPYRIGHT 2018 - ProCode S.A, TODOS OS DIREITOS RESERVADOS.
    </footer>
  </body>
</html>
