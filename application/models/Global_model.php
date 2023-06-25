<?php

class Global_model extends CI_Model
{
    public function getToken($email, $type, $id)
    {
        $token = base64_encode(random_bytes(40));
        $data = [
            'email' => $email,
            'token' => $token,
            'date_created' => time()
        ];

        $this->db->insert('tbl_token', $data);

        $this->_sendMail($token, $email, $type, $id, '', '');
    }

    public function _sendMail($token, $email, $type, $id, $username, $password)
    {
        $config = [
            'mailtype'      => 'html',
            'charset'       => 'utp-8',
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.gmail.com', // jika host 'smtp.gmail.com', tambahkan 'smtp_crypto'   => 'ssl'
            'smtp_user'     => 'demowebsite680@gmail.com',
            'smtp_pass'     => 'kadjkuodmxkjtbzl', // password dari sandi aplikasi (keamanan gmail)
            'smtp_port'     => 465, //ssl => 465, 25, tls => 587
            'newline'       => "\r\n"

        ];

        $this->load->library('email', $config);

        $this->email->from('demowebsite680@gmail.com', 'Sampahku');
        $this->email->to($email);

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Email');
            $this->email->message('Klik Link berikut untuk Verifikasi Email : <a href="' . base_url() . 'verify?email=' . $email . '&token=' . urlencode($token) . '">VERIFIKASI</a> <br> Harap Verifikasi Email Sebelum <b>1 Jam</b> Setelah Menerima Email ini ! ');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik Link berikut untuk Reset Password : <a href="' . base_url() . 'reset?email=' . $email . '&token=' . urlencode($token) . '">RESET PASSWORD</a> <br> Harap Reset Password Sebelum <b>1 Jam</b> Setelah Menerima Email ini ! ');
        } elseif ($type == 'change') {
            $this->email->subject('Verifikasi Ganti Email');
            $this->email->message('Klik Link berikut untuk Ganti Email : <a href="' . base_url() . 'change?email=' . $email . '&token=' . urlencode($token) . '&ui=' . $id . '">GANTI EMAIL</a> <br> Harap Klik Link tersebut Sebelum <b>1 Jam</b> Setelah Menerima Email ini ! ');
        } elseif ($type == 'sendAccount') {
            $this->email->subject('INFORMASI ACCOUNT ANDA');
            $this->email->message('Terima Kasih Telah Bergabung. Berikut Informasi Username dan Password Anda :<br><br> <b>Username</b> : ' . $username . ' <br> <b>Password</b> : ' . $password . ' <br><br> Harap Simpan Informasi Tersebut dan diharapkan untuk Segera Mengganti Password Anda ! ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }

        // kadjkuodmxkjtbzl
    }

    public function generateKode($kose)
    {
        // $kose  = 'ADM';
        $tahun = date("ym");

        $this->db->select('RIGHT(tbl_reward.kode_reward,3) as kode_reward', FALSE);
        $this->db->order_by('kode_reward', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_reward');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_reward) + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodeTampil = $kose . $tahun . $batas;

        return $kodeTampil;
    }

    public function generateUsername($kose)
    {
        // $kose  = 'ADM';
        $tahun = date("ym");

        $this->db->select('RIGHT(tbl_nasabah.username,5) as username', FALSE);
        $this->db->order_by('username', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_nasabah');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->username) + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodeTampil = $kose . $tahun . $batas;

        return $kodeTampil;
    }
    public function generateIDsetor()
    {
        $tahun = date("ymd");

        $this->db->select('RIGHT(tbl_setor.id_setor,5) as id_setor', FALSE);
        $this->db->order_by('id_setor', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_setor');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->id_setor) + 1;
        } else {
            $id = 1;
        }

        $batas = str_pad($id, 5, "0", STR_PAD_LEFT);
        $idTampil = $tahun . $batas;

        return $idTampil;
    }

    public function uploadFile($field_name, $type, $img_old, $upload_dir, $allowed_types, $max_size)
    {
        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['file_name'] = 'IMG-' . $type . substr(md5(rand()), 0, 20);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            $old = $img_old;

            if (!empty($old)) {
                $this->deleteIMG($old, $upload_dir);
            }

            return $this->upload->data("file_name");
        }

        return $img_old;
    }

    public function deleteIMG($old, $upload_dir)
    {
        if ($old != 'default_img.png') {
            $path = $upload_dir . $old;
            unlink($path);
        }
    }
}
