<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('id_users')) {
        //     redirect('imadmin/dashboard');
        // } elseif ($this->session->userdata('id_nsb')) {
        //     redirect('nasabah/dashboard');
        // };

        $this->load->model('Users_model', 'admin');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        if (!isset($_POST['loggin'])) {
            $data = [
                'title' => 'Login',
                'info' => $this->Ccrud->getSysfoByValue('1'),
            ];

            $this->load->view('temp/templates/auth_header', $data);
            $this->load->view('pages/auth/index');
            $this->load->view('temp/templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->POST('username', true);
        $password = $this->input->POST('password', true);

        $admin = $this->admin->getUserByUsername($username);
        $cekN  = $this->Ncrud->getNasabahByValue('username', $username);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {

                if ($admin['email_verif'] != 0) {

                    if ($admin['status_users'] != 0) {
                        $data = [
                            'id_users' => $admin['id_users'],
                            'username' => $admin['username'],
                            'hak'      => '0', // 0 = admin, 1 = nasabah
                            'id_users_role' => $admin['id_users_role']
                        ];

                        $this->session->set_userdata($data);
                        redirect('imadmin/dashboard');
                    } else {
                        $this->session->set_flashdata($this->MSG->flashSuccNoClose('Anda tidak dapat Login, Harap Hubungi Pihak Terkait !!'));
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata($this->MSG->flashSuccNoClose('Harap Verifikasi Email Terlebih Dahulu !!'));
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata($this->MSG->flashSuccNoClose('Password salah !'));
                redirect('auth');
            }
        } elseif ($cekN) {
            if (password_verify($password, $cekN['password'])) {
                if ($cekN['email_nsb_verif'] != 0) {
                    if ($cekN['status_nasabah'] != 0) {
                        $data = [
                            'id_nsb' => $cekN['id_nasabah'],
                            'username' => $cekN['username'],
                            'hak'      => '1', // 0 = admin, 1 = nasabah
                        ];

                        $this->session->set_userdata($data);
                        redirect('nasabah/dashboard');
                    } else {
                        $this->session->set_flashdata($this->MSG->flashSuccNoClose('Anda tidak dapat Login, Harap Hubungi Pihak Terkait !!'));
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata($this->MSG->flashSuccNoClose('Harap Verifikasi Email Terlebih Dahulu !!'));
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata($this->MSG->flashSuccNoClose('Password salah !'));
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata($this->MSG->flashSuccNoClose('Username Tidak ditemukan !'));
            redirect('auth');
        }
    }

    public function logout()
    {
        if ($this->session->userdata('id_users')) {
            $this->session->unset_userdata('id_users');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('hak');
            $this->session->unset_userdata('id_users_role');
        } elseif ($this->session->userdata('id_nsb')) {
            $this->session->unset_userdata('id_nsb');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('hak');
        }

        $this->MSG->notifSweets('success', 'Anda Telah Logout', '');
        redirect('auth');
    }
}
