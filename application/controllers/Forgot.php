<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Config_model', 'Ccrud');
    }

    public function index()
    {
        if (!isset($_POST['reques'])) {
            $data = [
                'title' => 'Lupa Password',
                'info' => $this->Ccrud->getSysfoByValue('1'),
            ];

            $this->load->view('temp/templates/auth_header', $data);
            $this->load->view('pages/forgot-pass/index');
            $this->load->view('temp/templates/auth_footer');
        } else {
            $this->forgotPassword();
        }
    }

    private function forgotPassword()
    {
        $username = $this->input->POST('username', true);
        $email = $this->input->POST('email');

        $cekTblU = $this->Ucrud->cekUser('username', $username);
        $cekTblN = $this->Ncrud->getNasabahByValue('username', $username);
        if ($cekTblU || $cekTblN) {
            if ($cekTblU['email'] == $email || $cekTblN['email_nsb'] == $email) {
                if ($cekTblU['email_verif'] == 1 || $cekTblN['email_nsb_verif'] == 1) {
                    if ($cekTblU['status_users'] == 1 || $cekTblN['status_nasabah'] == 1) {
                        $cekTblT = $this->db->get_where('tbl_token', ['email' => $cekTblU['email']])->row_array();
                        if (!$cekTblT) {
                            $this->glo->getToken($email, 'forgot', '');
                            $this->session->set_flashdata($this->MSG->flashSuccNoClose('Permintaan Reset Password Telah dikirim ke email <b>' . $email . '</b>'));
                            redirect('forgot');
                        } else {
                            $this->session->set_flashdata($this->MSG->flashSuccNoClose('Harap Cek Email Anda !'));
                            redirect('forgot');
                        }
                    } else {
                        $this->session->set_flashdata($this->MSG->flashSuccNoClose('Harap Hubungi Pihak Terkait !'));
                        redirect('forgot');
                    }
                } else {
                    $this->session->set_flashdata($this->MSG->flashSuccNoClose('Email belum diverifikasi !'));
                    redirect('forgot');
                }
            } else {
                $this->session->set_flashdata($this->MSG->flashSuccNoClose('Username dan Email tidak sesuai !'));
                redirect('forgot');
            }
        } else {
            $this->session->set_flashdata($this->MSG->flashSuccNoClose('Username Tidak ditemukan !'));
            redirect('forgot');
        }
    }
}
