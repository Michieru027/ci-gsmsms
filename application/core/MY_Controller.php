<?php

/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 20/09/2018
 * Time: 10:26 AM
 */
class MY_Controller extends MX_Controller{

    public $css;
    public $js;
    public $img;
    public $class;
    public $method;

    public $logged;
    public $username;
    public $id;

    public function __construct(){
        parent::__construct();
        $this->load->model('Common_model');
        $this->css          =   $this->template->Css();
        $this->js           =   $this->template->Js();
        $this->img          =   $this->template->Images();
        $this->class        =   $this->router->class;
        $this->method       =   $this->router->method;
        $this->logged       =   ($this->session->userdata('logged') ? $this->session->userdata('logged') : false);
        $this->username     =   ($this->session->userdata('username') ? $this->session->userdata('username') : '');
        $this->id           =   ($this->session->userdata('user_id') ? $this->session->userdata('user_id') : '');
    }

    public function TemplateVars(){
        $data['class']          =   $this->class;
        $data['method']         =   $this->method;
        $data['logged']         =   $this->logged;
        $data['username']       =   $this->username;
        $data['img']            =   $this->img;
        return $data;
    }
}