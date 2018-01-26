<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ogrenci_Model extends CI_Model{

	public function rapor_dosyalari_update($no,$data){
		$this->db->where('ogrenci_no', $no);
		$this->db->update('tbl_stajbilgileri',$data);
	}
	
	public function ogr_noya_gore_stajbilgileri_getir($no){
		$result=$this->db->query('select * from tbl_stajbilgileri tbls JOIN tbl_ogrenciler tblo ON tbls.ogrenci_no=tblo.ogrenci_no where tblo.ogrenci_no='.$no.'');
		return $result->result();
	}
	public function idye_ogr_getir($ogr_no){
		$result=$this->db->query('SELECT * FROM `tbl_ogrenciler` WHERE ogrenci_no = '.$ogr_no.'');
		return $result->result();
	}
	public function mail_getir($no){
		$query=$this->db->query("SELECT akademisyen_no FROM `tbl_ogrenciler` WHERE ogrenci_no=".$no."")->result();
		foreach($query as $row){
			$akademisyen_no=$row->akademisyen_no;
		}
		$result=$this->db->query('SELECT email FROM `tbl_kullanicilar` WHERE no = '.$akademisyen_no.'');
		return $result->result();
	}
	public function ogrenci_mail_getir($no){
		$result=$this->db->query('SELECT email FROM `tbl_kullanicilar` WHERE no = '.$no.'');
		return $result->result();
	}
	public function idye_göre_dosya_Getir($no){
		$result=$this->db->query("SELECT * FROM tbl_stajbilgileri where ogrenci_no=".$no."");
		return $result->result();
	}
	public function biten_staj_sayisi($no){
		$result=$this->db->query("SELECT * FROM tbl_bitenstaj where ogrenci_no=".$no."");
		if($result->num_rows() > 0){
			return TRUE;
		}
		 else return FALSE;
	}
	public function biten_stajlar($no)
	{

			$result=$this->db->query("SELECT tbl_bitenstaj.baslama_tarih,tbl_bitenstaj.bitis_tarih , tbl_bitenstaj.staj_gun , tbl_bitenstaj.kabul_gun , tbl_stajyeri.stajyeri_ad FROM `tbl_bitenstaj`  INNER JOIN tbl_stajyeri on tbl_stajyeri.id=tbl_bitenstaj.stajyeri_id where tbl_bitenstaj.ogrenci_no =".$no);
			return $result->result();
	}
	
}
?>