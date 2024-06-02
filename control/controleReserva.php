<?php

require('../model/Reserva.class.php');
require('../model/Usuario.class.php');
require('../model/EspEquip.class.php');

if(isset($_POST['gerar_rel'])){

    header('location:../view/relatorios/relatorio_reserva.php');

}

?>