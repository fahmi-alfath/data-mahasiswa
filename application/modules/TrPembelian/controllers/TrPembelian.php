<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrPembelian extends MX_Controller {

    public $menu = 'PEMBELIAN';

	function index(){
        if($this->input->get('from') == ''){
            $filter = array(
                'from'  => Date('Y-m-d'),
                'to'    => Date('Y-m-d')
            );
        }else{
            $filter = array(
                'from'  => $this->input->get('from'),
                'to'    => $this->input->get('to')
            );
        }

        $this->load->model('M_Main');
        $this->load->model('M_TrPembelian');

        $data = array(
            'page_url'          => 'V_TrPembelian_Main',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Transaksi',
                'page_name'         => 'List Data',
                'page_description'  => 'Data Pembelian',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'data_pembelian'    => $this->M_TrPembelian->ReadData($filter),
                'filter_from'       => $filter['from'],
                'filter_to'         => $filter['to']
            )
        );
		$this->load->view('template/default', $data);
    }

    function kode(){
        $this->load->model('M_Main');

        $month      = $this->M_Main->GetMonth();
        $kode       = $this->M_Main->GetCoa($this->menu);
        $num        = sprintf("%04d", $kode->CoaAutoNum);
        $format     = Date('Y') . '/' . $month->BulanRomawi . '/' . $kode->CoaDocID . '/' . $num;

        return $format;
    }

    function kode_update(){
        $this->load->model('M_Main');
        $this->M_Main->UpdateCoa($this->menu);
    }
    
    function data_baru(){
        $this->load->model('M_Main');
        $this->load->model('M_TrPembelian');

		$doc = $this->input->get("TrDocNo");

		if(!empty($doc)){
			$data_pembelian         = $this->M_TrPembelian->ReadPembelian($doc);
			$data_pembelian_detail  = $this->M_TrPembelian->ReadPembelianBarang($doc);
		}else{
			$data_pembelian = array();
			$data_pembelian_detail = array();
		}

        $data = array(
            'page_url'          => 'V_TrPembelian_Form',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Transaksi',
                'page_name'         => 'Tambah Data',
                'page_description'  => 'Transaksi Pembelian',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'data_supplier'         => $this->M_Main->ReadSupplier(),
                'data_barang'           => $this->M_Main->ReadBarang(),
                'data_pembelian'        => $data_pembelian,
                'data_pembelian_detail' => $data_pembelian_detail
            )
        );
		$this->load->view('template/default', $data);
    }

    function data_ubah($id){
        $this->load->model('M_Main');
        $this->load->model('M_TrPembelian');

        $data = array(
            'page_url'          => 'V_TrPembelian_Form',
            'page_menu'         => $this->M_Main->ReadMenu(),
            'page_information'  => array(
                'page_location'     => 'Master Data',
                'page_name'         => 'Update Data',
                'page_description'  => 'Data Pembeli',
                'page_icon'         => ''
            ),
            'page_data'         => array(
                'pembeli'           => $this->M_TrPembelian->ReadPembeli($id),
                'data_pembeli'      => $this->M_TrPembelian->ReadData()
            )
        );
		$this->load->view('template/default', $data);
    }

    function data_hapus($id){
        $this->load->model('M_TrPembelian');
        $status = $this->M_TrPembelian->delete($id);

		$this->session->set_flashdata("st_class", $status["st_class"]);
        $this->session->set_flashdata("st_message", $status["st_message"]);
        header("location:".base_url("TrPembelian"));
    }

    function data_proses(){
        $this->load->model('M_TrPembelian');

        $data = $this->input->post();
		if(empty($data["TrID"])){
			$supplier = explode("-", $data["DataSupplier"]);
			$data = array(
				"TrDocNo"       => $this->kode(),
				"TrTanggal"     => $data["TrTanggal"],
				"TrSupID"       => $supplier[0],
				"TrSupNama"     => $supplier[1],
				"TrStatus"      => "0"
			);
			$status = $this->M_TrPembelian->insert($data);
			if($status["st_class"] == "success"){
				$this->kode_update();
            }
        }
        
		$this->session->set_flashdata("st_class", $status["st_class"]);
        $this->session->set_flashdata("st_message", $status["st_message"]);
        header("location:".base_url("TrPembelian/data_baru?TrDocNo=".$data["TrDocNo"]));
    }

    function data_status(){
        $data = $this->input->get();
        print_r($data);
    }

    function barang_tambah(){
        $this->load->model("M_Main");
        $this->load->model("M_TrPembelian");

        $data       = $this->input->get();
		$barang     = $this->M_Main->GetBarang($data["BarID"]);
		$status     = $this->M_TrPembelian->insert_barang($barang, $data["TrDocNo"]);
		
		header("location:".base_url("TrPembelian/data_baru?TrDocNo=".$data["TrDocNo"]));
    }

    function barang_update(){
        $this->load->model("M_Main");
        $this->load->model("M_TrPembelian");

		$data   = $this->input->post();
		$docno  = $this->input->get("TrDocNo");

		// $no = 1;
		$key    = array_keys($data);
		$jml    = count($data);
		$total  = 0;

		for($i = 1;$i<$jml;$i++){
			$cek        = explode("|",$key[$i]);
			$barang_id  = explode("-",$cek[0]);
			$doc        = explode("-",$cek[1]);
			$qty        = $data[$key[$i]];

			$barang     = $this->M_Main->GetBarang($barang_id[1]);
            $return     = $this->M_TrPembelian->update_barang($doc, $barang, $qty);
            
			$total      = $total+$return;
        }
        $this->M_TrPembelian->update_total($docno, $total);
        header("location:".base_url("TrPembelian/data_baru?TrDocNo=".$docno));
    }

	function barang_hapus(){
        $this->load->model("M_Main");
        $this->load->model("M_TrPembelian");

        $data       = $this->input->get();
		$status     = $this->M_TrPembelian->hapus_barang($data["TrDetID"], $data["TrDocNo"]);
		
		header("location:".base_url("TrPembelian/data_baru?TrDocNo=".$data["TrDocNo"]));
	}
}
