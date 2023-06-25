<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Penukaran extends CI_Controller
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
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');
        $getP = $this->Pcrud->getPenukaranByOrderWhere($idn, 'asc');


        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);


        if (empty($startdate) or empty($enddate)) {
            $data['penukarans'] = $getP;
            $label = 'Semua Data Riwayat Penukaran';
        } else {

            $data['penukarans'] = $this->Pcrud->getPenukaransByDateRange($idn, 'asc', $startdate, $enddate);

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
        }

        $data = [
            'title' => 'Riwayat Penukaran Poin',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'label' => $label,
            'penukarans' => $data['penukarans']
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/laporan/laporan-penukaran/index');
        $this->load->view('temp/templates/footer');
    }
}
