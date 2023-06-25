<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penukaran extends CI_Controller
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
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Hadiah_model', 'Hcrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'title' => 'Penukaran Poin',
            'admin' => $this->Ucrud->getUserById($id),
            'penukarans' => $this->Pcrud->getPenukaranByOrder('asc'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];


        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/penukaran/index');
        $this->load->view('temp/templates/footer');
    }
    public function updateStatus($id)
    {
        $get = $this->Pcrud->getPenukaranByValue('id_penukaran', $id)->row_array();

        $status = $this->input->post('status');

        if ($status == 'failed') {
            //add stok reward 1
            $getH = $this->Hcrud->getHadiahByValue('kode_reward', $get['kode']);

            $addStok = $getH['stok_reward'] + 1;

            $data = [
                'stok_reward' => $addStok
            ];

            $this->Hcrud->updateHadiah($getH['kode_reward'], $data);
            //end add stok reward
            $hasil = $get['poin_nasabah'] + $get['poin_penukaran'];

            $data = [
                'poin_nasabah' => $hasil
            ];

            $this->Ncrud->updateNasabah('id_nasabah', $get['id_nasabah'], $data);
        }

        $data = [
            'status_penukaran' => $status
        ];

        $result = $this->Pcrud->updatePenukaran($id, $data);

        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Penukaran berhasil diproses'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Penukaran gagal diproses'
            ];
        }

        echo json_encode($response);
    }
    public function delete($id)
    {
        $getP = $this->Pcrud->getPenukaranByValue('id_penukaran', $id)->row_array();
        $getN = $this->Ncrud->getNasabahByValue('id_nasabah', $getP['id_nasabah']);


        $hasil = $getN['poin_nasabah'] + $getP['poin_penukaran'];

        $data = [
            'poin_nasabah' => $hasil
        ];

        $this->Ncrud->updateNasabah('id_nasabah', $getP['id_nasabah'], $data);

        $cek = $this->Pcrud->deletePenukaran($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/penukaran');
    }
}
