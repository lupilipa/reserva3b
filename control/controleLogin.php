<?php

require('../model/Usuario.class.php');

if(isset($_GET['opc'])){

    $opc = $_GET['opc'];

    switch($opc){
        case 1:
            session_start();
            if($_SESSION['tipo'] == "admin"){
                header("location:../view/adm/menu_admin.php");
            }else{
                header("location:../view/funcionario/menu_func.php");
            }
    }

}

if(isset($_GET['logout'])){
    
    session_abort();
    header("location:../view/index.php");

}

?>