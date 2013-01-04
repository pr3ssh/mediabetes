<?php

class Configuracion extends CI_Controller {
 function genera_pdf(){
            /*load library cezpdf*/
            $this->load->library('cezpdf');
            $this->load->helper('pdf_helper');
            prep_pdf();
            $this->cezpdf->ezText('<b>Cliente No.:</b> 12');
            $this->cezpdf->ezText('<b>Cliente:</b> Abraham Zenteno Sanchez');
            $this->cezpdf->ezText('<b>Tienda:</b>  Plaza Dorada');
            $this->cezpdf->ezText('<b>Fecha y hora de impresion:</b> '.date('Y-m-d').', '.date('H:i').' hrs.');
            $this->cezpdf->ezText('');
            $db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
   
            $col_names = array(
                'eye' => '',
                'ESF' => 'ESF.',
                'CIL' => 'CIL.',
                'EJE' => 'EJE',
                'ADD' => 'ADD',
                'REF' => ''           
            );
   
            $this->cezpdf->ezTable($db_data, $col_names, 'Graduacion registrada el 3 de Diciembre del 2009', array('width'=>550));
           
            $this->cezpdf->ezStream(array('Content-Disposition'=>'nama_file.pdf'));

}
}