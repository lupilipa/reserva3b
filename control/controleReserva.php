<?php

require('../model/ReservaEsp.class.php');
require('../model/ReservaEqp.class.php');

if(isset($_POST['gerar_rel'])){

    header('location:../view/relatorios/relatorio_reserva.php');

}

if(isset($_POST['reg_reservaesp'])){

    $id_usuarios = "1";
    $id_espaços = $_POST['id_espaços'];
    $responsavel = $_POST['responsavel'];
    $motivo = $_POST['motivo'];
    $data_instavel = $_POST['data_instavel'];
    $hora_instavel_inicio = $_POST['hora_instavel_inicio'];
    $hora_instavel_fim = $_POST['hora_instavel_fim'];
    
    $x = new ReservaEsp();
    $x->reg_reservaEsp($id_espaços, $hora_instavel_inicio, $hora_instavel_fim, $data_instavel, $id_usuarios, $responsavel, $motivo); 

}

?>