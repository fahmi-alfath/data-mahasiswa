<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DtMahasiswa extends MX_Controller {

    public $page_title = "Data Mahasiswa";

	function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pdf');
        $this->load->database();
	}

	function index(){
        $this->load->model('M_DtMahasiswa');

        $data = array(
            'page_url'          => 'V_DtMahasiswa_Main',
            'page_information'  => array(
                'page_title'        => $this->page_title,
                'page_position'     => 'List Data'
            ),
            'page_data'         => array(
                'data_mahasiswa'    => $this->M_DtMahasiswa->ReadData()
            )
        );
		$this->load->view('template/main', $data);
    }

    function data_tambah(){
        $data = array(
            'page_url'          => 'V_DtMahasiswa_Form',
            'page_information'  => array(
                'page_title'        => $this->page_title,
                'page_position'     => 'Tambah Data'
            )
        );
		$this->load->view('template/main', $data);
    }

    function data_update($id){
        $this->load->model('M_DtMahasiswa');
        $data = array(
            'page_url'          => 'V_DtMahasiswa_Form',
            'page_information'  => array(
                'page_title'        => $this->page_title,
                'page_position'     => 'Tambah Data'
            ),
            'page_data'         => array(
                'data_mahasiswa'    => $this->M_DtMahasiswa->ReadMahasiswa($id)
            )
        );
		$this->load->view('template/main', $data);
    }

    function data_hapus($id){
        $this->load->model('M_DtMahasiswa');
        $status = $this->M_DtMahasiswa->delete($id);

        $this->status($status);
    }


    function proses(){
        $this->load->model('M_DtMahasiswa');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $this->form_validation->set_rules('MahasiswaNIM','NIM','required|is_natural|min_length[10]|max_length[10]|is_unique[m_mahasiswa.MahasiswaNIM]');
		$this->form_validation->set_rules('MahasiswaNama','Nama Lengkap','required');
 
		if($this->form_validation->run() != false){
            $post   = $this->input->post();
            $nim    = $post['MahasiswaNIM'];
            $id     = $post['MahasiswaID'];
            $data   = array(
                'nim'       => $post['MahasiswaNIM'],
                'nama'      => $post['MahasiswaNama'],
                'tahun'     => '20' . substr($nim, 0, 2),
                'jenjang'   => substr($nim, 2, 1),
                'prodi'     => substr($nim, 3, 2),
                'kelas'     => substr($nim, 5, 1),
                'semester'  => substr($nim, 6, 1),
                'nomor'     => substr($nim, 7, 3)
            );
            if($id == ''){
                $status = $this->M_DtMahasiswa->insert($data);
                $this->status($status);
            }else{
                $status = $this->M_DtMahasiswa->update($id, $data);
                $this->status($status);
            }
		}else{
            $data = array(
                'page_url'          => 'V_DtMahasiswa_Form',
                'page_information'  => array(
                    'page_title'        => $this->page_title,
                    'page_position'     => 'Tambah Data'
                )
            );
            $this->load->view('template/main', $data);
        }
    }

    function status($data){
		$this->session->set_flashdata("st_class", $data["st_class"]);
        $this->session->set_flashdata("st_message", $data["st_message"]);
        header("location:".base_url("DtMahasiswa"));
    }

    function laporan(){
        $this->load->model('M_DtMahasiswa');

        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(285,7,'UNIVERSITAS MUHAMMADIYAH SUKABUMI',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(285,7,'DAFTAR SELURUH MAHASISWA',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0, 'C');
        $pdf->Cell(30,6,'NIM',1,0, 'C');
        $pdf->Cell(70,6,'NAMA',1,0, 'C');
        $pdf->Cell(30,6,'TAHUN MASUK',1,0, 'C');
        $pdf->Cell(95,6,'PROGRAM STUDI',1,0, 'C');
        $pdf->Cell(25,6,'KELAS',1,0, 'C');
        $pdf->Cell(20,6,'JENJANG',1,1, 'C');
        $pdf->SetFont('Arial','',10, 'C');
        $mahasiswa = $this->M_DtMahasiswa->ReadData();
        $no = 1;
        foreach ($mahasiswa as $row){
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(30,6,$row->MahasiswaNIM,1,0, 'C');
            $pdf->Cell(70,6,$row->MahasiswaNama,1,0);
            $pdf->Cell(30,6,$row->MahasiswaTahunMasuk,1,0, 'C');
            $pdf->Cell(95,6,$row->ProdiNama,1,0);
            $pdf->Cell(25,6,$row->KelasNama,1,0, 'C');
            $pdf->Cell(20,6,$row->JenjangNama,1,1, 'C');
            $no++;
        }
        $pdf->Output();
    }

}
