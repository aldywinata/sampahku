<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ulasan extends CI_Controller
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

        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Message_model', 'MSG');
        $this->load->model('Ulasan_model', 'Ulcrud');
        $this->load->model('Config_model', 'Ccrud');
    }
    public function index()
    {
        $idn = $this->session->userdata('id_nsb');
        $get = $this->Ulcrud->getUlasanByValue('id_nasabah', $idn);

        $data = [
            'title' => 'Beri Ulasan',
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'nasabah' => $this->Ncrud->getNasabahByValue('id_nasabah', $idn),
            'ulasan' => $get,
            'maxRating' => '5'
        ];



        $this->load->view('temp/templates/header', $data);
        $this->load->view('temp/nasabah/templates/topbar');
        $this->load->view('temp/nasabah/templates/sidebar');
        if (empty($get)) {
            $this->load->view('temp/nasabah/ulasan/index');
        } else {
            $this->load->view('temp/nasabah/ulasan/edit_form.php');
        }
        $this->load->view('temp/templates/footer');
    }
    public function add()
    {
        $this->form_validation->set_rules('ulasan', 'Ulasan ', 'required', array('required' => '%s tidak boleh kosong'));
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'id_nasabah' => $this->session->userdata('id_nsb'),
                'rating_review' => $this->input->POST('rating', true),
                'deskripsi_review' => $this->input->POST('ulasan', true),
                'status_review' => '0',
            ];

            $cek = $this->Ulcrud->addUlasan($data);
            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Ulasan Telah dikirim. Terima kasih atas Ulasannya');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Ulasan Gagal dikirim !');
            }
            redirect('nasabah/ulasan');
        }
    }
    public function edit()
    {
        $this->form_validation->set_rules('ulasan', 'Ulasan ', 'required', array('required' => '%s tidak boleh kosong'));
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'rating_review' => $this->input->POST('rating', true),
                'deskripsi_review' => $this->input->POST('ulasan', true),
                'status_review' => '0',
            ];
            $cek = $this->Ulcrud->updateUlasanWhere('id_nasabah', $this->session->userdata('id_nsb'), $data);
            if ($cek) {
                $this->MSG->notifSweets('success', 'Success', 'Ulasan Telah diperbaharui. Terima kasih atas Ulasannya');
            } else {
                $this->MSG->notifSweets('error', 'Oops...', 'Ulasan Gagal diperbaharui !');
            }
            redirect('nasabah/ulasan');
        }
    }
    public function delete($id)
    {

        $cek = $this->Ulcrud->deleteUlasan($id);
        if ($cek) {
            $this->MSG->notifSweets('success', 'Success', 'Data Berhasil dihapus');
        } else {
            $this->MSG->notifSweets('error', 'Oops...', 'Data Gagal dihapus !');
        }
        redirect('nasabah/ulasan');
    }
}
