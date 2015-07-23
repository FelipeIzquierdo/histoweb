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

        $filename = public_path() . '/documents/'.$entry->id.'.pdf';
        if(!isset($rta[0]))
        {
            \File::delete($filename);
        }
        else
        {

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

            $this->pdf->Output($filename,'F');
        }
    }


    public function describeProcedurePdf($describeProcedure, $entry)
    {
        $this->pdf->setTitleHeader('Describir Procedimiento');
        $patientDocType = $entry->diary->patient->doc_type_doc;
        $patientName = $entry->diary->patient->name;
        $patientDoc = $entry->diary->patient->doc;

        $this->pdf->SetTitle('Reporte');
        $this->pdf->SetAuthor('Histoweb');
        $this->pdf->SetTitle('Describir Procedimiento, Paciente '.$patientDocType.':'.$patientDoc .' - '. $patientName);

        $this->pdf->AddPage();
        $this->pdf->Ln(20);
        $this->pdf->SetFont('helvetica', 'B', 15);
        $this->pdf->MultiCell(0, 0, 'Describir Procedimiento, ', 0, 'C', 0, 1, '', '', true, 0);
        $this->pdf->SetFont('helvetica', '', 15);
        $this->pdf->MultiCell(0, 0, $patientDocType.':' .$patientDoc .' - '. $patientName, 0, 'C', 0, 1, '', '', true, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Fecha Procedimiento : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->start_date, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Hora Inicio : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->start_time, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Hora Fin : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->end_time, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Consultorio o quirófano : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->surgery->name, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Anestesiólogo : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->doctor->name_specialty_telemedicine, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Instrumentador : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,$describeProcedure->staff->name , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Tipo de anestesia: ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,$describeProcedure->anesthesiaType->name , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Vía de entrada : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0,$describeProcedure->wayEntry->name , '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Estado de vía : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->stateWay->name, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Descripción : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->description, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('times', 'B', 14);
        $this->pdf->Write(0, 'Complicaciones : ', '', 0, '', 0, 0, false, false, 0);
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Write(0, $describeProcedure->complications, '', 0, '', 0, 0, false, false, 0);
        $this->pdf->Ln(10);

        $filename = public_path() . '/documents/describeProcedure/'.$patientDoc.'-'.$describeProcedure->id.'.pdf';
        $this->pdf->Output($filename,'F');

    }


} 