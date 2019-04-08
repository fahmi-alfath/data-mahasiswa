<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DtBarang extends MX_Controller {

    public $menu = 'BARANG';

	function index(){
        $this->load->model('M_Main');
        $this->load->model('M_DtBarang');

        $data = array(
            'page_url'          => 'V_DtBarang_Main',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Master Data',
                'page_name'         => 'List Data',
                'page_description'  => 'Data Barang',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'data_barang'      => $this->M_DtBarang->ReadData()
            )
        );
		$this->load->view('template/default', $data);
    }

    function kode(){
        $this->load->model('M_Main');

        $kode   = $this->M_Main->GetCoa($this->menu);
        $num    = sprintf("%04d", $kode->CoaAutoNum);
        $format   = $kode->CoaDocID . $num;

        return $format;
    }

    function kode_update(){
        $this->load->model('M_Main');
        $this->M_Main->UpdateCoa($this->menu);
    }
    
    function data_baru(){
        $this->load->model('M_Main');
        $this->load->model('M_DtBarang');

        $data = array(
            'page_url'          => 'V_DtBarang_Form',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Master Data',
                'page_name'         => 'Tambah Data',
                'page_description'  => 'Data Barang',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'data_satuan'       => $this->M_DtBarang->ReadSatuan(),
                'data_barang'       => $this->M_DtBarang->ReadData()
            )
        );
		$this->load->view('template/default', $data);
    }

    function data_ubah($id){
        $this->load->model('M_Main');
        $this->load->model('M_DtBarang');

        $data = array(
            'page_url'          => 'V_DtBarang_Form',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Master Data',
                'page_name'         => 'Update Data',
                'page_description'  => 'Data Barang',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'data_satuan'       => $this->M_DtBarang->ReadSatuan(),
                'Barang'            => $this->M_DtBarang->ReadBarang($id),
                'data_Barang'       => $this->M_DtBarang->ReadData()
            )
        );
		$this->load->view('template/default', $data);
    }

    function data_hapus($id){
        $this->load->model('M_DtBarang');
        $status = $this->M_DtBarang->delete($id);

		$this->session->set_flashdata("st_class",   $status["st_class"]);
        $this->session->set_flashdata("st_message", $status["st_message"]);
        header("location:".base_url("DtBarang"));
    }

    function data_proses(){
        $this->load->model('M_DtBarang');

        $data               = $this->input->post();
        $data['BarKode']    = $this->kode();
        if($data['BarID'] == ''){
            $status = $this->M_DtBarang->insert($data);
            $this->kode_update();
        }else{
            $status = $this->M_DtBarang->update($data);
        }
        
		$this->session->set_flashdata("st_class",   $status["st_class"]);
        $this->session->set_flashdata("st_message", $status["st_message"]);
        header("location:".base_url("DtBarang"));
    }
}
