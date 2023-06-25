<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page_404 extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        $this->load->model('Config_model', 'Ccrud');
        // $this->load->model('Sekolah_model');
    }
    public function index()
    {
        $data = [
            'title' => 'Not Found !',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'id' => $this->session->userdata('hak'),
            'countdown' => 5
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('errors/html/error_404');
    }
}
