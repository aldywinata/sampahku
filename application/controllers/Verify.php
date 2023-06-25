<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Global_model', 'glo');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {

        $email = $this->input->GET('email');
        $token = $this->input->GET('token');

        if (empty($email) || empty($token)) {
            redirect(base_url());
        } else {
            $cekTblU = $this->db->get_where('tbl_users', ['email' => $email])->row_array();
            $cekTblN = $this->db->get_where('tbl_nasabah', ['email_nsb' => $email])->row_array();
            //cek email di tbl_users
            if ($cekTblU) {
                //cek status di tbl_users
                if ($cekTblU['email_verif'] == 0) {
                    //cek token di tbl_token
                    $cekTblT = $this->db->get_where('tbl_token', ['email' => $cekTblU['email']])->row_array();
                    if ($cekTblT['token'] == $token) {
                        //cek masa aktif token
                        if (time() - $cekTblT['date_created'] < (60 * 60)) {
                            $dataUp = [
                                'email_verif'  => '1',
                                'status_users' => '1'
                            ];
                            $this->Ucrud->updateUser('email', $cekTblU['email'], $dataUp); //Update status di tbl_users
                            $this->db->delete('tbl_token', ['email' => $email]); //hapus email di tbl_token

                            //kirim username dan password ke email nasabah
                            $password = 'users123';

                            $this->glo->_sendMail('', $cekTblU['email'], 'sendAccount', '', $cekTblU['username'], $password);

                            $status = 'berhasil';
                            $tipe = 'verify';
                            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Terima kasih Telah Verifikasi Email</div>';
                        } else {
                            $this->Ucrud->deleteUser($cekTblU['id_users']); //hapus email di tbl_users
                            $this->db->delete('tbl_token', ['email' => $email]); //hapus email di tbl_token

                            $status = 'gagal';
                            $tipe = 'failed';
                            $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Masa Berlaku LINK Expired !</div>';
                        }
                    } else {
                        $status = 'gagal';
                        $tipe = 'failed';
                        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email atau Token Invalid !</div>';
                    }
                } else {
                    $status = 'berhasil';
                    $tipe = 'failed';
                    $message = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Email <b>' . $email . '</b> sudah melakukan Aktifasi !</div>';
                }
            } elseif ($cekTblN) { //cek email nasabah
                if ($cekTblN['email_nsb_verif'] == '0') { //cek email verif nasabah
                    $cekTblTN = $this->db->get_where('tbl_token', ['email' => $cekTblN['email_nsb']])->row_array(); //cek email nasabah ditable token
                    if ($cekTblTN['token'] == $token) { //cek token dengan tabel token
                        if (time() - $cekTblTN['date_created'] < (60 * 60)) {
                            $dataUp = [
                                'email_nsb_verif' => '1',
                                'status_nasabah' => '1'
                            ];

                            $this->Ncrud->updateNasabah('email_nsb', $email, $dataUp);
                            $this->db->delete('tbl_token', ['email' => $email]);

                            //kirim username dan password ke email nasabah
                            $password = 'nasabah123';

                            $this->glo->_sendMail('', $cekTblN['email_nsb'], 'sendAccount', '', $cekTblN['username'], $password);

                            $status = 'berhasil';
                            $tipe = 'verify';
                            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Terima kasih Telah Verifikasi Email</div>';
                        } else {
                            $this->Ncrud->deleteNasabah($cekTblN['id_nasabah']); //hapus email di tbl_nasabah
                            $this->db->delete('tbl_token', ['email' => $email]); //hapus email di tbl_token

                            $status = 'gagal';
                            $tipe = 'failed';
                            $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Masa Berlaku LINK Expired !</div>';
                        }
                    } else {
                        $status = 'gagal';
                        $tipe = 'failed';
                        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email atau Token Invalid !</div>';
                    }
                } else {
                    $status = 'berhasil';
                    $tipe = 'failed';
                    $message = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Email <b>' . $email . '</b> sudah melakukan Aktifasi !</div>';
                }
            } else {
                $status = 'gagal';
                $tipe = 'failed';
                $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>Email <b>' . $email . '</b> Tidak Terdaftar !</div>';
            }

            $data = [
                'title' => 'Verifikasi Email',
                'info' => $this->Ccrud->getSysfoByValue('1'),
                'stat' => $status,
                'type' => $tipe,
                'msg' => $message
            ];

            $this->load->view('temp/templates/auth_header', $data);
            $this->load->view('pages/verify/index');
            $this->load->view('temp/templates/auth_footer');
        }
    }
}
