<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
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

        $data = [
            'title' => 'Config System',
            'admin' => $this->Ucrud->getUserById($id),
            'info' => $this->Ccrud->getData(),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/config-system/index');
        $this->load->view('temp/templates/footer');
    }
    public function update()
    {
        $idc = '1';
        $get = $this->Ccrud->getSysfoByValue($idc);

        $upload_dir = './assets/imgs/be/img-sysfo/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $data = [
            'icon_sysfo' => $this->glo->uploadFile('foto1', 'icon', $get['icon_sysfo'], $upload_dir, $allowed_types, $max_size),
            'img_hero_sysfo' => $this->glo->uploadFile('foto2', 'thumb', $get['img_hero_sysfo'], $upload_dir, $allowed_types, $max_size),
            'img_hero2_sysfo' => $this->glo->uploadFile('foto3', 'about', $get['img_hero2_sysfo'], $upload_dir, $allowed_types, $max_size),
            'nama_sysfo' => strtolower($this->input->POST('nama', true)),
            'slogan_sysfo' => strtolower($this->input->POST('slogan', true)),
            'about_sysfo' => strtolower($this->input->POST('about', true)),
        ];

        $cek = $this->Ccrud->updateConfig($idc, $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('imadmin/config');
    }

    public function updateKontak()
    {
        $idc = '1';

        $data = [
            'no_sysfo' => $this->input->POST('no_hp', true),
            'email_sysfo' => $this->input->POST('email', true),
            'hari_kerja_sysfo' => strtolower($this->input->POST('hari', true)),
            'jam_kerja_sysfo' => $this->input->POST('jam', true),
            'alamat_sysfo' => strtolower($this->input->POST('alamat', true)),
        ];

        $cek = $this->Ccrud->updateConfig($idc, $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('imadmin/config');
    }
}
