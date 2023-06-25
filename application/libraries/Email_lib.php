<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('email');
    }

    public function sendEmail($email, $username)
    {
        $config = [
            'mailtype'      => 'html',
            'charset'       => 'utp-8',
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.gmail.com', // jika host 'smtp.gmail.com', tambahkan 'smtp_crypto'   => 'ssl'
            'smtp_user'     => 'demowebsite680@gmail.com',
            'smtp_pass'     => 'kadjkuodmxkjtbzl', // password dari sandi aplikasi (keamanan gmail)
            'smtp_port'     => 465,
            'newline'       => "\r\n"

        ];

        $this->CI->email->initialize($config);
        $this->CI->email->from('demowebsite680@gmail.com', 'Sampahku');
        $this->CI->email->to($email);

        $this->CI->email->subject('INFORMASI ACCOUNT ANDA');
        $this->CI->email->message('Terima Kasih Telah Bergabung. Berikut Informasi Username dan Password Anda :<br><br> <b>Username</b> : ' . $username . ' <br> <b>Password</b> : nasabah123 <br><br> Harap Simpan Informasi Tersebut dan diharapkan untuk Segera Mengganti Password Anda ! ');

        if ($this->CI->email->send()) {
            return true;
        } else {
            echo $this->CI->email->print_debugger();
            die;
        }
    }
}
