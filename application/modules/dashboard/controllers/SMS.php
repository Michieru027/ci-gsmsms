<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 24/09/2018
 * Time: 1:20 PM
 */
class SMS extends MY_Controller {

    public function __construct(){
        parent::__construct();
        modules::load('Dashboard');
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        $data['page_title']     =   'List of all SMS Data Received';
        $data['received_sms']   =   $this->list_sms_received();
        $data['sent_sms']       =   $this->list_sms_sent();
        $data['js']             =   'dashboard/sms.js';
        $this->template->title("GSM SMS Data")
            ->set_layout('dashboard/layout')
            ->build('sms', $data);
    }

    public function list_sms_received(){
        $sms_query  =   'SELECT * FROM gsm_sms_received WHERE Id IN (SELECT MAX(Id) FROM gsm_sms_received GROUP BY number) ORDER BY `timestamp` DESC';
        $fetch_data =   $this->Common_model->ProcessDataQuery($sms_query);
        $table_html =   '';
        $count_sms  =   0;

        if($fetch_data){
            foreach($fetch_data as $key=>$sms){
                $real_number    =   System::get_real_number($sms['number']);
                $contact_name   =   System::get_contact_name_by_number($real_number);
                $check_new  =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_notifications', array('notification_key' => $sms['Id'], 'notification_type' => 'sms', 'notification_status' => 0));
                $badge_new  =   '<span class="badge badge-pill badge-new">New</span>';
                $table_html .=  '<tr class="sms-text" id="sms-'.$sms['Id'].'" data-state="received" data-number="'.$sms['number'].'" title="Click to reply">';
                $table_html .=  '    <td valign="middle" class="sms_id">'.($check_new ? $badge_new : '').' '.$sms['incoming_sms_id'].'</td>';
                $table_html .=  '    <td valign="middle" class="sms_port">'.$sms['port'].'</td>';
                $table_html .=  '    <td valign="middle" class="sms_num">'.($contact_name ? $contact_name : $sms['number']).'</td>';
                $table_html .=  '    <td valign="middle">'.$sms['text'].'</td>';
                $table_html .=  '    <td valign="middle">'.$sms['timestamp'].'</td>';
                $table_html .=  '</tr>';
                $count_sms++;
            }
        }else{
            $table_html    .=   '<tr><td colspan="6" class="text-center">There are no SMS data found</td></tr>';
        }

        $data['table_html'] =   $table_html;
        $data['total_data'] =   $count_sms;

        return $data;
    }

    public function list_sms_sent(){
        $sms_query  =   'SELECT * FROM gsm_sms_reply WHERE Id IN (SELECT MAX(Id) FROM gsm_sms_reply GROUP BY number) ORDER BY `date_created` DESC';
        $fetch_data =   $this->Common_model->ProcessDataQuery($sms_query);
        $table_html =   '';
        $count_sms  =   0;

        if($fetch_data){
            foreach($fetch_data as $k=>$sms){
                $real_number    =   System::get_real_number($sms['number']);
                $contact_name   =   System::get_contact_name_by_number($real_number);
                $table_html .=  '<tr class="sms-sent-text"  id="sms-'.$sms['Id'].'" data-state="reply" data-number="'.$sms['number'].'" title="Click to open">';
                $table_html .=  '    <td>'.$sms['Id'].'</td>';
                $table_html .=  '    <td>'.($contact_name ? $contact_name : $sms['number']).'</td>';
                $table_html .=  '    <td>'.$sms['port'].'</td>';
                $table_html .=  '    <td>'.$sms['text'].'</td>';
                $table_html .=  '    <td>'.$sms['date_created'].'</td>';
                $table_html .=  '</tr>';
                $count_sms++;
            }

            $data['table_html'] =   $table_html;
            $data['total_data'] =   $count_sms;

            return $data;
        }
    }

    public function fetch_sms_data(){
        $sms_no =   $_POST['sms_no'];
        $state  =   $_POST['state'];
        $real_number    =   System::get_real_number($sms_no);

        $query          =   'SELECT * FROM (
                                SELECT Id, port AS Port, 
                                       number AS Number, 
                                       text AS Message,
                                       status AS State,
                                      date_created AS Date 
                                FROM gsm_sms_reply WHERE number LIKE \'%'.$real_number.'%\'
                            
                                UNION ALL
                            
                                SELECT Id, port AS Port, 
                                       number AS Number, 
                                       text AS Message,
                                       status AS State,
                                      timestamp AS Date 
                                FROM gsm_sms_received WHERE number LIKE \'%'.$real_number.'%\'
                            
                            ) u ORDER BY Date ASC';
        $fetch_data     =   $this->Common_model->ProcessDataQuery($query);

        $contact_name   =   System::get_contact_name_by_number($real_number);
        if($fetch_data){
            $html_thread =   '';
            foreach($fetch_data as $key=>$sms){
                if($sms['State'] == 'reply'){
                    $html_thread .=  '<div style="display:block;width:82%;text-align:right;">';
                    $html_thread .=  '  <div class="alert alert-secondary thread-item sent-message-reply" id="thread-'.$sms['Id'].'" role="alert" style="margin-bottom:10px;text-align:left;">'.$sms['Message'];
                    $html_thread .=  '        <span class="thread-time">'.date('M/d/Y h:i:s A', strtotime($sms['Date'])).' <b style="color:red;">Port: '.$sms['Port'].'</b></span>';
                    $html_thread .=  '    </div>';
                    $html_thread .=  '</div>';
                }else{
//                    $fetch_reply    =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_reply', 'number LIKE "%'.$where_number.'%"', 0, 0, 'date_created ASC');
                    $html_thread .=  '<div style="display:block;">';
                    $html_thread .=  '  <div class="alert alert-primary thread-item" id="thread-'.$sms['Id'].'" role="alert" style="margin-bottom:10px;">'.$sms['Message'];
                    $html_thread .=  '        <span class="thread-time">'.date('M/d/Y h:i:s A', strtotime($sms['Date'])).' <b style="color:red;">Port: '.$sms['Port'].'</b></span>';
                    $html_thread .=  '    </div>';
                    $html_thread .=  '</div>';
//                    if($fetch_reply){
//                        foreach($fetch_reply as $key=>$sent){
//                            $html_thread .=  '<div class="alert alert-secondary thread-item sent-message-reply" id="thread-'.$sent['Id'].'" role="alert" style="width:80%;margin-bottom:10px;">'.$sent['text'].'<span class="thread-time">'.date('M/d/Y h:i:s A', strtotime($sent['date_created'])).' <b style="color:red;">Port: '.$sent['port'].'</b></span></div>';
//                        }
//                    }
                }

            }

            if($contact_name){
                $data['contact_name']    =   $contact_name;
            }else{
                $data['contact_name']   =   '';
            }

            System::clear_notification('sms', $sms['Id']);
            $data['html_reply'] =   $html_thread;
            $data['thread_id']  =   $sms['Id'];
            $data['port']       =   $sms['Port'];
        }else{
            $data['state']  =   'Failed';
            $data['msg']    =   'Message is not existing';
        }

        echo json_encode($data);
    }

    public function reply_sms_api(){
        if($_POST){
            $gsm_sms_received_id            =   $_POST['sms_id'];
            $number                     =   $_POST['recepient'];
            $port                       =   $_POST['port'];
            $text                       =   $_POST['reply_body'];

            $data['gsm_sms_received_Id']    =   $gsm_sms_received_id;
            $data['number']             =   $number;
            $data['port']               =   $port;
            $data['text']               =   $text;
            $data['name']               =   $this->username;
            $data['date_created']       =   date('Y-m-d H:i:s');
            $data['status']             =   'reply';

            $save_data  =   $this->Common_model->InsertDataToSingleTable('gsm_sms_reply', $data);

            if($save_data){
                $send_sms   =   System::api_send_sms($number, $text, (int)$port, $this->username);
                if($send_sms){
                    $html_send   =  '<div class="alert alert-secondary thread-item sent-message-reply" id="thread-'.$save_data.'" role="alert" style="width:80%;">';
                    $html_send  .=  $text;
                    $html_send  .=  '<span class="thread-time">'.date('M/d/Y h:i:s A', strtotime($data['date_created'])).' <b style="color:red;">Port: '.$port.'</b></span>';
                    $html_send  .=  '</div>';

                    $data['thread_id']  =   $gsm_sms_received_id;
                    $data['state']      =   'success';
                    $data['sent_body']  =   $html_send;
                    echo json_encode($data);
                }else{
                    $data['state']      =   'error';
                    $data['msg']        =   'Unable to send sms';
                }
            }else{
                $data['state']      =   'error';
                $data['msg']        =   'Unable to save data';
                echo json_encode($data);
            }
        }
    }

    public function send_new_sms_api(){
        if($_POST){
            $contact                     =   $_POST['recepient'];

            if(strpos($contact, ':')){
                $number =   explode(': ', $contact);
            }else{
                $number =   $contact;
            }

            $port                       =   $_POST['port'];
            $text                       =   $_POST['sms_body'];

            $data['number']             =   $number[1];
            $data['port']               =   $port;
            $data['text']               =   $text;
            $data['name']               =   $this->username;
            $data['date_created']       =   date('Y-m-d H:i:s');
            $data['status']             =   'reply';

            $save_data  =   $this->Common_model->InsertDataToSingleTable('gsm_sms_reply', $data);

            if($save_data){
                $send_sms   =   System::api_send_sms($number[1], $text, (int)$port, $this->username);
                if($send_sms){
                    $html_send   =  '<div class="alert alert-secondary thread-item sent-message-reply" id="thread-'.$save_data.'" role="alert" style="width:80%;">';
                    $html_send  .=  $text;
                    $html_send  .=  '<span class="thread-time">'.date('M/d/Y h:i:s A', strtotime($data['date_created'])).' <b style="color:red;">Port: '.$port.'</b></span>';
                    $html_send  .=  '</div>';

                    $data['contact']    =   (is_array($number) ? $number[0] : $number);
                    $data['state']      =   'success';
                    $data['sent_body']  =   $html_send;
                    echo json_encode($data);
                }else{
                    $data['state']  =   'error';
                    $data['msg']    =   'Unable to send SMS';
                }

            }else{
                $data['state']      =   'error';
                $data['msg']        =   'Unable to save data';
                echo json_encode($data);
            }
        }
    }

    public function test_sms($number){
        var_dump(System::api_send_sms($number, 'hello world', 1, $this->username));
    }

}