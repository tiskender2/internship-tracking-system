<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru_Model extends CI_Model{


	public function duyuru_Getir(){
		/*$this->db->select("d.id , d.baslik , d.icerik , DATE_FORMAT(d.tarih,'%d-%m-%Y') as tarih , d.dosya , a.ad_soyad , a.akademisyen_no as a_no");
		$this->db->from('tbl_duyurular as d');
		$this->db->join('tbl_akademisyen as a','d.akademisyen_no=a.akademisyen_no','left');
		$result = $this->db->get("tbl_duyurular")->result();
		return $result;*/
		$query = $this->db->query("SELECT d.id , d.baslik , d.icerik , DATE_FORMAT(d.tarih,'%d-%m-%Y') as tarih , d.dosya , a.ad_soyad , a.akademisyen_no as a_no FROM tbl_duyurular d JOIN tbl_akademisyen a ON d.akademisyen_no=a.akademisyen_no");
		return $query->result();
	}
	
	public function dis_duyuru_Getir(){
		
		$query = $this->db->query("SELECT d.id , d.baslik , d.icerik , DATE_FORMAT(d.tarih,'%d-%m-%Y') as tarih , d.dosya , a.ad_soyad , a.akademisyen_no as a_no FROM tbl_duyurular d JOIN tbl_akademisyen a ON d.akademisyen_no=a.akademisyen_no Limit 5");
		return $query->result();
	}
	/*
	
SELECT d.id , d.baslik , d.icerik , DATE_FORMAT(d.tarih,'%d-%m-%Y') as tarih , d.dosya , a.ad_soyad , a.akademisyen_no as a_no FROM tbl_duyurular d JOIN tbl_akademisyen a ON d.akademisyen_no=a.akademisyen_no
	*/

	public function duyuru_Sil($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_duyurular');
		}



	public function duyuru_Ekle($data){
		$this->db->insert('tbl_duyurular',$data);
	}



	public function duyuru_Guncelle($id,$data){
		$this->db->where('id', $id);
		$this->db->update('tbl_duyurular',$data);
	}

	public function idye_göre_duyuru_Getir($id){
	$result = $this->db->get_where("tbl_duyurular",array('id' => $id))->result();
	return $result;
	}
	public function denetmene_göre_duyuru_Getir($a_no){
	$query = $this->db->query("SELECT d.id , d.baslik , d.icerik , DATE_FORMAT(d.tarih,'%d-%m-%Y') as tarih , d.dosya , a.ad_soyad , a.akademisyen_no as a_no FROM tbl_duyurular d JOIN tbl_akademisyen a ON d.akademisyen_no=a.akademisyen_no where a.akademisyen_no=".$a_no);
		return $query->result();
	}
	
	public function anasayfa_duyuru($id){
		$query=$this->db->query('SELECT * FROM `tbl_duyurular` join tbl_akademisyen on 
		tbl_akademisyen.akademisyen_no=tbl_duyurular.akademisyen_no where id='.$id.'');
		return $query->result();
	}

}




?>