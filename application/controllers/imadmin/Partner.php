<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partner extends CI_Controller
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
        $this->load->model('Partner_model', 'Pcrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Ppcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title'     => 'Partner',
            'admin'     => $this->Ucrud->getUserById($id),
            'partners'  => $this->Pcrud->getAllData(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Ppcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/partner/index');
        $this->load->view('temp/templates/footer');
    }
    public function add()
    {
        //Config untuk uploadFile
        $upload_dir = './assets/imgs/be/img-partner/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $data = [
            'nama_partner' => strtolower($this->input->POST('nama', true)),
            'status_partner' => 1,
            'img_partner' => $this->glo->uploadFile('foto', 'Partner', '', $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Pcrud->addPartner($data);

        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil ditambah');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal ditambah !');
        }

        redirect('imadmin/partner');
    }
    public function updateStatus()
    {
        $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
        $cek = $this->Pcrud->getPartnerValue('id_partner', $id);


        if ($cek['status_partner'] == '1') {
            $data['status_partner'] = '0'; // Menggunakan string '0' untuk status tidak aktif
            $results = '0'; // Set results to '0' for inactive status
        } else {
            $data['status_partner'] = '1'; // Menggunakan string '1' untuk status aktif
            $results = '1'; // Set results to '1' for active status
        }

        $this->Pcrud->updatePartner('id_partner', $id, $data);

        echo $results;
        exit; // Send the results back as the response

        // redirect('imadmin/kategori');
    }
    public function update()
    {
        $id = $this->input->POST('idp', true);
        $cek = $this->Pcrud->getPartnerValue('id_partner', $id);

        //Config untuk uploadFile
        $upload_dir = './assets/imgs/be/img-partner/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $data = [
            'nama_partner' => strtolower($this->input->POST('nama', true)),
            'img_partner' => $this->glo->uploadFile('foto', 'Partner', $cek['img_partner'], $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Pcrud->updatePartner('id_partner', $cek['id_partner'], $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diupdate');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diupdate !');
        }
        redirect('imadmin/partner');
    }
    public function delete($id)
    {
        $cek = $this->Pcrud->getPartnerValue('id_partner', $id);

        $upload_dir = './assets/imgs/be/img-partner/'; //lokasi img sampah
        $this->glo->deleteIMG($cek['img_partner'], $upload_dir); //hapus foto berdasarkan id yang telah diambil

        $cek = $this->Pcrud->deletePartner($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/partner');
    }
}
