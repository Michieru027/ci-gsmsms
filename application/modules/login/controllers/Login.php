<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if($this->logged){
            redirect(base_url().'dashboard');
        }
        $this->template->title("O Shopping GSM Login")
            ->set_layout('default/layout')
            ->build('login');
	}

	public function submit(){
	    if($_POST){
            $this->form_validation->set_rules('gsm_username', 'Username', 'required');
            $this->form_validation->set_rules('gsm_password', 'Password', 'required');

            if($this->form_validation->run($this)){
                $username       =   $_POST['gsm_username'];
                $password       =   $_POST['gsm_password'];

                $array_filter   =  array('username' => $username, 'password' => md5($password));

                $fetched_data   =   $this->Common_model->GetSingleDataFromSingleTable('*', 'gsm_sms_users', $array_filter);
                if($fetched_data){
                    $data['user_id']    =   $fetched_data['Id'];
                    $data['username']   =   $fetched_data['username'];
                    $data['email']      =   $fetched_data['email'];
                    $data['fullname']   =   $fetched_data['first_name'].' '.$fetched_data['last_name'];
                    $data['level']      =   NS::get_level_string($fetched_data['level']);
                    $data['logged']     =   true;

                    $this->session->set_userdata($data);
                    redirect(base_url().'dashboard');
                }else{
                    $this->session->set_flashdata('validation_error', 'Username and/or password is incorrect');
                    redirect(base_url());
                }
            }else{
                $this->session->set_flashdata('validation_error', validation_errors());
                redirect(base_urL());
            }
        }else{
            redirect(base_url());
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
