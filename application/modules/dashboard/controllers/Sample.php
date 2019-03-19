<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 16/10/2018
 * Time: 11:20 AM
 */
class Sample extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data['react_js']   =   'dashboard/sms.jsx';
        $this->template->title('Sample React')
            ->set_layout('dashboard/layout')
            ->build('sample', $data);
    }

}