<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        $id = $this->session->userdata('id_users');

        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Users_role_model', 'role');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title' => 'Proifl',
            'admin' => $this->Ucrud->getUserById($id),
            'roles' => $this->role->getAllRole(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/profile/index');
        $this->load->view('temp/templates/footer');
    }

    public function update()
    {
        $input = $this->input;
        $id = $this->session->userdata('id_users');

        $upload_dir = './assets/imgs/be/img-users/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $user = $this->Ucrud->getUserById($id);
        $data = [
            'nama_users' => strtolower($input->POST('nama', true)),
            'no_tlp' => $input->POST('no_hp', true),
            'img_users' => $this->glo->uploadFile('img_users', 'Users', $user['img_users'], $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Ucrud->updateUser('id_users', $id, $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('imadmin/profile');
    }

    public function reimg()
    {
        $id = $this->session->userdata('id_users');
        $user = $this->Ucrud->getUserById($id);
        $upload_dir = './assets/imgs/be/img-users/';

        $this->glo->deleteIMG($user['img_users'], $upload_dir);

        $data['img_users'] = 'default_img.png';
        $cek = $this->Ucrud->updateUser('id_users', $id, $data);

        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Foto Profile telah dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Foto Profile gagal dihapus !');
        }
        redirect('imadmin/profile');
    }

    public function updateEmail()
    {
        $id = $this->session->userdata('id_users');
        $email = $this->input->POST('email', true);

        $cekN = $this->Ncrud->getNasabahByValue('email_nsb', $email);
        if (!$cekN) {
            $cekTblT = $this->db->get_where('tbl_token', ['email' => $email])->row_array();
            if (!$cekTblT) {
                $cek = $this->Ucrud->cekUser('email', $email);
                if (!$cek) {

                    $this->glo->getToken($email, 'change', $id); //kirim email
                    //jika email terkirim, update email verif
                    $data = [
                        'email' => $email,
                        'email_verif' => '0'
                    ];
                    $this->Ucrud->updateUser('id_users', $id, $data);
                    //Munculkan Notif
                    $this->MSG->notifSweets('success', 'Success', 'Link Verifikasi Ganti Email telah dikirim, Harap Cek email ' . $email);
                    redirect('imadmin/profile');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
                    redirect('imadmin/profile');
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Harap Cek Email Anda !');
                redirect('imadmin/profile');
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
            redirect('imadmin/profile');
        }
    }

    public function updatePass()
    {
        $input = $this->input;
        $id = $this->session->userdata('id_users');
        $cek = $this->Ucrud->cekUser('id_users', $id);
        $passOld = $input->POST('password', true);
        //Cek password lama
        if (password_verify($passOld, $cek['password'])) {
            //Cek password baru tidak boleh sama dengan password baru
            $passNew = $input->POST('newpassword', true);
            if (!password_verify($passNew, $cek['password'])) {
                //cek password baru dengan ulangi password
                $passNewRe = $input->POST('renewpassword', true);
                if ($passNew == $passNewRe) {
                    $data['password'] = password_hash($passNew, PASSWORD_DEFAULT);
                    $this->Ucrud->updateUser('id_users', $cek['id_users'], $data);
                    $this->MSG->notifSweets('success', 'Success', 'Password Berhasil diubah');
                    redirect('imadmin/profile');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Password Baru dan Konfirmasi Password Baru tidak sama !');
                    redirect('imadmin/profile');
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Password Baru tidak boleh sama dengan Password Lama !');
                redirect('imadmin/profile');
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Password Lama Salah !');
            redirect('imadmin/profile');
        }
    }
}
