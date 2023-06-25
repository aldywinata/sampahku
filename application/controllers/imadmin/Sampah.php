<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sampah extends CI_Controller
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
        $this->load->model('Sampah_model', 'Scrud');
        $this->load->model('Kategori_model', 'kat');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Kategori_model', 'kat');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'sampahs' => $this->Scrud->getAllData(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/sampah/index');
        $this->load->view('temp/templates/footer');
    }
    public function vadd()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Tambah Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'sampahs' => $this->Scrud->getAllData(),
            'sampah_kats' => $this->kat->getKategori(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/sampah/add_form');
        $this->load->view('temp/templates/footer');
    }
    public function add()
    {
        if (empty($_FILES['foto']['name'])) {
            $this->form_validation->set_rules('foto', 'Foto ', 'required', array('required' => '%s tidak boleh kosong'));
        }
        $this->form_validation->set_rules('kode', 'Kode ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('satuan', 'Satuan ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('poin', 'Poin ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('desk', 'Deskripsi ', 'required', array('required' => '%s tidak boleh kosong'));

        if ($this->form_validation->run() == FALSE) {
            $this->vadd();
        } else {
            $input = $this->input;

            //Config untuk uploadFile
            $upload_dir = './assets/imgs/be/img-sampah/';
            $allowed_types = 'gif|jpg|png|jpeg';
            $max_size = 2048;

            $data = [
                'img_sampah' => $this->glo->uploadFile('foto', 'Sampah', '', $upload_dir, $allowed_types, $max_size),
                'id_sampah_kat' => $input->POST('kode', true),
                'nama_sampah' => strtolower($input->POST('nama', true)),
                'satuan_sampah' => strtolower($input->POST('satuan', true)),
                'poin_sampah' => str_replace(',', '', $input->POST('poin', true)),
                'deskripsi_sampah' => $input->POST('desk', true),
                'status_sampah' => '1',
            ];

            $cek = $this->Scrud->addSampah($data);
            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Data Berhasil ditambah');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal ditambah !');
            }

            redirect('imadmin/sampah');
        }
    }
    public function vedit($ids)
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Edit Sampah',
            'admin' => $this->Ucrud->getUserById($id),
            'sampahs' => $this->Scrud->getAllData(),
            'row' => $this->Scrud->getSampah('id_sampah', $ids),
            'sampah_kats' => $this->kat->getKategori(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/sampah/edit_form');
        $this->load->view('temp/templates/footer');
    }
    public function edit()
    {
        // if (empty($_FILES['foto']['name'])) {
        //     $this->form_validation->set_rules('foto', 'Foto ', 'required', array('required' => '%s tidak boleh kosong'));
        // }
        $this->form_validation->set_rules('kode', 'Kode ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('satuan', 'Satuan ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('poin', 'Poin ', 'required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('desk', 'Deskripsi ', 'required', array('required' => '%s tidak boleh kosong'));

        if ($this->form_validation->run() == FALSE) {
            $ids = $this->input->POST('ids', true);
            $this->vedit($ids);
        } else {
            $input = $this->input;
            $ids = $input->POST('ids', true);
            $img_old = $input->POST('img_old');

            //Config untuk uploadFile
            $upload_dir = './assets/imgs/be/img-sampah/';
            $allowed_types = 'gif|jpg|png|jpeg';
            $max_size = 2048;

            $data = [
                'img_sampah' => $this->glo->uploadFile('foto', 'Sampah', $img_old, $upload_dir, $allowed_types, $max_size),
                'id_sampah_kat' => $input->POST('kode', true),
                'nama_sampah' => strtolower($input->POST('nama', true)),
                'satuan_sampah' => strtolower($input->POST('satuan', true)),
                'poin_sampah' => str_replace(',', '', $input->POST('poin', true)),
                'deskripsi_sampah' => $input->POST('desk', true),
            ];

            $cek = $this->Scrud->updateSampah($ids, $data);
            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diupdate');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diupdate !');
            }

            redirect('imadmin/sampah');
        }
    }
    public function updateStatus()
    {
        if ($this->session->userdata('id_users') == '1') {
            $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
            $cek = $this->Scrud->cekSampah('id_sampah', $id);

            if ($cek['status_sampah'] == '1') {
                $data['status_sampah'] = '0'; // Menggunakan string '0' untuk status tidak aktif
                $results = '0'; // Set results to '0' for inactive status
            } else {
                $data['status_sampah'] = '1'; // Menggunakan string '1' untuk status aktif
                $results = '1'; // Set results to '1' for active status
            }

            $this->Scrud->updateSampah($id, $data);

            echo $results;
            exit; // Send the results back as the response
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
        }
        redirect('imadmin/sampah');
    }
    public function delete($id)
    {
        $data = $this->Scrud->cekSampah('id_sampah', $id); //ambil data berdasarkan id
        $upload_dir = './assets/imgs/be/img-sampah/'; //lokasi img sampah
        $this->glo->deleteIMG($data['img_sampah'], $upload_dir); //hapus foto berdasarkan id

        $cek = $this->Scrud->deleteSampah($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/sampah');
    }
}
