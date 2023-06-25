<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Change extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $email = $this->input->GET('email');
        $token = $this->input->GET('token');
        $id = $this->input->GET('ui');

        if (empty($email) || empty($token) || empty($id)) {
            redirect(base_url());
        } else {
            $cekTblT = $this->db->get_where('tbl_token', ['email' => $email])->row_array();
            if ($cekTblT) {
                if ($cekTblT['token'] == $token) {
                    if (time() - $cekTblT['date_created'] < (60 * 60)) {
                        $cekU = $this->Ucrud->cekUser('email', $email);
                        $cekN = $this->Ncrud->getNasabahByValue('email_nsb', $email);

                        if ($cekU) {
                            $data = [
                                'email_verif'   => '1'
                            ];
                            $this->Ucrud->updateUser('id_users', $id, $data);
                        } elseif ($cekN) {
                            $data = [
                                'email_nsb_verif'   => '1'
                            ];
                            $this->Ncrud->updateNasabah('id_nasabah', $id, $data);
                        } else {
                            $data['stat'] = 'gagal';
                            $data['type'] = 'failed';
                            $data['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email Tidak Terdaftar !</div>';
                        }

                        $this->db->delete('tbl_token', ['email' => $email]); //hapus email di tbl_token

                        $data['stat'] = 'berhasil';
                        $data['type'] = 'change';
                        $data['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Terima kasih Telah Verifikasi Email</div>';
                    } else {
                        $this->db->delete('tbl_token', ['email' => $email]); //hapus email di tbl_token

                        $data['stat'] = 'gagal';
                        $data['type'] = 'failed';
                        $data['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Masa Berlaku LINK Expired !</div>';
                    }
                } else {
                    $data['stat'] = 'gagal';
                    $data['type'] = 'failed';
                    $data['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email atau Token Invalid !</div>';
                }
            } else {
                $data['stat'] = 'gagal';
                $data['type'] = 'failed';
                $data['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email atau Token Invalid !</div>';
            }
        }

        $data = [
            'title' => 'Verifikasi Email',
            'info' => $this->Ccrud->getSysfoByValue('1'),
        ];
        $this->load->view('temp/templates/auth_header', $data);
        $this->load->view('pages/verify/index');
        $this->load->view('temp/templates/auth_footer');
    }
}
