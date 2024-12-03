<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH."PHPExcel/Classes/PHPExcel.php";
class Excel extends PHPExcel {
    /*
     * Header fields
     */
    private $fields = array();
    /*
     * Rows data
     */
    private $data = array();
    /*
     * Title for document
     */
    private $title = "";
    /*
     * File name for document
     */
    private $fileName = "Excel";
    /*
     * Header row number
     */
    private $headAlpha = 1;
    /*
     * Filter of report
     */
    private $filter;


    public function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $CI->load->helper(['url','form']);
        $CI->config->item('base_url');
    }
    /*
     * Set filename
     */
    public function setFileName($fileName){
        $this->fileName = $fileName;
        return $this;
    }
    /*
     * Set fields
     */
    public function setFields($fields){
        $this->fields = $fields;
        return $this;
    }
    /*
     * Set rows data
     */
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    /*
     * Set Title for document
     */
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    /*
     * Set filter
     */
    public function setFilter($filter){
        $this->filter = $filter;
        $this->headAlpha = 1;
        return $this;
    }
    /*
     * Download excel with header
     */
    public function downloadExcel(){
        $CI =& get_instance();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.  $this->fileName.'.xls"');
        header('Cache-Control: max-age=0');
        $this->setActiveSheetIndex(0);
        $this->getActiveSheet()->setTitle($this->fileName);
        $alphabet = "A";

        foreach($this->fields as $key=>$field){
            $this->getActiveSheet()->setCellValue($alphabet.$this->headAlpha, $field);
            $this->getActiveSheet()->getStyle($alphabet.$this->headAlpha)->getFont()->setSize(10);
            $this->getActiveSheet()->getStyle($alphabet.$this->headAlpha)->getFont()->setBold(true);
            $this->getActiveSheet()->getColumnDimension($alphabet)->setAutoSize(true);
            $alphabet++;
        }
        $this->getActiveSheet()->fromArray($this->data, NULL, 'A'.($this->headAlpha+2));


        //$this->getActiveSheet()->fromArray($data);
        $writer = PHPExcel_IOFactory::createWriter($this, 'Excel5');
        // This line will force the file to download
        $writer->save('php://output');
    }
    /*
     * Set background color to cell
     */
    function cellColor($cells,$color){

        $this->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                 'rgb' => $color
            )
        ));
    }
}
