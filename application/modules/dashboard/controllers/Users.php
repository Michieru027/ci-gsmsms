<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 20/09/2018
 * Time: 4:28 PM
 */
class Users extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        System::clear_notification('user');
        System::clear_notification('user_del');
        $data['page_title'] =   'List of all users';
        $data['user_data']  =   $this->get_users();
        $data['js']         =   'dashboard/users.js';
        $this->template->title("GSM SMS Users")
            ->set_layout('dashboard/layout')
            ->build('users', $data);
    }

    public function get_users(){
        $fetch_users    =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_users');
        $table_html     =   '';
        $count_users    =   0;
        $permission     =   System::get_permission($this->id);

        if($fetch_users){
            foreach($fetch_users as $users){
                $table_html .=  '<tr>';
                $table_html .=  '    <td>'.$users['Id'].'</td>';
                $table_html .=  '    <td>'.$users['username'].'</td>';
                $table_html .=  '    <td>'.$users['first_name'].'</td>';
                $table_html .=  '    <td>'.$users['last_name'].'</td>';
                $table_html .=  '    <td>'.($users['email'] == '' ? 'N/A' : $users['email']).'</td>';
                $table_html .=  '    <td>'.NS::get_level_string($users['level']).'</td>';

                if($this->username == 'admin'){
                    if($users['username'] != 'admin'){
                        switch($permission){
                            case    'all':
                                $table_html .=  '    <td class="text-center"><a href="javascript:void(0)" class="gsm_edit_user" id="edit-'.$users['Id'].'" title="Edit user"><i class="fa fa-edit"></i></a></td>';
                                $table_html .=  '    <td class="text-center"><a href="javascript:void(0)" class="gsm_delete_user" data-toggle="modal" data-target="#modal_del_user" id="delete-'.$users['Id'].'" title="Delete user"><i class="fa fa-trash"></i></a></td>';
                                break;
                            case    'read & edit':
                                $table_html .=  '    <td class="text-center"><a href="javascript:void(0)" class="gsm_edit_user" id="edit-'.$users['Id'].'" title="Edit user"><i class="fa fa-edit"></i></a></td>';
                                $table_html .=  '    <td class="text-center">Not Allowed</a></td>';
                                break;
                            case    'view only':
                                $table_html .=  '    <td class="text-center">Not Allowed</td>';
                                $table_html .=  '    <td class="text-center">Not Allowed</a></td>';
                                break;
                        }
                    }
                }

                $table_html .=  '</tr>';
                $count_users++;
            }
        }

        $data['table_html'] =   $table_html;
        $data['total_data'] =   $count_users;
        return $data;
    }

    public function add(){
        if($_POST){
            $this->form_validation->set_rules('gsm_sms_username', 'Username', 'required');
            $this->form_validation->set_rules('gsm_sms_password', 'Password', 'required');
            $this->form_validation->set_rules('gsm_sms_cpassword', 'Password Confirmation', 'required|matches[gsm_sms_password]');
            $this->form_validation->set_rules('gsm_sms_firstname', 'First Name', 'required');
            $this->form_validation->set_rules('gsm_sms_lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('gsm_sms_email', 'Last Name', 'required|valid_email');
            $this->form_validation->set_rules('gsm_sms_level', 'User level', 'required');

            $username   =   $_POST['gsm_sms_username'];
            $cpassword  =   $_POST['gsm_sms_cpassword'];
            $fname      =   $_POST['gsm_sms_firstname'];
            $lname      =   $_POST['gsm_sms_lastname'];
            $email      =   $_POST['gsm_sms_email'];
            $date       =   date('Y-m-d H:i:s');
            $level      =   $_POST['gsm_sms_level'];

            if($this->form_validation->run($this)){
                $fetch_users    =   $this->Common_model->GetDataFromSingleTable('*', 'gsm_sms_users', array('username' => $username));
                if(!$fetch_users){
                    $data_insert['username']    =   $username;
                    $data_insert['password']    =   md5($cpassword);
                    $data_insert['first_name']  =   $fname;
                    $data_insert['last_name']   =   $lname;
                    $data_insert['email']       =   $email;
                    $data_insert['date_added']  =   $date;
                    $data_insert['level']       =   $level;

                    $new_user   =   $this->Common_model->InsertDataToSingleTable('gsm_sms_users', $data_insert);
                    $type       =   'user';
                    System::create_notification($type, $new_user);

                    $this->session->set_flashdata('validation_success', 'A new user has been successfully added');
                    redirect(base_url().'dashboard/users');

                }else{
                    $this->session->set_flashdata('modal', 'modal_add_user');
                    $this->session->set_flashdata('validation_errors', 'Username is already used');
                }
            }else{
                $this->session->set_flashdata('modal', 'modal_add_user');
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url().'dashboard/users');
            }
        }
    }

    public function delete($user_id){
        if($user_id){
            $fetch_user =   $this->Common_model->GetSingleDataFromSingleTable('*', 'gsm_sms_users', array('Id' => $user_id));

            if($fetch_user){
                $data_where['Id']   =   $user_id;
                $this->Common_model->DeleteDataFromSingleTable('gsm_sms_users', $data_where);
                System::create_notification('user_del', $user_id);
                $this->session->set_flashdata('validation_success', 'User successfully removed');
            }else{
                $this->session->set_flashdata('validation_errors', 'User no longer existed');
            }

            redirect(base_url().'dashboard/users');
        }
    }

    public function create_notification($type, $date, $key){
        $notif_insert['notification_type']      =   $type;
        $notif_insert['notification_date']      =   $date;
        $notif_insert['notification_key']       =   $key;
        $notif_insert['notification_status']    =   0;

        $this->Common_model->InsertDataToSingleTable('gsm_sms_notifications', $notif_insert);
    }

    public function get_user_data(){

    }

}