<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_nsb')) {
            echo "<script>
                alert('Harap Login Terlebih Dahulu !');
                window.location.href ='../auth';
            </script>";
        }

        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');

        $data = [
            'title' => 'Profile',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn)
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/profile/index');
        $this->load->view('temp/templates/footer');
    }

    public function update()
    {
        $input = $this->input;
        $idn = $this->session->userdata('id_nsb');

        $upload_dir = './assets/imgs/be/img-nasabah/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $cekN = $this->Ncrud->getNasabahByValue('id_nasabah', $idn);

        $data = [
            'nama_nasabah'      => strtolower($input->POST('nama', true)),
            'pekerjaan_nasabah' => strtolower($input->POST('job', true)),
            'alamat'            => strtolower($input->POST('alamat', true)),
            'alamat_rt'         => $input->POST('rt', true),
            'alamat_rw'         => $input->POST('rw', true),
            'no_tlp_nsb'        => $input->POST('no_hp', true),
            'img_nasabah'       => $this->glo->uploadFile('img_nasabah', 'Nasabah', $cekN['img_nasabah'], $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Ncrud->updateNasabah('id_nasabah', $cekN['id_nasabah'], $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('nasabah/profile');
    }
    public function reimg()
    {
        $idn = $this->session->userdata('id_nsb');
        $nasabah = $this->Ncrud->getNasabahByValue('id_nasabah', $idn);

        $upload_dir = './assets/imgs/be/img-nasabah/';

        $this->glo->deleteIMG($nasabah['img_nasabah'], $upload_dir);

        $data['img_nasabah'] = 'default_img.png';
        $cek = $this->Ncrud->updateNasabah('id_nasabah', $idn, $data);

        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Foto Profile telah dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Foto Profile gagal dihapus !');
        }
        redirect('nasabah/profile');
    }
    public function updateEmail()
    {
        $id    = $this->session->userdata('id_nsb');
        $email = $this->input->POST('email', true);

        $cekU = $this->Ucrud->cekUser('email', $email);
        if (!$cekU) {
            $cekTblT = $this->db->get_where('tbl_token', ['email' => $email])->row_array();
            if (!$cekTblT) {
                $cek  = $this->Ncrud->getNasabahByValue('email_nsb', $email);
                if (!$cek) {
                    $this->glo->getToken($email, 'change', $id); //kirim email
                    //jika email terkirim, update email verif
                    $data = [
                        'email_nsb' => $email,
                        'email_nsb_verif' => '0'
                    ];
                    $this->Ncrud->updateNasabah('id_nasabah', $id, $data);
                    //Munculkan Notif
                    $this->MSG->notifSweets('success', 'Success', 'Link Verifikasi Ganti Email telah dikirim, Harap Cek email ' . $email);
                    redirect('nasabah/profile');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
                    redirect('nasabah/profile');
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Harap Cek Email Anda !');
                redirect('nasabah/profile');
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
            redirect('nasabah/profile');
        }
    }
    public function updatePass()
    {
        $input = $this->input;
        $id = $this->session->userdata('id_nsb');
        $cek = $this->Ncrud->getNasabahByValue('id_nasabah', $id);

        //Cek password baru tidak boleh sama dengan password Lama
        $passNew = $input->POST('newpassword', true);
        if (!password_verify($passNew, $cek['password'])) {
            //cek password baru dengan ulangi password
            $passNewRe = $input->POST('renewpassword', true);
            if ($passNew == $passNewRe) {
                $data['password'] = password_hash($passNew, PASSWORD_DEFAULT);
                $this->Ncrud->updateNasabah('id_nasabah', $cek['id_nasabah'], $data);
                $this->MSG->notifSweets('success', 'Success', 'Password Berhasil diubah');
                redirect('nasabah/profile');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Password tidak sama !');
                redirect('nasabah/profile');
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Password Baru tidak boleh sama dengan Password Lama !');
            redirect('nasabah/profile');
        }
    }
}
