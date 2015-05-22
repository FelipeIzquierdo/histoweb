<?php namespace Histoweb\Components\Pdf;

use Histoweb\Entities\Procedure;
use Histoweb\Entities\Reason;


class PdfBuilder {

    protected $pdf;

    public function __construct()
    {
        $this->pdf = new Pdf();
    }

    public function historyPdf($entry, $data)
    {
        $this->pdf->setTitleHeader('Historia clinica');
        $patientDocType = $entry->diary->patient->doc_type_doc;
        $patientName = $entry->diary->patient->name;
        $patientDoc = $entry->diary->patient->doc;

        $this->pdf->SetTitle('Historia clinica');
        $this->pdf->SetAuthor('Histoweb');
        $this->pdf->SetTitle('Historia Clinica, '.$patientDocType.':' .$patientDoc .' - '. $patientName);
        $reasons = '';
        foreach ($data['reasons'] as $key )
        {
            if($reasons == ''){
                $reasons = Reason::find($key)->name;
            }
            else{
                $reasons = $reasons.', '. Reason::find($key)->name;
            }
        }
        if($data['new_reasons'] != ''){
            $reasons = $reasons.', '.$data['new_reasons'];
        }

        $this->pdf->AddPage();
        $this->pdf->Ln(20);
        $this->pdf->SetFont('helvetica', 'B', 15);
        $this->pdf->MultiCell(0, 0, 'Historia Clinica, ', 0, 'C', 0, 1, '', '', true, 0);
        $this->pdf->SetFont('helvetica', '', 15);
        $this->pdf->MultiCell(0, 0, $patientDocType.':' .$patientDoc .' - '. $patientName, 0, 'C', 0, 1, '', '', true, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Motivos de consulta : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $reasons, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Enfermedad actual : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $data['present_illness'], '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Antecedentes : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, '', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Revisión de sistemas : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,$data['new_system_revisions'] , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Procedimientos : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,'' , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Diagnosticos : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,'' , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Plan de Manejo : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $data['management_plan'], '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $filename = public_path() . '/documents/historyClinic/'.$entry->id.'.pdf';
        $this->pdf->Output($filename,'F');
    }

    public function orderProceduresPdf($rta, $entry)
    {
        $this->pdf->setTitleHeader('Solicitud de Procedimiento');
        $patientcc = $entry->diary->patient->doc_type_doc;
        $patientname = $entry->diary->patient->name;
        $patientdoc = $entry->diary->patient->doc;

        $this->pdf->SetTitle('Reporte');
        $this->pdf->SetAuthor('Histoweb');
        $this->pdf->SetTitle('Lista de Procedimientos, Paciente '.$patientcc .' - '. $patientname);

        foreach ($rta as $key => $value) {
            $value->entry_id = $entry->id;
            $proc = Procedure::findOrFail($value->procedure_id);
            $proceduretypename = $proc->procedure_type_name;
            $procedurename = $proc->name;

            $this->pdf->AddPage();
            $this->pdf->Ln(20);
            $this->pdf->SetFont('helvetica', 'B', 17);
            $this->pdf->MultiCell(0, 0, 'Lista de Procedimientos, Paciente '.$patientcc .' - '. $patientname, 0, 'C', 0, 1, '', '', true, 0);
            $this->pdf->Ln(10);
            $this->pdf->SetFont('times', '', 14);
            $this->pdf->Write(0, 'Tipo de Procedimiento : '.$proceduretypename, '', 0, '', 0, 0, false, false, 0);
            $this->pdf->SetFont('times', '', 12);
            $this->pdf->Ln(10);
            $this->pdf->Write(0, 'Procedimiento : '.$procedurename, '', 0, '', 0, 0, false, false, 0);
        }

        $filename = public_path() . '/documents/'.$entry->id.'.pdf';
        $this->pdf->Output($filename,'F');
    }
} 