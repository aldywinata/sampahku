<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_nsb')) {
            echo "<script>
                alert('Harap Login Terlebih Dahulu !');
                window.location.href ='../auth';
            </script>";
        }

        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Hadiah_model', 'Hcrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Setor_model', 'Stcrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');

        $data = [
            'title' => 'Dashboard',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'rewards' => $this->Hcrud->getHadiah(),
            'setors' => $this->Stcrud->getSetorNoJoinByVal('id_nasabah', $idn)->result_array(),
            'setorss' => $this->Stcrud->getAllData(),
            'jumBerat' => $this->Stcrud->getJumlahBeratSetor($idn),
            'penukaras' => $this->Pcrud->getPenukaranNoJoinByVal('id_nasabah', $idn)->result_array(),
            'penukarass' => $this->Pcrud->getAllData(),
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/dashboard/index');
        $this->load->view('temp/templates/footer');
    }
}
