<?php

class Usuario{

    public function autenticarUsuario($credencial, $senha){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "select * from usuarios where :credencial = credencial and :senha = senha";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":credencial", $credencial);
        $consultafeita->bindValue(":senha", $senha);
        $consultafeita->execute();
        $x = $consultafeita->rowCount();
        if($x>0){
            session_start();
            foreach($consultafeita as $value){
            $_SESSION['tipo'] = $value['tipo'];
            }
            header('location:../control/controleLogin.php?opc=1');
        }else{
            header('location:../view/erro_login.php');
        }

    }

    public function cadastrarUsuario($tipo, $credencial, $email, $senha){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "INSERT INTO usuarios VALUES (null, :tipo, :credencial, :email, :senha)";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":tipo", $tipo);
        $consultafeita->bindValue(":credencial", $credencial);
        $consultafeita->bindValue(":email", $email);
        $consultafeita->bindValue(":senha", $senha);
        $consultafeita->execute();
        header('location:../view/adm/cad_conf.php');
        
    }

    public function excluirUsuario($credencial, $senha){
        $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
        $consulta = "delete from usuarios where :credencial = credencial and :senha = senha";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->bindValue(":credencial", $credencial);
        $consultafeita->bindValue(":senha", $senha);
        $consultafeita->execute();
        $x = $consultafeita->rowCount();
        if($x=0){
            $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
            $consulta = "select * from usuarios where :credencial = credencial";
            $consultafeita = $pdo->prepare($consulta);
            $consultafeita->bindValue(":credencial", $credencial);
            $y = $consultafeita->rowCount();
            if($y=0){
                header('location:../view/erro_geral.php');
            }
            $pdo = new PDO("mysql:host=localhost;dbname=proj_reserva", "root", "");
            $consulta = "select * from usuarios where :senha = senha";
            $consultafeita = $pdo->prepare($consulta);
            $consultafeita->bindValue(":senha", $senha);
            $y = $consultafeita->rowCount();
            if($y=0){
                header('location:../view/erro_geral.php');
            }
        }else{
            header('location:../view/adm/exc_conf.php');
        }
          
    }

}

?>