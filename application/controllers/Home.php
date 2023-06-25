<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model('Users_model', 'Ucrud');
        $this->load->model('Nasabah_model', 'Ncrud');
        $this->load->model('Sampah_model', 'Scrud');
        $this->load->model('Ulasan_model', 'Ulcrud');
        $this->load->model('Config_model', 'Ccrud');
        $this->load->model('Partner_model', 'Pcrud');
        $this->load->model('Setor_model', 'Stcrud');
    }
    public function index()
    {
        $data = [
            'jumNSB' => $this->Ncrud->getJumlahRow(),
            'jumSMP' => $this->Scrud->getJumlahRow(),
            'jumKG' => $this->Stcrud->getJumlahBeratSetorNoWhere(),
            'reviews' => $this->Ulcrud->getAllData(),
            'partners' => $this->Pcrud->getAllData(),
            'info' => $this->Ccrud->getSysfoByValue('1'),
            'sampahs' => $this->Scrud->getAllData()
        ];

        $this->load->view('temp/fe/index', $data);
    }
}
