<?php

require_once("../FPDF/fpdf.php");
require_once("../../model/EspEquip.class.php");

$pdf = new  FPDF();
        $pdf->addPage();
        $pdf->setFont('arial','B', 12);
        $pdf->Image("C:/xampp/htdocs/proj_reservas/view/assets/images/images.jpg", 10, 10, 45, 25, 'JPG');
        $pdf->cell(0, 10 , "          EEEP SALABERGA TORQUATO GOMES DE MATOS", 0 , 1, 'R');
        $pdf->cell(0, 10 , utf8_decode("EMI em Informática"), 0 , 0, 'R');
        $pdf->ln(15);
        $pdf->cell(0, 10 , utf8_decode("Relatório de Espaços"), 0 , 0, 'C');
        $pdf->ln(10);

$pdo = new PDO("mysql:host=localhost; dbname=proj_reserva","root","");
        $consulta = "select * from espaços";
        $consultafeita = $pdo->prepare($consulta);
        $consultafeita->execute();

        $pdf->Cell(20,5,"Id",1,0,'L');
        $pdf->Cell(40,5,"Nome",1,1,'L');
        $pdf->setFont('arial','', 10);

            foreach ($consultafeita as $value) {
                if ($value['id']<10) {
                    $pdf->Cell(20,5,"0".$value['id'],1,0,'L');
                }else {
                    $pdf->Cell(20,5,$value['id'],1,0,'L');
                }
                $pdf->Cell(40,5, utf8_decode($value['nome_esp']),1,1,'L');

            }

$pdf->output("relatorio.pdf", "I");

?>