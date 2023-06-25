<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $this->load->model('Kategori_model', 'kat');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        if ($this->session->userdata('id_users') == '1') {

            $id = $this->session->userdata('id_users');

            $data = [
                'title' => 'Kategori Sampah',
                'admin' => $this->Ucrud->getUserById($id),
                'kategoris' => $this->kat->getKategori(),
                'info' => $this->Ccrud->getSysfoByValue('1'),
                'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
            ];

            $this->load->view('temp/templates/header', $data);
            $this->load->view('temp/templates/topbar');
            $this->load->view('temp/templates/sidebar');
            $this->load->view('temp/be/kategori/index');
            $this->load->view('temp/templates/footer');
        } else {
            redirect('imadmin/dashboard');
        }
    }
    public function add()
    {
        if ($this->session->userdata('id_users') == '1') { //cek validasi role
            $kode = $this->input->POST('kode', true);
            $cek = $this->kat->cekKategori('kode_sampah_kat', $kode);

            if ($kode != $cek['kode_sampah_kat']) { //cek kode sampah
                $kategori = strtolower($this->input->POST('kategori', true));

                $data = [
                    'kode_sampah_kat' => $kode,
                    'nama_sampah_kat' => $kategori,
                    'status_sampah_kat' => 1
                ];

                $cekAdd = $this->kat->addKategori($data);
                if ($cekAdd) {
                    $this->MSG->notifSweets('success', 'Success', 'Data Berhasil ditambah');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal ditambah !');
                }
                redirect('imadmin/kategori');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Kode Kategori sudah digunakan !');
            }
            redirect('imadmin/kategori');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
        }
        redirect('imadmin/dashboard');
    }
    public function update()
    {
        if ($this->session->userdata('id_users') == '1') {
            $kode = $this->input->post('kode');
            $kategori = strtolower($this->input->POST('kategori', true));

            $data = [
                'nama_sampah_kat' => $kategori
            ];

            $cek = $this->kat->updateKatByClause('kode_sampah_kat', $kode, $data);

            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diubah');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diubah !');
            }
            redirect('imadmin/kategori');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
            redirect('imadmin/dashboard');
        }
    }

    public function updateStatus()
    {
        if ($this->session->userdata('id_users') == '1') {
            $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
            $cek = $this->kat->cekKategori('id_sampah_kat', $id);

            if ($cek['status_sampah_kat'] == '1') {
                $data['status_sampah_kat'] = '0'; // Menggunakan string '0' untuk status tidak aktif
                $results = '0'; // Set results to '0' for inactive status
            } else {
                $data['status_sampah_kat'] = '1'; // Menggunakan string '1' untuk status aktif
                $results = '1'; // Set results to '1' for active status
            }

            $this->kat->updateKategori($id, $data);

            echo $results;
            exit; // Send the results back as the response
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
        }
        redirect('imadmin/kategori');
    }


    public function delete($id)
    {
        if ($this->session->userdata('id_users') == '1') {
            $cek = $this->kat->deleteKategori($id);

            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
            }
            redirect('imadmin/kategori');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
        }
        redirect('imadmin/dashboard');
    }
}
