<?php

require('../model/EspEquip.class.php');

if(isset($_POST['cadastrar_esp'])){

    $nome = $_POST['name_esp'];
    
    $x = new EspEquip();
    $x->cadastrarEsp($nome); 
    
}

if(isset($_POST['cadastrar_eqp'])){

    $nome = $_POST['name_eqp'];
    
    $x = new EspEquip();
    $x->cadastrarEquip($nome); 
    
}

if(isset($_POST['excluir_esp'])){

    $senha_adm = $_POST['senha_adm'];
    $id = $_POST['cod_cad'];

        if($senha_adm == "boomer"){
        $x = new EspEquip();
        $x->excluirEsp($id);
        }else{
            header("location:../view/erro_geral.php");
        }

}

if(isset($_POST['excluir_eqp'])){

    $senha_adm = $_POST['senha_adm'];
    $id = $_POST['cod_cad'];

        if($senha_adm == "boomer"){
        $x = new EspEquip();
        $x->excluirEqp($id);
        }else{
            header("location:../view/erro_geral.php");
        }

}

?>