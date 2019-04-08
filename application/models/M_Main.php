<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Main extends CI_Model {
    function __construct(){
        $this->load->database();
    }
    
    function ReadMenu(){
        $this->db->from("cp_menu");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadMenu1(){
        $user = $this->session->userdata('UserGroupID');

        $query = "
        SELECT
            '".$user."' AS AccUserGroupID,
            MenuID,
            MenuName,
            MenuHead,
            MenuURL,
            MenuParent,
            MenuChild,
            MenuStatus,
            MenuIcon,
            '1' AS AccRead,
            '1' AS AccCRUD
        FROM cp_menu
        WHERE MenuParent = '0'
        UNION
        SELECT  
            AccUserGroupID, 
            AccMenuID, 
            MenuName,
            MenuHead,
            MenuURL,
            MenuParent,
            MenuChild,
            MenuStatus,
            MenuIcon,
            AccRead, 
            AccCRUD 
        FROM cp_menuaccess
        LEFT JOIN cp_menu ON cp_menu.MenuID = cp_menuaccess.AccMenuID
        WHERE AccUserGroupID = '".$user."'";
        $table = $this->db->query($query);

        $count = $table->num_rows();
        $row = $table->result_array();
        return $row;
    }

    function ReadActive($name){
        $this->db->where("MenuURL", $name);
        $this->db->from("cp_menu");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result_array();
        return $row[0];
    }

    function GetCoa($name){
        $this->db->where("CoaTipe", $name);
        $this->db->from("cp_coa");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }

    function UpdateCoa($name){
        $this->db->set('CoaAutoNum', 'CoaAutoNum+1', FALSE);
        $this->db->where("CoaTipe", $name);
        if(!$this->db->update("cp_coa")){
            print_r($this->db->error());
        }else{
            "sukses";
        }
    }

    function GetMonth(){
        $month = date("m");
        $this->db->where("BulanNum", $month);
        $this->db->from("cp_bulan");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }

    function ReadPembeli(){
        $this->load->database();
        $this->db->from("m_pembeli");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadSupplier(){
        $this->load->database();
        $this->db->from("m_supplier");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function ReadBarang(){
        $this->load->database();
        $this->db->from("m_barang");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->result();
        return $row;
    }

    function GetBarang($id){
        $this->load->database();
        $this->db->where("BarKode", $id);
        $this->db->from("m_barang");
        $table = $this->db->get();

        $count = $table->num_rows();
        $row = $table->row();
        return $row;
    }
}
