<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 20/09/2018
 * Time: 2:48 PM
 */
class System{

    public static function api_get_sms($flag = ''){
        ini_set("allow_url_fopen", 1);
        $sms_api_url    = 'https://10.121.23.21/api/query_incoming_sms?flag='.($flag == '' ? '' : 'all');
        try {
            $ch = curl_init();
            // Check if initialization had gone wrong*
            if ($ch === false) {
                throw new Exception('failed to initialize');
            }

            curl_setopt($ch, CURLOPT_URL, $sms_api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, "admin:admin");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $content = curl_exec($ch);

            // Check the return value of curl_exec(), too
            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            /* Process $content here */
            return $content;
//            return true;

            // Close curl handle
            curl_close($ch);
        } catch(Exception $e) {
//            return $e->getCode.' - '.$e->getMessage();
            return false;

        }
    }

    public static function api_send_sms($number, $text, $port, $name){
        try{
            $array_obj      =   array('number' => $number, 'text_param' => $name, 'user_id' => 1);
            $data           =   array('text' => $text, 'port' => [$port], 'param' => array($array_obj));
            $data_string    =   json_encode($data);
            ini_set("allow_url_fopen", 1);
            $ch = curl_init('https://10.121.23.21/api/send_sms');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_USERPWD, "admin:admin");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );

            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }catch(Exception $e){
//            var_dump($e->getMessage());
            return false;
        }
    }

    public static function create_notification($type, $key){
        $CI =& get_instance();
        $CI->load->model('Common_model');

        $notif_insert['notification_type']      =   $type;
        $notif_insert['notification_date']      =   date('Y-m-d h:i:s');
        $notif_insert['notification_key']       =   $key;
        $notif_insert['notification_status']    =   0;

        $CI->Common_model->InsertDataToSingleTable('gsm_sms_notifications', $notif_insert);
    }

    public static function get_notifications(){
        $CI =& get_instance();
        $CI->load->model('Common_model');
        $fetch_notif        =   $CI->Common_model->GetDataFromSingleTable('notification_type, count(notification_type)', 'gsm_sms_notifications', array('notification_status' => 0), 0, 0, '', 'notification_type');

        return $fetch_notif;
    }

    public static function get_notification_text($notif_code){
        switch($notif_code){
            case    'user':
                return 'New user/s';
                break;
            case    'user_del':
                return 'User/s deleted';
                break;
            case    'message':
                return 'New message/s';
                break;
        }
    }

    public static function generate_notification(){
        $notification_data  =   System::get_notifications();
        $total_notif        =   0;
        $notif_data         =   array();

        if($notification_data){
            foreach($notification_data as $key=>$notif){
                $notif_data[$notif['notification_type']]    =   $notif['count(notification_type)'];
                $total_notif++;
            }
        }


        $data['total_notif']    =   $total_notif;
        $data['notif_data']     =   $notif_data;

        return $data;
    }

    public static function get_permission($user_id){
        $CI =& get_instance();
        $CI->load->model('Common_model');

        $user_data  =   $CI->Common_model->GetSingleDataFromSingleTable('level', 'gsm_sms_users', array('Id' => $user_id));

        switch($user_data['level']){
            case    1:
                return 'all';
                break;
            case    2:
                return 'read & edit';
                break;
            case    3:
                return 'view only';
                break;
        }
    }

    public static function clear_notification($notif, $key = ''){
        $CI =& get_instance();
        $CI->load->model('Common_model');
        $data_where['notification_type']    =   $notif;
        if($key != ''){
            $data_where['notification_key']    =   $key;
        }

        $CI->Common_model->UpdateDataFromSingleTable('gsm_sms_notifications',array('notification_status' => 1), $data_where);
    }

    public static function get_real_number($raw_number){
        if(strpos($raw_number, '+63') !== false){
            $real_number   =   ltrim($raw_number, '+63');
        }elseif(substr($raw_number, 0, 1) === '0'){
            $real_number   =   ltrim($raw_number, '0');
        }else{
            $real_number   =   $raw_number;
        }

        return $real_number;
    }

    public static function get_contact_name_by_number($number){
        $CI =& get_instance();
        $CI->load->model('Common_model');

        $query          =   'SELECT * FROM gsm_sms_contacts WHERE number LIKE "%'.$number.'%"';
        $contact_data   =   $CI->Common_model->ProcessDataQuery($query);

        if($contact_data){
            return $contact_data[0]['first_name'].' '.$contact_data[0]['last_name'];
        }else{
            return false;
        }
    }

}