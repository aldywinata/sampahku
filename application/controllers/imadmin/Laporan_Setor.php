<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Setor extends CI_Controller
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
        $this->load->model('Setor_model', 'Stcrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');
        $getS = $this->Stcrud->getAllDataByOrder('asc');


        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);


        if (empty($startdate) or empty($enddate)) {
            $data['setors'] = $getS;
            $label = 'Semua Data Laporan Setor Sampah';
            $url_print = 'imadmin/laporan_setor/print';
        } else {

            $data['setors'] = $this->Stcrud->getSetorsByDateRangeNoWhere('asc', $startdate, $enddate);

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
            $url_print = 'imadmin/laporan_setor/print?startdate=' . $startdate . '&enddate=' . $enddate;
        }

        $data = [
            'title' => 'Laporan Setor Sampah',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'admin' => $this->Ucrud->getUserById($id),
            'label' => $label,
            'setors' => $data['setors'],
            'url_print' => base_url($url_print),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/laporan/laporan-setor/index');
        $this->load->view('temp/templates/footer');
    }
    public function print()
    {
        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);

        if (empty($startdate) or empty($enddate)) {
            $data['setors'] = $this->Stcrud->getAllDataByOrder('asc');
            $label = 'Semua Data Laporan Setor Sampah';
        } else {
            $data['setors'] = $this->Stcrud->getSetorsByDateRangeNoWhere('asc', $startdate, $enddate);

            $tglAwal  = date('d-m-Y', strtotime($startdate));
            $tglakhir = date('d-m-Y', strtotime($enddate));
            $label    = 'Periode Tanggal ' . $tglAwal . ' s/d ' . $tglakhir;
        }

        $data['label'] = $label;

        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Setor Sampah';

        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Setor Sampah';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";

        $html = $this->load->view('temp/be/laporan/PrintLaporan', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
