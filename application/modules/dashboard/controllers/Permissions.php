<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 24/09/2018
 * Time: 1:26 PM
 */
class Permissions extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->logged){
            redirect(base_url());
        }
    }

    public function index(){
        $data['page_title'] =   'List of Permissions';
        $this->template->title("GSM SMS Permissions")
            ->set_layout('dashboard/layout')
            ->build('permissions', $data);
    }

}