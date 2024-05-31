<?php

class EspEquip{

    public function cadastrarEsp($nome){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "INSERT INTO espaços VALUES (null, :nome_esp)";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":nome_esp", $nome);
        $consultafeita->execute();
        header('location:../view/adm/cad_conf.php');

    }

    public function excluirEsp($id){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "delete from espaços where id = :id";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":id", $id);
        $consultafeita->execute();
        $x = $consultafeita->rowCount();
        if($x==0){
            header('location:../view/erro_geral.php');
        }else{
            header('location:../view/adm/exc_conf.php');
        }
          
    }

    public function cadastrarEquip($nome){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "INSERT INTO equipamentos VALUES (null, :nome_eqp)";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":nome_eqp", $nome);
        $consultafeita->execute();
        header('location:../view/adm/cad_conf.php');
        
    }

    public function excluirEqp($id){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "delete from equipamentos where id = :id";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":id", $id);
        $consultafeita->execute();
        $x = $consultafeita->rowCount();
        if($x==0){
            header('location:../view/erro_geral.php');
        }else{
            header('location:../view/adm/exc_conf.php');
        }
          
    }

}

?>