<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DtMahasiswa extends CI_Model {
    function __construct(){
        $this->load->database();
    }

    function ReadData(){
        $this->db->from("m_mahasiswa");
        $this->db->join("m_prodi","m_prodi.ProdiKode = m_mahasiswa.MahasiswaProdi", "LEFT");
        $this->db->join("m_kode_kelas", "m_kode_kelas.KelasKode = m_mahasiswa.MahasiswaKelas", "LEFT");
        $this->db->join("m_jenjang", "m_jenjang.JenjangKode = m_mahasiswa.Mahasiswajenjang", "LEFT");
        $this->db->order_by("MahasiswaID", "DESC");
        $table  = $this->db->get();
        $row    = $table->result();

        return $row;
    }

    function ReadMahasiswa($id){
        $this->db->where("MahasiswaID", $id);
        $this->db->from("m_mahasiswa");
        $table  = $this->db->get();
        $row    = $table->row();

        return $row;
    }

    function insert($data){
        $field = array(
            "MahasiswaNIM"          => $data["nim"],
            "MahasiswaNama"         => $data["nama"],
            "MahasiswaTahunMasuk"   => $data["tahun"],
            "MahasiswaProdi"        => $data["prodi"],
            "MahasiswaKelas"        => $data["kelas"],
            "MahasiswaJenjang"      => $data["jenjang"]
        );

        if(!$this->db->insert("m_mahasiswa", $field)){
            $status = array(
                "st_class"      => "danger",
                "st_message"    => "Data Gagal Disimpan"
            );
        }else{
            $status = array(
                "st_class"      => "success",
                "st_message"    => "Data Berhasil Disimpan"
            );
        }
        return $status;
    }

    function update($id, $data){
        $field = array(
            "MahasiswaNIM"          => $data["nim"],
            "MahasiswaNama"         => $data["nama"],
            "MahasiswaTahunMasuk"   => $data["tahun"],
            "MahasiswaProdi"        => $data["prodi"],
            "MahasiswaKelas"        => $data["kelas"],
            "MahasiswaJenjang"      => $data["jenjang"]
        );
        $this->db->where("MahasiswaID", $id);
        if(!$this->db->update("m_mahasiswa", $field)){
            $status = array(
                "st_class"      => "danger",
                "st_message"    => "Data Gagal Disimpan"
            );
        }else{
            $status = array(
                "st_class"      => "success",
                "st_message"    => "Data Berhasil Disimpan"
            );
        }
        return $status;
    }

    function delete($id){
        $this->db->where("MahasiswaID", $id);
        if(!$this->db->delete("m_mahasiswa")){
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
