<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 25/10/2018
 * Time: 11:47 AM
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Phpexcel extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        redirect(base_url().'dashboard/sms');
    }

    public function export($export_data){
        $spreadsheet    =   new Spreadsheet();
        $sheet          =   $spreadsheet->getActiveSheet();


        $sms_data       =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_'.$export_data);
        $c              =   2;
        $sheet->setCellValue('A1', 'Port');
        $sheet->setCellValue('B1', 'Imsi');
        $sheet->setCellValue('C1', 'Number');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Text');

        foreach($sms_data as $data){
            $sheet->setCellValue('A'.$c, $data['port']);
            $sheet->setCellValue('B'.$c, $data['imsi']);
            $sheet->setCellValue('C'.$c, $data['number']);
            $sheet->setCellValue('D'.$c, $data['timestamp']);
            $sheet->setCellValue('E'.$c, $data['text']);
            $c++;
        }

        $writer         =   new Xlsx($spreadsheet);
        $filename       =   'oshopping_gsmsms_data-'.time();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function import($import_data){
        $file_exts  =   array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['sms_import_data']['name']) && in_array($_FILES['sms_import_data']['type'], $file_exts)){
            $data_file  =   explode('.', $_FILES['sms_import_data']['name']);
            $ext        =   end($data_file);

            if($ext == 'csv'){
                $reader =   new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            }else{
                $reader =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet    =   $reader->load($_FILES['sms_import_data']['tmp_name']);
            $sheet_data     =   $spreadsheet->getActiveSheet()->toArray();

            if($sheet_data){
                if($sheet_data[0][0] == 'Port' &&
                    $sheet_data[0][1] == 'Imsi' &&
                    $sheet_data[0][2] == 'Number' &&
                    $sheet_data[0][3] == 'Recv Date' &&
                    $sheet_data[0][4] == 'content'){
                    foreach($sheet_data as $k=>$data){
                        if($k == 1){
                            $data_insert['port']        =   $data[0];
                            $data_insert['imsi']        =   $data[1];
                            $data_insert['number']      =   $data[2];
                            $data_insert['timestamp']   =   $data[3];
                            $data_insert['text']        =   $data[4];

                            $sms_id =   $this->Common_model->InsertDataToSingleTable('gsm_sms_'.$import_data, $data_insert);
                            System::create_notification('import_sms', $sms_id);
                        }
                    }
                    $this->session->set_flashdata('validation_success', 'Data has been successfully imported to database');
                }else{
                    $this->session->set_flashdata('validation_errors', 'The uploaded excel file has incorrect format of data, please revise');
                }
            }else{
                $this->session->set_flashdata('validation_errors', 'No excel data detected, please try again');
            }
        }else{
            $this->session->set_flashdata('validation_errors', 'To avoid errors on uploading, please do upload <b>.csv</b> or <b>.xlsx</b> format');
        }

        redirect(base_url().'dashboard/sms');
    }
}