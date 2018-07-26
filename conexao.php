<?php
    function conectar(){
        $conexao = mysqli_connect('10.107.144.27', 'root', 'bcd127','dbtarefa');
        mysqli_set_charset($conexao,"utf8");
        
        if($conexao){
            return $conexao;
        }else{
            echo("<script> alert('Erro ao conectar com o Banco de Dados') </script>");
        }
    }

