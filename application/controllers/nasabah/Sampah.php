<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sampah extends CI_Controller
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
        $this->load->model('Sampah_model', 'Scrud');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');

        $data = [
            'title' => 'Sampah',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'sampahs' => $this->Scrud->getAllData()
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/sampah/index');
        $this->load->view('temp/templates/footer');
    }
}
