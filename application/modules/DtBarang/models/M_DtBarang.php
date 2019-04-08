<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DtBarang extends CI_Model {
    function __construct(){
        $this->load->database();
    }

    function ReadData(){
        $this->db->from("m_barang");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadSatuan(){
        $this->db->where("DataTipe", "SATUAN");
        $this->db->from("m_data");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadBarang($id){
        $this->db->where("BarID", $id);
        $this->db->from("m_barang");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }

    function insert($data){
        $field = array(
            "BarKode" => $data["BarKode"],
            "BarNama" => $data["BarNama"],
            "BarSatuan" => $data["BarSatuan"],
            "BarHarga" => $data["BarHarga"]
        );

        if(!$this->db->insert("m_barang",$field)){
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
            "BarKode" => $data["BarKode"],
            "BarNama" => $data["BarNama"],
            "BarSatuan" => $data["BarSatuan"],
            "BarHarga" => $data["BarHarga"]
        );

        $this->db->where("BarID", $data["BarID"]);
        if(!$this->db->update("m_barang",$field)){
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
        $this->db->where("BarID", $id);
        if(!$this->db->delete("m_barang")){
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
}
