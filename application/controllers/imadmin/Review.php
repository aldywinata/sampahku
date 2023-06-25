<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review extends CI_Controller
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
        $this->load->model('Ulasan_model', 'Ulcrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title'     => 'Review Nasabah',
            'admin'     => $this->Ucrud->getUserById($id),
            'reviews'   => $this->Ulcrud->getAllData(),
            'jumStat'   => $this->Ulcrud->getJumlahBy('status_review', '0'),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/review/index');
        $this->load->view('temp/templates/footer');
    }
    public function updateStatus()
    {
        $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
        $cek = $this->Ulcrud->getUlasanByValue('id_review', $id);

        if ($cek['status_review'] == '1') {
            $data['status_review'] = '0'; // Menggunakan string '0' untuk status tidak aktif
            $results = '0'; // Set results to '0' for inactive status
        } else {
            $data['status_review'] = '1'; // Menggunakan string '1' untuk status aktif
            $results = '1'; // Set results to '1' for active status
        }

        $this->Ulcrud->updateUlasanWhere('id_review', $id, $data);

        echo $results;
        exit; // Send the results back as the response

        // redirect('imadmin/kategori');
    }
}
