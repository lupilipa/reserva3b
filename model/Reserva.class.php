<?php

class Reserva {

    public static function conectarBanco() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro de conexão com o banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public static function verificarHoraEx($hora_ins_ini, $hora_ins_fim, $data_ins) {
        try {
            $pdo = self::conectarBanco();
            $consulta = "SELECT * FROM hora_instavel WHERE hora_ins_ini = :hora_ins_ini 
            AND hora_ins_fim = :hora_ins_fim AND data_ins = :data_ins";
            $consultafeita = $pdo->prepare($consulta);
            $consultafeita->bindValue(":hora_ins_ini", $hora_ins_ini);
            $consultafeita->bindValue(":hora_ins_fim", $hora_ins_fim);
            $consultafeita->bindValue(":data_ins", $data_ins);
            $consultafeita->execute();
            foreach($consultafeita as $value){
                $resultados = $value['id'];
            }
            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao verificar hora instável: " . $e->getMessage();
            return null;
        }
    }

    public static function verificarDispon($id_espaços, $id_hora_instavel, $hora_ins_ini, $hora_ins_fim, $data_ins) {
        try {
            $pdo = self::conectarBanco();
            $resultados = self::verificarHoraEx($hora_ins_ini, $hora_ins_fim, $data_ins);
            if ($resultados) {
                foreach($resultados as $value){
                    $id_hora_instavel = $value['id'];

                    $consulta2 = "SELECT * FROM reservas_esp WHERE id_espaços = :id_espaços AND id_hora_instavel = :id_hora_instavel";
                    $consultafeita2 = $pdo->prepare($consulta2);
                    $consultafeita2->bindValue(":id_espaços", $id_espaços);
                    $consultafeita2->bindValue(":id_hora_instavel", $id_hora_instavel);
                    $consultafeita2->execute();
                    $y = $consultafeita2->rowCount();
                    if ($y == 0) {
                        return true;
                    } else {
                        header('location:../view/reserva/reg_reserva_indis.php');
                        exit();
                    }
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao verificar disponibilidade: " . $e->getMessage();
        }
    }

    public static function cadastrarReservaHoraD($hora_ins_ini, $hora_ins_fim, $data_ins, $id_espaços, $responsavel, $motivo) {
        try {
            $pdo = self::conectarBanco();
            $resultados = self::verificarHoraEx($hora_ins_ini, $hora_ins_fim, $data_ins);
            if ($resultados) {
                foreach($resultados as $value){
                    $id_hora_instavel = $value['id'];

                    $consulta2 = "INSERT INTO reservas_esp VALUES(null, :id_espaços, :id_hora_instavel, 
                    null, :responsavel, :motivo)";
                    $consultafeita2 = $pdo->prepare($consulta2);
                    $consultafeita2->bindValue(":id_espaços", $id_espaços);
                    $consultafeita2->bindValue(":id_hora_instavel", $id_hora_instavel);
                    $consultafeita2->bindValue(":responsavel", $responsavel);
                    $consultafeita2->bindValue(":motivo", $motivo);
                    $consultafeita2->execute();
                    $resultado2 = $consultafeita2->fetch(PDO::FETCH_ASSOC);
                    if ($resultado2) {
                        header('location:../view/adm/cad_conf.php');
                    } else {
                        header('location:../view/reserva/reg_reserva_error.php');
                    }
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar reserva: " . $e->getMessage();
        }
    }

    public static function cadastrarReservaHoraI($hora_ins_ini, $hora_ins_fim, $data_ins, $id_espaços, $responsavel, $motivo) {
        try {
            $pdo = self::conectarBanco();
            $consulta = "INSERT INTO hora_instavel VALUES(null, :hora_ins_ini, :hora_ins_fim, :data_ins)";
            $consultafeita = $pdo->prepare($consulta);
            $consultafeita->bindValue(":hora_ins_ini", $hora_ins_ini);
            $consultafeita->bindValue(":hora_ins_fim", $hora_ins_fim);
            $consultafeita->bindValue(":data_ins", $data_ins);
            $consultafeita->execute();
            $resultados = self::verificarHoraEx($hora_ins_ini, $hora_ins_fim, $data_ins);
            if ($resultados) {
                foreach($resultados as $value){
                    $id_hora_instavel = $value['id'];

                    $consulta2 = "INSERT INTO reservas_esp VALUES(null, :id_espaços, :id_hora_instavel, 
                    null, :responsavel, :motivo)";
                    $consultafeita2 = $pdo->prepare($consulta2);
                    $consultafeita2->bindValue(":id_espaços", $id_espaços);
                    $consultafeita2->bindValue(":id_hora_instavel", $id_hora_instavel);
                    $consultafeita2->bindValue(":responsavel", $responsavel);
                    $consultafeita2->bindValue(":motivo", $motivo);
                    $consultafeita2->execute();
                    $resultado2 = $consultafeita2->fetch(PDO::FETCH_ASSOC);
                    if ($resultado2) {
                        header('location:../view/adm/cad_conf.php');
                    } else {
                        header('location:../view/reserva/reg_reserva_error.php');
                    }
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar hora instável e reserva: " . $e->getMessage();
        }
    }

}

?>
