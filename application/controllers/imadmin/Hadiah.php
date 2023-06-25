<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hadiah extends CI_Controller
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
        $this->load->model('Hadiah_model', 'Hcrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title'     => 'Hadiah',
            'admin'     => $this->Ucrud->getUserById($id),
            'rewards'   => $this->Hcrud->getHadiah(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/hadiah/index');
        $this->load->view('temp/templates/footer');
    }
    public function vadd()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Tambah Hadiah',
            'admin' => $this->Ucrud->getUserById($id),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/hadiah/add_form');
        $this->load->view('temp/templates/footer');
    }
    public function vedit($kd)
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title'     => 'Edit Hadiah',
            'admin'     => $this->Ucrud->getUserById($id),
            'row'       => $this->Hcrud->getHadiahByValue('kode_reward', $kd),
            'jeniss'    => ['voucher', 'tukar_barang'],
            'ons'       => ['0', '1'],
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/hadiah/edit_form');
        $this->load->view('temp/templates/footer');
    }
    public function add()
    {
        if (isset($_POST['btnAdd'])) {
            if (empty($_FILES['foto']['name'])) {
                $this->form_validation->set_rules('foto', 'Foto ', 'required', array('required' => '%s tidak boleh kosong'));
            }
            $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('jenis', 'Jenis ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('poin', 'Poin ', 'required', array('required' => '%s tidak boleh kosong'));
            // $this->form_validation->set_rules('stok', 'Stok ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('nominal', 'Nominal ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('on_thumb', 'Form', 'required', array('required' => '%s tidak boleh kosong'));

            if ($this->form_validation->run() == FALSE) {
                $this->vadd();
            } else {
                $input = $this->input; //menyingkat $this->input->POST() menjadi $input->POST()

                // Mengambil value Jenis
                $jenis = $input->POST('jenis', true);
                if ($jenis == 'tukar_barang') { // Generate Kode berdasarkan jenis
                    $kode = $this->glo->generateKode('TKR');
                    $stok = $input->POST('stok', true);
                } elseif ($jenis == 'voucher') {
                    $kode = $this->glo->generateKode('VOU');
                    $stok = 0;
                }

                //Config untuk uploadFile
                $upload_dir = './assets/imgs/be/img-reward/';
                $allowed_types = 'gif|jpg|png|jpeg';
                $max_size = 2048;

                $data = [
                    'kode_reward'   => $kode,
                    'nama_reward'   => strtolower($input->POST('nama', true)),
                    'poin_reward'   => str_replace(',', '', $input->POST('poin', true)),
                    'nominal_reward'   => str_replace(',', '', $input->POST('nominal', true)),
                    'jenis_reward'  => strtolower($input->POST('jenis', true)),
                    'status_reward' => '1',
                    'stok_reward'   => $stok,
                    'on_thumbnail'  => $input->POST('on_thumb', true),
                    'img_reward'    => $this->glo->uploadFile('foto', 'Reward', '', $upload_dir, $allowed_types, $max_size)
                ];

                $cek = $this->Hcrud->addHadiah($data);
                if ($cek) {
                    $this->MSG->notifSweets('success', 'Success', 'Data Berhasil ditambah');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal ditambah !');
                }
                redirect('imadmin/hadiah');
            }
        } elseif (isset($_POST['btnBack'])) {
            redirect('imadmin/hadiah');
        }
    }
    public function edit()
    {
        if (isset($_POST['btnAdd'])) {
            // if (empty($_FILES['foto']['name'])) {
            //     $this->form_validation->set_rules('foto', 'Foto ', 'required', array('required' => '%s tidak boleh kosong'));
            // }
            $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('jenis', 'Jenis ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('poin', 'Poin ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('stok', 'Stok ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('nominal', 'Nominal ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('on_thumb', 'Form', 'required', array('required' => '%s tidak boleh kosong'));

            if ($this->form_validation->run() == FALSE) {
                $kd = $this->input->POST('kd', true);
                $this->vedit($kd);
            } else {
                $input = $this->input; //menyingkat $this->input->POST() menjadi $input->POST()
                $kd = $input->POST('kd', true);
                $img_old = $input->POST('img_old');

                //validasi stok
                if ($input->POST('jenis') == 'voucher') {
                    $stok = 0;
                } else {
                    $stok = $input->POST('stok', true);
                }

                //Config untuk uploadFile
                $upload_dir = './assets/imgs/be/img-reward/';
                $allowed_types = 'gif|jpg|png|jpeg';
                $max_size = 2048;

                $data = [
                    'nama_reward'       => strtolower($input->POST('nama', true)),
                    'poin_reward'       => str_replace(',', '', $input->POST('poin', true)),
                    'jenis_reward'      => strtolower($input->POST('jenis', true)),
                    'stok_reward'       => $stok,
                    'nominal_reward'    => str_replace(',', '', $input->POST('nominal', true)),
                    'on_thumbnail'      => $input->POST('on_thumb', true),
                    'img_reward'        => $this->glo->uploadFile('foto', 'Reward', $img_old, $upload_dir, $allowed_types, $max_size)
                ];

                $cek = $this->Hcrud->updateHadiah($kd, $data);
                if ($cek) {
                    $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diupdate');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diupdate !');
                }
                redirect('imadmin/hadiah');
            }
        } elseif (isset($_POST['btnBack'])) {
            redirect('imadmin/hadiah');
        }
    }
    public function updateStatus()
    {
        $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
        $cek = $this->Hcrud->getHadiahByValue('kode_reward', $id);

        if ($cek['status_reward'] == '1') {
            $data['status_reward'] = '0'; // Menggunakan string '0' untuk status tidak aktif
            $results = '0'; // Set results to '0' for inactive status
        } else {
            $data['status_reward'] = '1'; // Menggunakan string '1' untuk status aktif
            $results = '1'; // Set results to '1' for active status
        }

        $this->Hcrud->updateHadiah($id, $data);

        echo $results;
        exit; // Send the results back as the response

        // redirect('imadmin/kategori');
    }
    public function delete($kd)
    {
        $data = $this->Hcrud->getHadiahByValue('kode_reward', $kd); //ambil data berdasarkan kd
        $upload_dir = './assets/imgs/be/img-reward/'; //lokasi img sampah
        $this->glo->deleteIMG($data['img_reward'], $upload_dir); //hapus foto berdasarkan kd yang telah diambil

        $cek = $this->Hcrud->deleteReward($kd);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/hadiah');
    }
}
