<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_users')) {
            echo "<script>
                alert('Harap Login Terlebih Dahulu !');
                window.location.href ='../auth';
            </script>";
        }

        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Dokumentasi',
            'admin' => $this->Ucrud->getUserById($id),
            'info' => $this->Ccrud->getSysfoByValue('1'),
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/dokumentasi/index');
        $this->load->view('temp/templates/footer');
    }
}
