<?php

class ReservaEsp {

    public function get_reserva($id_espaços, $hora_instavel_inicio, $hora_instavel_fim, $data_instavel) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
            $select = $pdo->prepare("SELECT * FROM hora_instavel WHERE hora_instavel_inicio = :hora_instavel_inicio AND hora_instavel_fim = :hora_instavel_fim AND data_instavel = :data_instavel"); 
            $select->bindValue(":hora_instavel_inicio", $hora_instavel_inicio); 
            $select->bindValue(":hora_instavel_fim", $hora_instavel_fim); 
            $select->bindValue(":data_instavel", $data_instavel); 
            $select->execute();
            $x = $select->rowCount();
            if($x>0){
                foreach($select as $value){
                    $id_hora_instavel = $value['id'];
                    $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
                    $selecto = $pdo->prepare("SELECT * FROM reservas_esp WHERE id_espaços = :id_espaços AND id_hora_instavel = :id_hora_instavel");
                    $selecto->bindValue(":id_espaços", $id_espaços); 
                    $selecto->bindValue(":id_hora_instavel", $id_hora_instavel); 
                    $selecto->execute();
                    return $selecto->fetch(PDO::FETCH_ASSOC);
                } 
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

    public function reg_reservaEsp($id_espaços, $hora_instavel_inicio, $hora_instavel_fim, $data_instavel, $id_usuarios, $responsavel, $motivo) {
        try {
            if (!$this->get_reserva($id_espaços, $hora_instavel_inicio, $hora_instavel_fim, $data_instavel)) {
                $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
                $reghorains = $pdo->prepare("INSERT INTO hora_instavel (hora_instavel_inicio, hora_instavel_fim, data_instavel) VALUES (:hora_instavel_inicio, :hora_instavel_fim, :data_instavel)");
                $reghorains->bindValue(":hora_instavel_inicio", $hora_instavel_inicio); 
                $reghorains->bindValue(":hora_instavel_fim", $hora_instavel_fim); 
                $reghorains->bindValue(":data_instavel", $data_instavel); 
                $reghorains->execute();
                $ultimo_id = $pdo->lastInsertId();
                $y = $reghorains->rowCount();
                if($y>0){
                    $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
                    $regreserva = $pdo->prepare("INSERT INTO reservas_esp VALUES (null, :id_espaços, :id_hora_instavel, :id_usuarios, :responsavel, :motivo)");
                    $regreserva->bindValue(":id_espaços", $id_espaços); 
                    $regreserva->bindValue(":id_hora_instavel", $ultimo_id); 
                    $regreserva->bindValue(":id_usuarios", $id_usuarios); 
                    $regreserva->bindValue(":responsavel", $responsavel); 
                    $regreserva->bindValue(":motivo", $motivo); 
                    $regreserva->execute();
                    header('location:../view/reserva/reg_reserva_conf.php');
                }
            } else {
                header('location:../view/reserva/reg_reserva_indis.php');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

}

?>
