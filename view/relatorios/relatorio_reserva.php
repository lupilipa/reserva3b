<?php

require_once("../FPDF/fpdf.php");
require_once("../../model/Reserva.class.php");

$pdf = new  FPDF();
        $pdf->addPage();
        $pdf->setFont('arial','B', 12);
        $pdf->Image("C:/xampp/htdocs/proj_reservas/view/assets/images/images.jpg", 10, 10, 45, 25, 'JPG');
        $pdf->cell(0, 10 , "          EEEP SALABERGA TORQUATO GOMES DE MATOS", 0 , 1, 'R');
        $pdf->cell(0, 10 , utf8_decode("EMI em Informática"), 0 , 0, 'R');
        $pdf->ln(15);
        $pdf->cell(0, 10 , utf8_decode("Relatório de Reservas"), 0 , 0, 'C');
        $pdf->ln(10);

$pdo = new PDO("mysql:host=localhost; dbname=proj_reserva","root","");
        $consulta = "select reservas_esp.*, usuarios.*, espaços.*
        from reservas_esp
        inner join usuarios on reservas_esp.id_usuarios = usuarios.id
        inner join espaços on reservas_esp.id_espaços = espaços.id;";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->execute();

        $pdf->Cell(15,5,"Id",1,0,'L');
        $pdf->Cell(35,5,"Registrado por",1,0,'L');
        $pdf->Cell(40,5,utf8_decode("Espaço"),1,0,'L');
        $pdf->Cell(40,5,"Responsavel",1,0,'L');
        $pdf->Cell(60,5,"Motivo",1,1,'L');
        $pdf->setFont('arial','', 10);

            foreach ($consultafeita as $value) {
                if ($value['id']<10) {
                    $pdf->Cell(15,5,"0".$value['id'],1,0,'L');
                }else {
                    $pdf->Cell(15,5,$value['id'],1,0,'L');
                }
                $pdf->Cell(35,5, utf8_decode($value['credencial']),1,0,'L');
                $pdf->Cell(40,5, utf8_decode($value['nome_esp']),1,0,'L');
                $pdf->Cell(40,5, utf8_decode($value['responsavel']),1,0,'L');
                $pdf->Cell(60,5, utf8_decode($value['motivo']),1,1,'L');

            }

$pdf->output("relatorio.pdf", "I");

?>