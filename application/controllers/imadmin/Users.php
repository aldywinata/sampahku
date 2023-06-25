<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $this->load->model('Users_role_model', 'role');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'admin' => $this->Ucrud->getUserById($id),
            'users' => $this->Ucrud->getAllData(),
            'roles' => $this->role->getAllRole(),
            'title' => 'Users',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/users/index');
        $this->load->view('temp/templates/footer');
    }
    public function profile()
    {
        $id  = $this->session->userdata('id_users');
        $idu = $this->uri->segment(4);

        $data = [
            'title' => 'Profile',
            'admin' => $this->Ucrud->getUserById($id),
            'user'  => $this->Ucrud->getUserById($idu),
            'roles' => $this->role->getAllRole(),
            'statuss' => [0, 1],
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/users/profile');
        $this->load->view('temp/templates/footer');
    }

    public function add()
    {
        $input = $this->input;
        if ($this->session->userdata('id_users') == '1') {

            $username = $this->Ucrud->cekUser('username', $input->POST('username', true));
            if (!$username) {
                $email = $this->Ucrud->cekUser('email', $input->POST('email', true));
                if (!$email) {
                    $data = [
                        'nama_users'    => strtolower($input->POST('nama_user', true)),
                        'username'      => $input->POST('username', true),
                        'password'      => password_hash('users123', PASSWORD_DEFAULT),
                        'email'         => $input->POST('email', true),
                        'email_verif'   => '0',
                        'no_tlp'        => $input->POST('nope', true),
                        'img_users'     => 'default_img.png',
                        'status_users'  => '0',
                        'date_join'     => time(),
                        'id_users_role' => $input->POST('akses', true)
                    ];

                    $this->glo->getToken($input->POST('email', true), 'verify', '');
                    $cek = $this->Ucrud->addUser($data);

                    if ($cek) {
                        $this->MSG->notifSweets('success', 'Success', 'Data Berhasil disimpan, Harap Verifikasi Email, untuk Aktivasi Account !');
                    } else {
                        $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal disimpan, Harap Cek Kembali !');
                    }
                    redirect('imadmin/users');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Email Telah Digunakan !');
                    redirect('imadmin/users');
                }
            } else {

                $this->MSG->notifSweets('error', 'Oops...', 'Username Telah Digunakan !');
                redirect('imadmin/users');
            }
        } else {
        }
    }
    public function update()
    {
        $input = $this->input;
        $idu = $input->POST('iu', true);

        $upload_dir = './assets/imgs/be/img-users/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $cekU = $this->Ucrud->cekUser('id_users', $idu);

        $data = [
            'nama_users' => strtolower($input->POST('nama', true)),
            'no_tlp' => $input->POST('no_hp', true),
            'id_users_role' => $input->POST('iRole', true),
            'status_users' => $input->POST('status_users', true),
            'img_users' => $this->glo->uploadFile('img_users', 'Users', $cekU['img_users'], $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Ucrud->updateUser('id_users', $cekU['id_users'], $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('imadmin/users/profile/' . $cekU['id_users']);
    }
    public function reimg($id)
    {
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
        redirect('imadmin/users/profile/' . $id);
    }
    public function reverif($id)
    {
        $cek = $this->Ucrud->cekUser('id_users', $id);
        if ($cek['email_verif'] == 0) {
            $cekTblT = $this->db->get_where('tbl_token', ['email' => $cek['email']])->row_array();
            if ($cekTblT) {
                $this->db->delete('tbl_token', ['email' => $cekTblT['email']]);
                $this->glo->getToken($cek['email'], 'verify', '');
                $this->MSG->notifSweets('success', 'Success', 'LINK Verifikasi Email telah dikirim ke email ' . $cek['email']);
                redirect('imadmin/users');
            } else {
                $this->glo->getToken($cek['email'], 'verify', '');
                $this->MSG->notifSweets('success', 'Success', 'LINK Verifikasi Email telah dikirim ke email ' . $cek['email']);
                redirect('imadmin/users');
            }
        } else {
            $this->MSG->notifSweets('success', 'Success', 'Account sudah melakukan verifikasi !');
            redirect('imadmin/users');
        }
    }
    public function updateStatus()
    {
        if ($this->session->userdata('id_users') == '1') {
            $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
            $cek = $this->Ucrud->cekUser('id_users', $id);

            if ($cek['status_users'] == '1') {
                $data['status_users'] = '0'; // Menggunakan string '0' untuk status tidak aktif
                $results = '0'; // Set results to '0' for inactive status
            } else {
                $data['status_users'] = '1'; // Menggunakan string '1' untuk status aktif
                $results = '1'; // Set results to '1' for active status
            }

            $this->Ucrud->updateUser('id_users', $id, $data);

            echo $results;
            exit; // Send the results back as the response
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Anda Tidak Memiliki Akses !');
        }
        redirect('imadmin/users');
    }
    public function updateEmail()
    {
        $id    = $this->input->POST('iu', true);
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
                    redirect('imadmin/users/profile/' . $id);
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
                    redirect('imadmin/users/profile/' . $id);
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Harap Cek Email Anda !');
                redirect('imadmin/users/profile/' . $id);
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
            redirect('imadmin/users/profile/' . $id);
        }
    }
    public function updatePass()
    {
        $input = $this->input;
        $id = $input->POST('iu', true);
        $cek = $this->Ucrud->cekUser('id_users', $id);

        //Cek password baru tidak boleh sama dengan password Lama
        $passNew = $input->POST('newpassword', true);
        if (!password_verify($passNew, $cek['password'])) {
            //cek password baru dengan ulangi password
            $passNewRe = $input->POST('renewpassword', true);
            if ($passNew == $passNewRe) {
                $data['password'] = password_hash($passNew, PASSWORD_DEFAULT);
                $this->Ucrud->updateUser('id_users', $cek['id_users'], $data);
                $this->MSG->notifSweets('success', 'Success', 'Password Berhasil diubah');
                redirect('imadmin/users/profile/' . $id);
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Password tidak sama !');
                redirect('imadmin/users/profile/' . $id);
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Password Baru tidak boleh sama dengan Password Lama !');
            redirect('imadmin/users/profile/' . $id);
        }
    }
    public function delete($id)
    {
        $user = $this->Ucrud->cekUser('id_users', $id);
        $this->db->delete('tbl_token', ['email' => $user['email']]);

        $upload_dir = './assets/imgs/be/img-users/'; //lokasi img users
        $this->glo->deleteIMG($user['img_users'], $upload_dir); //hapus foto berdasarkan id

        $cek = $this->Ucrud->deleteUser($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/users');
    }
}
