<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_TrPembelian extends CI_Model {
    function __construct(){
        $this->load->database();
    }

    function ReadData($filter){
        $this->db->where("TrTanggal BETWEEN '" . $filter['from'] . "' AND '" . $filter['to'] . "'");
        $this->db->order_by("TrDocNo", "DESC");
        $this->db->from("tr_brgmasuk");
        $this->db->join("m_data", "m_data.DataNama = tr_brgmasuk.TrStatus", "LEFT");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadPembeli($id){
        $this->db->where("PemID", $id);
        $this->db->from("m_pembeli");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }

    function ReadPembelian($id){
        $this->db->where("TrDocNo", $id);
        $this->db->from("tr_brgmasuk");
        $this->db->join("m_data", "m_data.DataNama = tr_brgmasuk.TrStatus", "LEFT");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }

    function ReadPembelianBarang($id){
        $this->db->where("TrDetDoc", $id);
        $this->db->from("tr_brgmasuk_detail");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function insert($data){
        $field = array(
            "TrDocNo" => $data["TrDocNo"],
            "TrTanggal" => $data["TrTanggal"],
            "TrSupID" => $data["TrSupID"],
            "TrSupNama" => $data["TrSupNama"],
            "TrStatus" => $data["TrStatus"]
        );

        if(!$this->db->insert("tr_brgmasuk",$field)){
            $status = array(
                "st_class" => "danger",
                "st_message" => "Data Gagal Disimpan"
            );
        }else{
            $status = array(
                "st_class" => "success",
                "st_message" => "Data Berhasil Disimpan"
            );
        }
        return $status;
    }

    function update($data){
        $field = array(
            "PemNama" => $data["PemNama"],
            "PemAlamat" => $data["PemAlamat"],
            "PemTelp" => $data["PemTelp"]
        );

        $this->db->where("PemID", $data["PemID"]);
        if(!$this->db->update("m_pembeli",$field)){
            $status = array(
                "st_class" => "danger",
                "st_message" => "Data Gagal Diubah"
            );
        }else{
            $status = array(
                "st_class" => "success",
                "st_message" => "Data Berhasil Diubah"
            );
        }
        return $status;
    }

    function delete($id){
        $this->db->where("PemID", $id);
        if(!$this->db->delete("m_pembeli")){
            $status = array(
                "st_class" => "danger",
                "st_message" => "Data Gagal Dihapus"
            );
        }else{
            $status = array(
                "st_class" => "success",
                "st_message" => "Data Berhasil Dihapus"
            );
        }
        return $status;
    }


    function insert_barang($data, $doc){
        $field = array(
            "TrDetDoc" => $doc,
            "TrDetTanggal" => Date("Y-m-d"),
            "TrDetBarID" => $data->BarKode,
            "TrDetBarNama" => $data->BarNama,
            "TrDetBarJumlah" => "1",
            "TrDetBarTotal" => $data->BarHarga
        );
        if(!$this->db->insert("tr_brgmasuk_detail",$field)){
            $status = array(
                "st_class" => "danger",
                "st_message" => "Data Gagal Diproses"
            );
        }else{
            $status = array(
                "st_class" => "success",
                "st_message" => "Data Berhasil Diproses. Silahkan Lanjutkan Transaksi"
            );
            //$this->update_total($doc, $data->BarHarga);
        }
        return $status;
    }

    function update_barang($doc, $barang, $qty){
        $total = ($qty)*$barang->BarHarga;

        $this->db->set("TrDetBarJumlah",$qty);
        $this->db->set("TrDetBarTotal",$total);
        $this->db->where("TrDetID", $doc[1]);
        if(!$this->db->update("tr_brgmasuk_detail")){
            print_r($this->db->error());
        }else{
            return $total;
        }
    }

    function update_total($doc, $total){
        $this->db->set("TrTotal",$total);
        //$this->db->set("TrTotal",$total, FALSE);
        $this->db->where("TrDocNo", $doc);
        if(!$this->db->update("tr_brgmasuk")){
            print_r($this->db->error());
        }else{
            "sukses";
        }
    }

    function hapus_barang($barang_id, $doc){
        $this->db->where("TrDetDoc", $doc);
        $this->db->where("TrDetID", $barang_id);
        if(!$this->db->delete("tr_brgmasuk_detail")){
            $status = array(
                "st_class" => "danger",
                "st_message" => "Data Gagal Diproses"
            );
        }else{
            $status = array(
                "st_class" => "success",
                "st_message" => "Data Berhasil Diproses. Silahkan Lanjutkan Transaksi"
            );
        }
        return $status;
    }
}
