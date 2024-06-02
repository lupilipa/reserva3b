<?php

require('../model/Reserva.class.php');
require('../model/Usuario.class.php');
require('../model/EspEquip.class.php');

if(isset($_POST['voltar_menu'])){

    session_start();
    if($_SESSION['tipo'] == "admin"){
        header("location:../view/adm/menu_admin.php");
    }else{
        header("location:../view/funcionario/menu_func.php");
    }

}

if(isset($_GET['voltar_menu'])){

    session_start();
    if($_SESSION['tipo'] == "admin"){
        header("location:../view/adm/menu_admin.php");
    }else{
        header("location:../view/funcionario/menu_func.php");
    }

}

?>