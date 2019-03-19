<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 07/11/2018
 * Time: 11:16 AM
 */
class Contacts extends MY_Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        $data['page_title']     =   'List of all Contacts';
        $data['contacts_data']  =   $this->get_contacts();
        $data['js']             =   'dashboard/sms.js';
        $this->template->title("GSM SMS Contacts")
            ->set_layout('dashboard/layout')
            ->build('contacts', $data);
    }

    public function get_contacts_data(){
        $fetch_contacts =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_contacts', 0, 0, 'Id DESC');
        $data_array     =   array();
        foreach($fetch_contacts as $k=>$contacts){
            $data_array[$k]['name'] =   $contacts['first_name'].' '.$contacts['last_name'].': '.$contacts['number'];
        }

        echo json_encode($data_array);
    }

    public function get_contacts(){
        $fetch_contacts =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_contacts', 0, 0, 'Id DESC');
        $permission     =   System::get_permission($this->id);
        $table_html     =   '';
        $count_contacts =   0;
        if($fetch_contacts){
            foreach($fetch_contacts as $k=>$contact){
                $table_html .=  '<tr>';
                $table_html .=  '    <td>'.$contact['Id'].'</td>';
                $table_html .=  '    <td>'.$contact['number'].'</td>';
                $table_html .=  '    <td>'.$contact['first_name'].'</td>';
                $table_html .=  '    <td>'.$contact['last_name'].'</td>';
                $table_html .=  '    <td>'.$contact['date_added'].'</td>';

                if($this->username == 'admin'){
                    switch($permission){
                        case    'all':
                            $table_html .=  '    <td class="text-center"><a href="javascript:void(0)" class="gsm_edit_user" id="edit-'.$contact['Id'].'" title="Edit contact"><i class="fa fa-edit"></i></a> |';
                            $table_html .=  '    <a href="javascript:void(0)" class="gsm_delete_user" data-toggle="modal" data-target="#modal_del_user" id="delete-'.$contact['Id'].'" title="Delete contact"><i class="fa fa-trash"></i></a></td>';
                            break;
                        case    'read & edit':
                            $table_html .=  '    <td class="text-center"><a href="javascript:void(0)" class="gsm_edit_user" id="edit-'.$contact['Id'].'" title="Edit contact"><i class="fa fa-edit"></i></a> |';
                            $table_html .=  '    Not Allowed</td>';
                            break;
                        case    'view only':
                            $table_html .=  '';
                            break;
                    }
                }

                $table_html .=  '</tr>';
                $count_contacts++;
            }
        }

        $data['table_html']  =   $table_html;
        $data['total_data']  =   $count_contacts;
        return $data;

    }

    public function add(){
        if($_POST){
            $contact_number =   $_POST['contact_number'];
            $first_name     =   $_POST['first_name'];
            $last_name      =   $_POST['last_name'];

            $check_exist    =   $this->Common_model->GetSingleDataFromSingleTable('*', 'gsm_sms_contacts', array('number' => $contact_number));

            if(!$check_exist){
                $data_insert['number']      =   $contact_number;
                $data_insert['first_name']  =   $first_name;
                $data_insert['last_name']   =   $last_name;
                $data_insert['date_added']  =   date('Y-m-d H:i:s');
                $data_insert['state']       =   1;

                $save_contact   =   $this->Common_model->InsertDataToSingleTable('gsm_sms_contacts', $data_insert);

                if($save_contact){
                    System::create_notification('contact_new', $save_contact);
                    $data['state']          =   'success';
                    $data['message']        =   'Successfully added into contacts';
                    $data['contact_name']   =   $first_name.' '.$last_name;
                }else{
                    $data['state']      =   'failed';
                    $data['message']    =   'Failed to save contact, database error occurred';
                }
            }else{
                $data['state']      =   'failed';
                $data['message']    =   'This number is already saved';
            }

            echo json_encode($data);
        }
    }

    public function delete(){

    }

    public function update(){

    }

}