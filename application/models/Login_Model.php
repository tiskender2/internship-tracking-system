<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model{
 
	public function login_Db_Control($email,$sifre){
		$this->db->select('u.unvan,k.loginType,k.resim,o.ad_soyad as o_ad_soyad,a.ad_soyad as a_ad_soyad ,o.bolum_id as o_bolum_id ,a.bolum_id as a_bolum_id ,a.akademisyen_no as a_no , o.ogrenci_no as o_no');
		$this->db->from('tbl_kullanicilar k');
		$this->db->join('tbl_akademisyen a','a.akademisyen_no=k.no','left');
		$this->db->join('tbl_ogrenciler o','o.ogrenci_no=k.no','left');
		$this->db->join('tbl_unvan u','u.id=k.unvan','left');
		$this->db->where('k.email',$email);
		$this->db->where('k.sifre',$sifre);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}
		else return FALSE;
	}
	public function kayit_durum_getir($email,$sifre){
		$query=$this->db->query('select kayit_durum,tbl_kullanicilar.loginType from tbl_ogrenciler join tbl_kullanicilar on tbl_ogrenciler.ogrenci_no=tbl_kullanicilar.no where email="'.$email.'" and sifre="'.$sifre.'"');
		return $query->result();
	}
	public function logintip($email,$sifre){
		$query=$this->db->query('select loginType from tbl_kullanicilar where email="'.$email.'" and sifre="'.$sifre.'"');
		return $query->result();
	}
	
	public function bolum_getir(){
		$query=$this->db->query("select * from tbl_bolum");
		return $query->result();
	}

	
	public function ogrenci_tablosuna_yukle($data){
		$this->db->insert('tbl_ogrenciler',$data);
	}
	
	public function kullanicilar_tablusona_yukle($data){
		$this->db->insert('tbl_kullanicilar',$data);
	}
	public function email_Kontrol($email){
		$query=$this->db->query("SELECT * FROM `tbl_kullanicilar` WHERE email ='".$email."' ");
		 if ($query->num_rows() != "0")
		 {
			 return TRUE;
		 }
		 else
		 {
			 return FALSE;
		 }
	}
	public function no_getir($email){
		$query=$this->db->query("SELECT * FROM `tbl_kullanicilar` WHERE email ='".$email."' ");
		return $query->result();
	}
	public function sifre_guncelle($id,$data){
		$this->db->where('no', $id);
		$this->db->update('tbl_kullanicilar',$data);
	}
	public function ogrno_kontrol($ogr_no){
		$query=$this->db->query("SELECT * FROM `tbl_kullanicilar` WHERE no ='".$ogr_no."' ");
		return $query->result();
	}
	public function ogrno_kontrol_tblogr($ogr_no){
		$query=$this->db->query("SELECT * FROM `tbl_ogrenciler` WHERE ogrenci_no='".$ogr_no."' ");
		return $query->result();
	}
	



}
/*
SELECT k.unvan,k.loginType,k.resim,o.ad_soyad as o_ad_soyad,a.ad_soyad as a_ad_soyad , a.akademisyen_no as a_no , o.ogrenci_no as o_no' FROM tbl_kullanicilar k 
LEFT JOIN tbl_akademisyen a ON a.akademisyen_no=k.no LEFT JOIN tbl_ogrenciler o ON o.ogrenci_no=k.no WHERE k.email='yigitbahcekapili@gmail.com' and k.sifre='y123'
*/