<?php

require('../model/Reserva.class.php');
require('../model/Usuario.class.php');
require('../model/EspEquip.class.php');

if(isset($_POST['verif'])){

    $hora_ins_ini = $_POST['hora_ins_ini'];
    $hora_ins_fim = $_POST['hora_ins_fim'];
    $data_ins = $_POST['data_ins'];
    $id_espaços = $_POST['id_espaços'];
    $responsavel = $_POST['responsavel'];
    $motivo = $_POST['motivo'];

    $disponibilidade = Reserva::verificarHoraEx($hora_ins_ini, $hora_ins_fim, $data_ins);

    if ($disponibilidade) {
        $verificar = Reserva::verificarDispon($id_espaços, $disponibilidade, $hora_ins_ini, $hora_ins_fim, $data_ins);

        if ($verificar) {
            Reserva::cadastrarReservaHoraD($hora_ins_ini, $hora_ins_fim, $data_ins, $id_espaços, $responsavel, $motivo);
        }
    }else{
        Reserva::cadastrarReservaHoraI($hora_ins_ini, $hora_ins_fim, $data_ins, $id_espaços, $responsavel, $motivo);
    }

}

?>