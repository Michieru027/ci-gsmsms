<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 20/09/2018
 * Time: 11:19 AM
 */
class Dashboard extends MY_Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        $dashboard_data             =   $this->get_dashboard_data();
        $data['total_users']        =   $dashboard_data['total_users'];
        $data['page_title']         =   'Dashboard';
        $data['js']                 =   'dashboard/angular/dashboard-ng.js';
        $data['json_chart_data']    =   $this->get_data_chart();
        $this->template->title("GSM SMS Dashboard")
            ->set_layout('dashboard/layout')
            ->build('dashboard', $data);
    }

    public function test_chart(){
        $data['page_title']         =   'Dashboard';
        $data['js']                 =   'dashboard/angular/sms-ng.js';
        $data['json_chart_data']    =   $this->get_data_chart();
        $this->template->title("GSM SMS Dashboard")
            ->set_layout('dashboard/layout')
            ->build('sample', $data);
    }

    public function get_data_chart(){
        $sql = 'SELECT count(timestamp) as TotalRecv, DATE_FORMAT(timestamp, \'%c-%e-%y\') AS RecvDate
                FROM gsm_sms_received
                GROUP BY DATE_FORMAT(timestamp, \'%c-%e-%y\')';

        $query_result   =   $this->Common_model->ProcessDataQuery($sql);
        $arr_date       =   array();
        $arr_data       =   array();
        foreach($query_result as $k=>$data){

            array_push($arr_date, $data['RecvDate']);
            array_push($arr_data, (int)$data['TotalRecv']);
        }

        $return_data['xData']  =   $arr_date;
        $return_data['yData']  =   $arr_data;

        return $return_data;
    }

    public function process_api_sms(){
        try{
            $fetch_sms_data_all =   System::api_get_sms('all');
            $fetch_sms_data     =   System::api_get_sms();

            if($fetch_sms_data_all || $fetch_sms_data){
                $decoded_data       =   json_decode($fetch_sms_data, true);
                $decoded_data_all   =   json_decode($fetch_sms_data_all, true);
                if(is_array($fetch_sms_data_all)){
                    if(count($decoded_data['sms'])){
                        $decoded_data   =   json_decode(array_merge($fetch_sms_data_all, $fetch_sms_data));
                    }else{
                        $decoded_data   =   $decoded_data_all;
                    }

                    foreach($decoded_data['sms'] as $key=>$data){
                        $data_check['incoming_sms_id']  =   $data['incoming_sms_id'];
                        $data_check['port']             =   $data['port'];
                        $data_check['number']           =   $data['number'];
                        $data_check['smsc']             =   $data['smsc'];
                        $data_check['timestamp']        =   $data['timestamp'];
                        $fetched_sms_db_data            =   $this->Common_model->GetSingleDataFromSingleTable('*', 'gsm_sms_received', $data_check);

                        if(!$fetched_sms_db_data){
                            $data['date_captured']  =   date('Y-m-d H:i:s');
                            $sms_id =   $this->Common_model->InsertDataToSingleTable('gsm_sms_received', $data);
                            System::create_notification('sms', $sms_id);
                        }
                    }

                    $new_sms                    =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_notifications', array('notification_type' => 'sms', 'notification_status' => 0));
                    $dashboard_data             =   $this->get_dashboard_data();
                    $return_data['total_data']  =   count($new_sms);
                    $return_data['status']      =   'success';
                    $return_data['total_sms']   =   $dashboard_data['total_sms'];
                    $return_data['sms_read']    =   $decoded_data['read'];
                    $return_data['sms_unread']  =   $decoded_data['unread'];

                    echo json_encode($return_data);

                }else{
                    $return_data['status']      =   'error';
                    $return_data['msg']         =   'Error: Something went wrong capturing SMS Data. <br> The URL or credentials might have been changed';
                    echo json_encode($return_data);
                }
            }else{
                $return_data['status']      =   'error';
                $return_data['msg']         =   'Error: Something went wrong capturing SMS Data. <br> The URL or credentials might have been changed';
                echo json_encode($return_data);
            }
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public function get_dashboard_data(){
        $fetched_users  =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_users');
        $fetched_sms    =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_received');

        $data['total_users']    =   count($fetched_users);
        $data['total_sms']      =   count($fetched_sms);

        return $data;
    }

    public function test_process_api_sms(){
        $fetch_sms_data_all =   System::api_get_sms('all');
        var_dump($fetch_sms_data_all);
    }
}