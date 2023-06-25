<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Inisialisasi xendit
require 'vendor/autoload.php';

use Xendit\Xendit;

class Penukaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_nsb')) {
            echo "<script>
                alert('Harap Login Terlebih Dahulu !');
                window.location.href ='../auth';
            </script>";
        }

        $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Hadiah_model', 'Hcrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Penukaran_model', 'Pcrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');

        $data = [
            'title' => 'Penukaran Poin',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'rewards' => $this->getFilter()
        ];
        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        $this->load->view('temp/nasabah/penukaran/index');
        $this->load->view('temp/templates/footer');
    }

    private function getFilter()
    {
        $jenis = $this->input->POST('jenis');
        $queri = $this->Hcrud->getHadiahFilter($jenis);

        return $queri;
    }

    public function vtransaksi($kd)
    {
        $idn = $this->session->userdata('id_nsb');
        $get = $this->Hcrud->getHadiahByValue('kode_reward', $kd); //$this->input->POST('kode', true)

        $data = [
            'title' => 'Konfirmasi Penukaran Poin',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'reward' => $get
        ];
        $nasabah = $data['nasabah'];

        if ($nasabah['poin_nasabah'] >= $get['poin_reward']) {

            $this->load->view('temp/templates/header', $data);
            $this->load->view('temp/nasabah/templates/topbar');
            $this->load->view('temp/nasabah/templates/sidebar');
            if ($get['jenis_reward'] == 'tukar_barang') {
                $this->load->view('temp/nasabah/penukaran/vtukar_barang');
            } elseif ($get['jenis_reward'] == 'voucher') {
                $this->load->view('temp/nasabah/penukaran/vvoucher');
            }
            $this->load->view('temp/templates/footer');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Poin Anda Tidak Cukup');
            redirect('nasabah/penukaran');
        }
    }
    public function transaksi()
    {
        $kode = $this->input->post('kode', true);
        $getR = $this->Hcrud->getHadiahByValue('kode_reward', $kode);
        $getN = $this->Ncrud->getNasabahByValue('id_nasabah', $this->session->userdata('id_nsb'));

        if ($getR['jenis_reward'] == 'voucher') {

            $metode = $this->input->POST('metode', true);

            if ($metode == 'bank') {
                $bankCode = $this->input->POST('bank', true);
            } elseif ($metode == 'ewallet') {
                $bankCode = $this->input->POST('ewallet', true);
            }

            $externalId = 'VOU-' . time();
            $nama = strtolower($this->input->POST('nama', true));
            $send = $this->input->POST('nomor', true);
            $desk = ucwords('Penukaran ' . $getR['nama_reward']);
            // $stat = 'pending';

            //SET Secret API Key
            Xendit::setApiKey('xnd_development_M1Fm2MU04PHF9ONl2zqYjrMKdwqkjJToMVQW4V4wxBPfuyJTwjbnMxFM4hpW64');

            $params = [
                "external_id" => $externalId,
                "amount" => $getR['nominal_reward'],
                "bank_code" => $bankCode,
                "account_holder_name" => $nama,
                "account_number" => $send,
                "description" => $desk,
                'X-IDEMPOTENCY-KEY' => $externalId
            ];

            $createDisbursements = \Xendit\Disbursements::create($params);

            if ($createDisbursements) {
                $stat = 'completed';
                //kurangi poin
                $hasil = $getN['poin_nasabah'] - $getR['poin_reward'];

                $data = [
                    'poin_nasabah' => $hasil
                ];
                $this->Ncrud->updateNasabah('id_nasabah', $this->session->userdata('id_nsb'), $data);
            } else {

                $stat = 'failed';
                $this->MSG->notifSweets('error', 'Oops...', 'Penukaran Gagal dilakukan !');
            }
        } elseif ($getR['jenis_reward'] == 'tukar_barang') {

            //kurangi jumlah stok 1
            $minStok = $getR['stok_reward'] - 1;

            $data = [
                'stok_reward' => $minStok
            ];

            $this->Hcrud->updateHadiah($kode, $data);

            //End kurangi Stok
            //kurangi poin
            $hasil = $getN['poin_nasabah'] - $getR['poin_reward'];

            $data = [
                'poin_nasabah' => $hasil
            ];

            $cek = $this->Ncrud->updateNasabah('id_nasabah', $this->session->userdata('id_nsb'), $data);
            //End Kurangi Poin
            if ($cek) {
                $externalId = 'TKR-' . time();
                $bankCode = $getR['jenis_reward'];
                $nama = $getN['nama_nasabah'];
                $send = strtolower($getN['alamat'] . ' Rt. ' . $getN['alamat_rt'] . ' Rw. ' . $getN['alamat_rw']);
                $desk = ucwords('Penukaran ' . $getR['nama_reward']);
                $stat = 'proses';
            } else {
                $stat = 'failed';
                $this->MSG->notifSweets('error', 'Oops...', 'Penukaran Gagal dilakukan !');
            }
        } else {
            redirect('nasabah/dashboard');
        }

        $data = [
            'id_penukaran' => $externalId,
            'id_nasabah' => $this->session->userdata('id_nsb'),
            'date_penukaran' => time(),
            'kode' => $kode,
            'jenis_penukaran' => $bankCode,
            'poin_penukaran' => $getR['poin_reward'],
            'nominal_penukaran' => $getR['nominal_reward'],
            'nama_tujuan' => $nama,
            'send_tujuan' => $send,
            'deskripsi_penukaran' => strtolower($desk),
            'status_penukaran' => $stat
        ];

        $cek = $this->Pcrud->addPenukaran($data);

        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Penukaran Sedang diproses !');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Penukaran Gagal dilakukan !');
        }

        redirect('nasabah/penukaran');
    }
}
