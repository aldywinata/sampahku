<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Message_model', 'MSG');
        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $email = $this->input->GET('email');
        $token = $this->input->GET('token');

        $cek = $this->db->get_where('tbl_token', ['email' => $email])->row_array();

        if (!isset($_POST['reset'])) {
            if (empty($email) || empty($token)) {
                redirect(base_url());
            } else {
                if ($cek['email'] != $email || $cek['token'] != $token) {
                    $this->MSG->notifSweets('error', 'Oops...', 'Maaf Email atau Token tidak Valid !');
                    redirect('forgot');
                } else {
                    if (time() - $cek['date_created'] < (60 * 60)) {
                        $data = [
                            'title' => 'Reset Password',
                            'info' => $this->Ccrud->getSysfoByValue('1'),
                            'email' => $email,
                            'token' => urlencode($token)
                        ];

                        $this->load->view('temp/templates/auth_header', $data);
                        $this->load->view('pages/reset-pass/index');
                        $this->load->view('temp/templates/auth_footer');
                    } else {
                        $this->db->delete('tbl_token', ['email' => $cek['email']]);
                        $this->MSG->notifSweets('error', 'Oops...', 'Masa Berlaku LINK Expired, Harap Reset Password Kembali !');
                        redirect('forgot');
                    }
                }
            }
        } else {
            $email = $this->input->POST('email');
            $token = $this->input->POST('token');

            $this->_change($email, $token);
        }
    }

    private function _change($email, $token)
    {
        $pass1 = $this->input->POST('password', true);
        $pass2 = $this->input->POST('password2', true);


        if ($pass1 == $pass2) {
            $cek = $this->Ucrud->cekUser('email', $email);
            $cekN = $this->Ncrud->getNasabahByValue('email_nsb', $email);
            if ($cek) {
                if (!password_verify($pass1, $cek['password'])) {
                    var_dump($cek);
                    die;
                    $data['password'] = password_hash($pass1, PASSWORD_DEFAULT);
                    $this->Ucrud->updateUser('id_users', $cek['id_users'], $data);

                    $this->MSG->notifSweets('success', 'Success', 'Password Berhasil diubah, Harap Login kembali !');
                    $this->db->delete('tbl_token', ['email' => $cek['email']]);
                    redirect('auth');
                } else {
                    $this->session->set_flashdata($this->MSG->flashSuccNoClose('Password Baru sama dengan password sebelumnya !'));
                    redirect('reset?email=' . $email . '&token=' . $token);
                }
            } elseif ($cekN) {
                if (!password_verify($pass1, $cekN['password'])) {
                    $data['password'] = password_hash($pass1, PASSWORD_DEFAULT);
                    $this->Ncrud->updateNasabah('id_nasabah', $cekN['id_nasabah'], $data);

                    $this->MSG->notifSweets('success', 'Success', 'Password Berhasil diubah, Harap Login kembali !');
                    $this->db->delete('tbl_token', ['email' => $cekN['email_nsb']]);
                    redirect('auth');
                } else {
                    $this->session->set_flashdata($this->MSG->flashSuccNoClose('Password Baru sama dengan password sebelumnya !'));
                    redirect('reset?email=' . $email . '&token=' . $token);
                }
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Email Invalid !');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata($this->MSG->flashSuccNoClose('Password Tidak Sama !'));
            redirect('reset?email=' . $email . '&token=' . $token);
        }
    }
}
