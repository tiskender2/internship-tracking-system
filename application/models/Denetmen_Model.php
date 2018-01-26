<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denetmen_Model extends CI_Model{
	
	public function ogrenci_getir(){
		$query=$this->db->query('SELECT tblo.ogrenci_no,tblo.ad_soyad,tblo.kalan_gun,tblo.telefon,tblo.giris_yili,tblk.email FROM 
		tbl_ogrenciler tblo LEFT JOIN tbl_akademisyen tbla ON tblo.akademisyen_no=tbla.akademisyen_no
		JOIN tbl_kullanicilar tblk ON tblk.no=tblo.ogrenci_no where tbla.akademisyen_no='.$this->session->no.'');
		return $query->result();
	}
	public function islemleri_bitmis_ogrenci($bolum)
	{
		$query=$this->db->query("SELECT tbl_stajbilgileri.kabul_gun,tbl_ogrenciler.ogrenci_no,tbl_ogrenciler.ad_soyad,tbl_stajyeri.stajyeri_ad,tbl_stajbilgileri.staj_defteri,tbl_akademisyen.akademisyen_no,
		tbl_stajbilgileri.anketform,tbl_stajbilgileri.staj_gun, tbl_ogrenciler.kalan_gun FROM `tbl_stajbilgileri` join 
		tbl_ogrenciler on tbl_ogrenciler.ogrenci_no=tbl_stajbilgileri.ogrenci_no join tbl_akademisyen on
		tbl_akademisyen.akademisyen_no=tbl_ogrenciler.akademisyen_no  join tbl_bolum on tbl_bolum.id=tbl_akademisyen.bolum_id INNER JOIN tbl_stajyeri on 
		tbl_stajyeri.id = tbl_stajbilgileri.stajyeri_id where tbl_stajbilgileri.gun_girisi_yapildi=0 and 
		tbl_akademisyen.bolum_id='".$bolum."'");
		return $query->result();
	}

	public function kabul_gun_update($no,$data){
		$this->db->query('UPDATE tbl_stajbilgileri SET kabul_gun='.$data.' where ogrenci_no='.$no.'');
	}
	public function ogrenciler_tablosundan_update($no,$data){
		$this->db->query('UPDATE tbl_ogrenciler SET kalan_gun='.$data.' where ogrenci_no='.$no.'');
	}
	public function tbl_stajbilgileri_update($no){
		$this->db->query('UPDATE tbl_stajbilgileri SET gun_girisi_yapildi=1 where ogrenci_no='.$no.'');
	}

	
}