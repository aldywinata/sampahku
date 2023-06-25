<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setor extends CI_Controller
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

        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Sampah_model', 'Scrud');
        $this->load->model('Setor_model', 'Stcrud');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'title' => 'Setor Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'setors' => $this->Stcrud->getAllData(),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/setor/index');
        $this->load->view('temp/templates/footer');
    }
    public function vadd()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'title' => 'Tambah Setor Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'nasabahs' => $this->Ncrud->getNasabah(),
            'sampahs' => $this->Scrud->getAllData(),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/setor/add_form');
        $this->load->view('temp/templates/footer');
    }
    public function vedit($ids)
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'title' => 'Edit Setor Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'setor' => $this->Stcrud->getSetorByValue('id_setor', $ids)->row_array(),
            'nasabahs' => $this->Ncrud->getNasabah(),
            'sampahs' => $this->Scrud->getAllData(),
            'stats' => ['0', '1', '2'],
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/setor/edit_form');
        $this->load->view('temp/templates/footer');
    }
    public function get_nasabah_detail()
    {
        $idNasabah = $this->input->post('id_nasabah'); // Mengambil data id nasabah dari permintaan AJAX

        // Melakukan query ke database untuk mendapatkan detail nasabah berdasarkan id
        $nasabahDetail = $this->db->get_where('tbl_nasabah', array('id_nasabah' => $idNasabah))->row_array();

        // Mengirim data detail nasabah dalam format JSON ke sisi client
        echo json_encode($nasabahDetail);
    }
    public function get_sampah_detail()
    {
        $idSampah = $this->input->post('id_sampah'); // Mengambil data id nasabah dari permintaan AJAX

        // Melakukan query ke database untuk mendapatkan detail nasabah berdasarkan id
        $sampahDetail = $this->db->get_where('tbl_sampah', array('id_sampah' => $idSampah))->row_array();

        // Mengirim data detail sampah dalam format JSON ke sisi client
        echo json_encode($sampahDetail);
    }
    public function add()
    {
        if (isset($_POST['btnAdd'])) {
            $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('jenis', 'Jenis ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('berat', 'Berat ', 'required', array('required' => '%s tidak boleh kosong'));

            if ($this->form_validation->run() == FALSE) {
                $this->vadd();
            } else {
                $input = $this->input;
                $get = $this->Ucrud->cekUser('id_users', $this->session->userdata('id_users'));
                $getS = $this->Scrud->cekSampah('id_sampah', $input->POST('jenis', true));

                $data = [
                    'id_setor' => $this->glo->generateIDsetor(),
                    'id_nasabah' => $input->POST('nama', true),
                    'nama_sampah_setor' => $getS['nama_sampah'],
                    'poin_sampah_setor' => $input->POST('poin', true),
                    'berat_setor' => strval($input->POST('berat', true)),
                    'poin_total' => $input->POST('total', true),
                    'date_setor' => time(),
                    'status_setor' => 1,
                    'petugas' => strtolower($get['nama_users'])
                ];

                $cek = $this->Stcrud->addSetor($data);
                if ($cek) {
                    //ambil data nasabah berdasarkan id (select Option)
                    $getN = $this->Ncrud->getNasabahByValue('id_nasabah', $input->POST('nama', true));

                    //ambil nilai poin nasabah
                    $poinN = $getN['poin_nasabah'];

                    //jumlahkn poin nasabah dngan total poin
                    $hasil = $poinN + $input->POST('total', true);

                    //update hasil jumlah poin ke poin_nasabah
                    $data = [
                        'poin_nasabah' => $hasil
                    ];

                    $this->Ncrud->updateNasabah('id_nasabah', $input->POST('nama', true), $data);

                    $this->MSG->notifSweets('success', 'Success', 'Setor Sampah Berhasil');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Setor Sampah Gagal !');
                }
                redirect('imadmin/setor');
            }
        } elseif (isset($_POST['btnBack'])) {
            redirect('imadmin/setor');
        }
    }
    public function update()
    {
        if (isset($_POST['btnAdd'])) {
            $this->form_validation->set_rules('stat', 'Status ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('berat', 'Berat ', 'required', array('required' => '%s tidak boleh kosong'));

            if ($this->form_validation->run() == FALSE) {
                $this->vadd();
            } else {
                $input = $this->input;
                $ids = $input->POST('ids', true);

                $get = $this->Ucrud->cekUser('id_users', $this->session->userdata('id_users')); //ambil data petugas
                $getSt = $this->Stcrud->getSetorByValue('id_setor', $ids)->row_array(); //ambil data setor
                $getN = $this->Ncrud->getNasabahByValue('id_nasabah', $getSt['id_nasabah']); //ambil data nasabah

                $hasil = $getN['poin_nasabah'] - $getSt['poin_total'];

                $dataUpPoin = [
                    'poin_nasabah' => $hasil
                ];

                $this->Ncrud->updateNasabah('id_nasabah', $get['id_nasabah'], $dataUpPoin);

                $data = [
                    'berat_setor' => $input->POST('berat', true),
                    'poin_total' => strval($input->POST('total', true)),
                    'status_setor' => $input->POST('stat', true),
                    'petugas' => strtolower($get['nama_users'])
                ];

                $cek = $this->Stcrud->updateSetor('id_setor', $ids, $data);
                if ($cek) {
                    //ambil data nasabah berdasarkan id (select Option)


                    //jumlahkn poin nasabah dngan total poin
                    $hasil = $hasil + strval($input->POST('total', true));

                    //update hasil jumlah poin ke poin_nasabah
                    $data = [
                        'poin_nasabah' => $hasil
                    ];

                    $this->Ncrud->updateNasabah('id_nasabah', $getSt['id_nasabah'], $data);

                    $this->MSG->notifSweets('success', 'Success', 'Setor Sampah Berhasil diperbaharui');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Setor Sampah Gagal diperbaharui !');
                }
                redirect('imadmin/setor');
            }
        } elseif (isset($_POST['btnBack'])) {
            redirect('imadmin/setor');
        }
    }
    public function delete($id)
    {
        $get = $this->Stcrud->getSetorByValue('id_setor', $id)->row_array();
        $getN = $this->Ncrud->getNasabahByValue('id_nasabah', $get['id_nasabah']);

        $hasil = $getN['poin_nasabah'] - $get['poin_total'];

        $data = [
            'poin_nasabah' => $hasil
        ];

        $this->Ncrud->updateNasabah('id_nasabah', $get['id_nasabah'], $data);

        $cek = $this->Stcrud->deleteSetor($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/setor');
    }
}
