<?php namespace Histoweb\Components\Pdf;

class Pdf extends \TCPDF {

    protected  $titleHeader = '';


    public function  setTitleHeader($titleHeader)
    {
        $this->titleHeader = $titleHeader;
    }


    //Page header
    public function Header() {
        // Logo
        $image_file = public_path().'/img/favicon.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 13);
        $txt = 'Histoweb
         '.$this->titleHeader;
        $this->MultiCell(0, 15,$txt, 0, 'C', 0, 0, '', '', true);
        $this->SetY(25);
        $this->Cell(0,15,'','T');

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(10,10,('Fecha realizado:'.date("Y-m-d H:i:s")),0,'','L');
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}