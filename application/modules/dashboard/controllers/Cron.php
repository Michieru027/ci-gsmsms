<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 17/10/2018
 * Time: 10:25 AM
 */
class Cron extends MY_Controller
{
    public function __construct()
    {
        modules::load('Dashboard');
        parent::__construct();
    }

    public function process_api_sms(){
        $Dashboard  =   new Dashboard();
        $Dashboard->process_api_sms();
    }

}