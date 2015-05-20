<?php namespace Histoweb\Components\Pdf;

use Illuminate\Session\Store as Session;
use Elibyy\TCPDF\Pdf as  Pdf;

class PdfBuilder {

    protected $session;
    protected $pdf;

    public function __construct(Session $session, Pdf $pdf)
    {
        $this->session = $session;
        $this->pdf = $pdf;
    }

    public function getHeaderPdf()
    {


    }

    public function getFooterPdf()
    {

    }





    
} 