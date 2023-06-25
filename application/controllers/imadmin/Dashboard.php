<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Sampah_model', 'Scrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Setor_model', 'Stcrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Dashboard',
            'admin' => $this->Ucrud->getUserById($id),
            'jumNSB' => $this->Ncrud->getJumlahRow(),
            'jumSMP' => $this->Scrud->getJumlahRow(),
            'jumBerat' => $this->Stcrud->getJumlahBeratSetorNoWhere(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/dashboard/index');
        $this->load->view('temp/templates/footer');
    }
}
