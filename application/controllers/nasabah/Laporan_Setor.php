<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Setor extends CI_Controller
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
        $this->load->model('Setor_model', 'Stcrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');
        $getS = $this->Stcrud->getAllDataByOrderWhere($idn, 'asc');


        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);


        if (empty($startdate) or empty($enddate)) {
            $data['setors'] = $getS;
            $label = 'Semua Data Riwayat Setor';
        } else {

            $startdateTime = $startdate;
            $enddateTime = $enddate;

            // $startdateTime = strtotime('2023-06-01'); // Konversi tanggal ke detik
            // $enddateTime = strtotime('2023-06-31'); // Konversi tanggal ke detik

            $data['setors'] = $this->Stcrud->getSetorsByDateRange($idn, 'asc', $startdateTime, $enddateTime);

            // var_dump($data['setors']);
            // die;

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
        }

        $data = [
            'title' => 'Riwayat Setor Sampah',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'label' => $label,
            'setors' => $data['setors']
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/laporan/laporan-setor/index');
        $this->load->view('temp/templates/footer');
    }
}
