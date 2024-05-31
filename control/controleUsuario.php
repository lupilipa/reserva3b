<?php

require('../model/Usuario.class.php');

if(isset($_POST['autenticar_usuario'])){

    $senha = $_POST['senha'];
    $credencial = $_POST['credencial'];

    $x = new Usuario();
    $x->autenticarUsuario($credencial,$senha); 

}

if(isset($_POST['cadastrar_usuario'])){

    $tipo = "funcionario";
    $credencial = $_POST['credencial'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $x = new Usuario();
    $x->cadastrarUsuario($tipo, $credencial, $email, $senha); 
    
}

if(isset($_POST['excluir_usuario'])){

    $senha = $_POST['senha'];
    $senha_adm = $_POST['senha_adm'];
    $credencial = $_POST['credencial'];

        if($credencial == "admin"){
            header("location:../view/erro_geral.php");
        }else{
            if($senha_adm == "boomer"){
            $x = new Usuario();
            $x->excluirUsuario($credencial, $senha);
            }else{
                header("location:../view/erro_geral.php");
            }
        } 

}

?>