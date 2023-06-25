<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
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

        // $this->load->library('email_lib');

        $this->load->model('Users_model', 'Ucrud');
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
            'title'     => 'Nasabah',
            'admin'     => $this->Ucrud->getUserById($id),
            'nasabah'   => $this->Ncrud->getNasabah(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/nasabah/index');
        $this->load->view('temp/templates/footer');
    }
    public function profile()
    {
        $id  = $this->session->userdata('id_users');
        $idn = $this->uri->segment(4);

        $data = [
            'title' => 'Profile',
            'admin' => $this->Ucrud->getUserById($id),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah'  => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'statuss' => [0, 1],
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/nasabah/profile');
        $this->load->view('temp/templates/footer');
    }
    public function vadd()
    {
        $id = $this->session->userdata('id_users');

        $data = [
            'title'     => 'Tambah Nasabah',
            'admin'     => $this->Ucrud->getUserById($id),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'jumProses' => $this->Pcrud->getJumlahBy('status_penukaran', 'proses')
        ];

        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/templates/topbar');
        $this->load->view('temp/templates/sidebar');
        $this->load->view('temp/be/nasabah/add_form');
        $this->load->view('temp/templates/footer');
    }
    public function add()
    {
        if (isset($_POST['btnAdd'])) {
            $this->form_validation->set_rules('nama', 'Nama ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('alamat', 'Alamat ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('rt', 'RT ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('rw', 'RW ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('job', 'Pekerjaan ', 'required', array('required' => '%s tidak boleh kosong'));
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_nasabah.email_nsb]', array('required' => '%s tidak boleh kosong', 'is_unique' => '%s Telah digunakan'));
            $this->form_validation->set_rules('no_hp', 'No Telepon', 'required', array('required' => '%s tidak boleh kosong'));

            if ($this->form_validation->run() == FALSE) {
                $this->vadd();
            } else {
                $input = $this->input;

                $data = [
                    'nama_nasabah'      => strtolower($input->POST('nama', true)),
                    'poin_nasabah'      => '0',
                    'pekerjaan_nasabah' => strtolower($input->POST('job', true)),
                    'alamat'            => strtolower($input->POST('alamat', true)),
                    'alamat_rt'         => $input->POST('rt', true),
                    'alamat_rw'         => $input->POST('rw', true),
                    'email_nsb'         => $input->POST('email', true),
                    'email_nsb_verif'   => '0',
                    'no_tlp_nsb'        => $input->POST('no_hp', true),
                    'username'          => $this->glo->generateUsername('NSB'),
                    'password'          => password_hash('nasabah123', PASSWORD_DEFAULT),
                    'date_join_nsb'     => time(),
                    'status_nasabah'    => '0',
                    'img_nasabah'       => 'default_img.png'
                ];

                $this->glo->getToken($input->POST('email', true), 'verify', '');

                $cek = $this->Ncrud->addNasabah($data);
                if ($cek) {
                    $this->MSG->notifSweets('success', 'Success', 'Data Berhasil disimpan, Harap Verifikasi Email, untuk Aktivasi Account !');
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal disimpan, Harap Cek Kembali !');
                }

                redirect('imadmin/nasabah');
            }
        } elseif (isset($_POST['btnBack'])) {
            redirect('imadmin/nasabah');
        }
    }
    public function update()
    {
        $input = $this->input;
        $idn = $input->POST('in', true);

        $upload_dir = './assets/imgs/be/img-nasabah/';
        $allowed_types = 'gif|jpg|png|jpeg';
        $max_size = 2048;

        $cekN = $this->Ncrud->getNasabahByValue('id_nasabah', $idn);

        $data = [
            'nama_nasabah'      => strtolower($input->POST('nama', true)),
            'poin_nasabah'      => $input->POST('poin', true),
            'pekerjaan_nasabah' => strtolower($input->POST('job', true)),
            'alamat'            => strtolower($input->POST('alamat', true)),
            'alamat_rt'         => $input->POST('rt', true),
            'alamat_rw'         => $input->POST('rw', true),
            'no_tlp_nsb'        => $input->POST('no_hp', true),
            'status_nasabah'    => $input->POST('status_nasabah', true),
            'img_nasabah'       => $this->glo->uploadFile('img_nasabah', 'Nasabah', $cekN['img_nasabah'], $upload_dir, $allowed_types, $max_size)
        ];

        $cek = $this->Ncrud->updateNasabah('id_nasabah', $cekN['id_nasabah'], $data);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil diperbaharui');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal diperbaharui !');
        }
        redirect('imadmin/nasabah/profile/' . $cekN['id_nasabah']);
    }
    public function reimg($id)
    {
        $nasabah = $this->Ncrud->getNasabahByValue('id_nasabah', $id);

        $upload_dir = './assets/imgs/be/img-nasabah/';

        $this->glo->deleteIMG($nasabah['img_nasabah'], $upload_dir);

        $data['img_nasabah'] = 'default_img.png';
        $cek = $this->Ncrud->updateNasabah('id_nasabah', $id, $data);

        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Foto Profile telah dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Foto Profile gagal dihapus !');
        }
        redirect('imadmin/nasabah/profile/' . $id);
    }
    public function reverif($id)
    {
        $cek = $this->Ncrud->getNasabahByValue('id_nasabah', $id);
        if ($cek['email_nsb_verif'] == 0) {
            $cekTblT = $this->db->get_where('tbl_token', ['email' => $cek['email_nsb']])->row_array();
            if ($cekTblT) {
                $this->db->delete('tbl_token', ['email' => $cekTblT['email']]);
                $this->glo->getToken($cek['email'], 'verify', '');
                $this->MSG->notifSweets('success', 'Success', 'LINK Verifikasi Email telah dikirim ke email ' . $cek['email_nsb']);
                redirect('imadmin/nasabah');
            } else {
                $this->glo->getToken($cek['email_nsb'], 'verify', '');
                $this->MSG->notifSweets('success', 'Success', 'LINK Verifikasi Email telah dikirim ke email ' . $cek['email_nsb']);
                redirect('imadmin/nasabah');
            }
        } else {
            $this->MSG->notifSweets('success', 'Success', 'Account sudah melakukan verifikasi !');
            redirect('imadmin/nasabah');
        }
    }
    public function updateStatus()
    {
        $id = $this->input->post('sendId'); // Mengambil nilai 'sendId' dari POST data menggunakan method input->post()
        $cek = $this->Ncrud->getNasabahByValue('id_nasabah', $id);

        if ($cek['status_nasabah'] == '1') {
            $data['status_nasabah'] = '0'; // Menggunakan string '0' untuk status tidak aktif
            $results = '0'; // Set results to '0' for inactive status
        } else {
            $data['status_nasabah'] = '1'; // Menggunakan string '1' untuk status aktif
            $results = '1'; // Set results to '1' for active status
        }

        $this->Ncrud->updateNasabah('id_nasabah', $id, $data);

        echo $results;
        exit; // Send the results back as the response
    }
    public function updateEmail()
    {
        $id    = $this->input->POST('in', true);
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
                    redirect('imadmin/nasabah/profile/' . $id);
                } else {
                    $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
                    redirect('imadmin/nasabah/profile/' . $id);
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Harap Cek Email Anda !');
                redirect('imadmin/nasabah/profile/' . $id);
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Email Telah digunakan !');
            redirect('imadmin/nasabah/profile/' . $id);
        }
    }
    public function updatePass()
    {
        $input = $this->input;
        $id = $input->POST('in', true);
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
                redirect('imadmin/nasabah/profile/' . $id);
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Password tidak sama !');
                redirect('imadmin/nasabah/profile/' . $id);
            }
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Password Baru tidak boleh sama dengan Password Lama !');
            redirect('imadmin/nasabah/profile/' . $id);
        }
    }
    public function delete($id)
    {
        $cek = $this->Ncrud->getNasabahByValue('id_nasabah', $id);
        $this->db->delete('tbl_token', ['email' => $cek['email']]);

        $upload_dir = './assets/imgs/be/img-nasabah/'; //lokasi img nasabah
        $this->glo->deleteIMG($cek['img_nasabah'], $upload_dir); //hapus foto berdasarkan id

        $cek = $this->Ncrud->deleteNasabah($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('imadmin/nasabah');
    }
}
