<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Penukaran extends CI_Controller
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
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');
        $getS = $this->Pcrud->getPenukaranByOrder('asc');


        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);


        if (empty($startdate) or empty($enddate)) {
            $data['penukarans'] = $getS;
            $label = 'Semua Data Laporan Penukaran Poin';
            $url_print = 'imadmin/laporan_penukaran/print';
        } else {

            $data['penukarans'] = $this->Pcrud->getPenukaranByDateRangeNoWhere('asc', $startdate, $enddate);

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
            $url_print = 'imadmin/laporan_penukaran/print?startdate=' . $startdate . '&enddate=' . $enddate;
        }

        $data = [
            'title' => 'Laporan Penukaran Poin',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'admin' => $this->Ucrud->getUserById($id),
            'label' => $label,
            'penukarans' => $data['penukarans'],
            'url_print' => base_url($url_print),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/laporan/laporan-penukaran/index');
        $this->load->view('temp/templates/footer');
    }
    public function print()
    {
        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);

        if (empty($startdate) or empty($enddate)) {
            $data['penukarans'] = $this->Pcrud->getPenukaranByOrder('asc');
            $label = 'Semua Data Laporan Penukaran Poin';
        } else {
            $data['penukarans'] = $this->Pcrud->getPenukaranByDateRangeNoWhere('asc', $startdate, $enddate);

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Periode Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
        }

        $data['label'] = $label;

        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Penukaran Poin';

        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Penukaran Poin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('temp/be/laporan/laporan-penukaran/PrintLaporan', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
