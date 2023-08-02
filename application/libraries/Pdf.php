<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=True, $paper='A3', $orientation='portrait'){
        $dompdf = new Dompdf\Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}
?>