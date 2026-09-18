<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangMasuk extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda belum login!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('Welcome');
        } 
    }
    
    public function index() {
        $data['title'] = "Barang Masuk";
        $keyword = $this->input->get('keyword');
    
        if ($keyword) {
            $this->db->like('kode_barang', $keyword);
            $this->db->or_like('nama', $keyword);
            $data['masuk'] = $this->db->get('barang_masuk')->result();
        } else {
            $data['masuk'] = $this->penggajianModel->get_data('barang_masuk')->result();
        }
    
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/barangMasuk', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahData() {
        $data['title'] = "Tambah Data Barang Masuk";

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahBarangMasuk', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahData();
        } else {
            $kode_barang   = $this->input->post('kode_barang');
            $nama          = $this->input->post('nama');
            $stok_masuk    = $this->input->post('stok_masuk');
            $tanggal_masuk = $this->input->post('tanggal_masuk');

            $data = array(
                'kode_barang'   => $kode_barang,
                'nama'          => $nama,
                'stok_masuk'    => $stok_masuk,
                'tanggal_masuk' => $tanggal_masuk,
            );

            $this->penggajianModel->insert_data($data, 'barang_masuk');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('admin/barangMasuk');
        }
    }

    public function updateData($kode_barang) {
        // Menggunakan Query Builder agar aman dari SQL Injection
        $where = array('kode_barang' => $kode_barang);
    
    // Ambil data berdasarkan kode_barang
        $data['masuk'] = $this->penggajianModel->get_data('barang_masuk', $where)->result();
        $data['title'] = "Update Data Barang Masuk";

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formUpdateBarang', $data); // Disesuaikan nama view untuk update barang
        $this->load->view('templates_admin/footer');
    }

    public function updateDataAksi() {
        $this->_rules();

        $kode_barang = $this->input->post('kode_barang');

        if ($this->form_validation->run() == FALSE) {
            $this->updateData($kode_barang);
        } else {
            $nama          = $this->input->post('nama');
            $stok_masuk    = $this->input->post('stok_masuk');
            $tanggal_masuk = $this->input->post('tanggal_masuk');

            $data = array(
                'nama'          => $nama,
                'stok_masuk'    => $stok_masuk,
                'tanggal_masuk' => $tanggal_masuk,
            );

            $where = array(
                'kode_barang' => $kode_barang 
            );

            $this->penggajianModel->update_data('barang_masuk', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('admin/barangMasuk');
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('stok_masuk', 'Stok Masuk', 'required|numeric');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
    }

    public function deleteData($kode_barang) {
        $where = array('kode_barang' => $kode_barang);
        $this->penggajianModel->delete_data($where, 'barang_masuk');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('admin/barangMasuk');
    }
}