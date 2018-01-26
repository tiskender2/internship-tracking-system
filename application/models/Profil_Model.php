<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_Model extends CI_Model{
	
	
	public function profil_ekle($data){
		$this->db->insert('tbl_kimlikbilgileri',$data);
	}
	
	public function akademisyen_bilgi_getir($no){
		$query = $this->db->query("SELECT * FROM tbl_akademisyen join tbl_bolum on tbl_akademisyen.bolum_id=tbl_bolum.id JOIN tbl_kullanicilar ON tbl_akademisyen.akademisyen_no=tbl_kullanicilar.no WHERE tbl_kullanicilar.no=".$no);
		return $query->result();
	}
	
	public function ogrenci_bilgi_getir($no){
		$query = $this->db->query("SELECT * from tbl_ogrenciler INNER JOIN tbl_derssorumlusu on tbl_ogrenciler.akademisyen_no=tbl_derssorumlusu.no inner join tbl_kullanicilar on tbl_kullanicilar.no=tbl_ogrenciler.ogrenci_no 
		INNER join tbl_bolum on tbl_bolum.id=tbl_ogrenciler.bolum_id where tbl_ogrenciler.ogrenci_no=".$no);
		return $query->result();
	}
	public function ogrenci_bilgi_getir2($no){
		$query = $this->db->query("SELECT * from tbl_ogrenciler inner join tbl_kullanicilar on tbl_kullanicilar.no=tbl_ogrenciler.ogrenci_no INNER join tbl_bolum on tbl_bolum.id=tbl_ogrenciler.bolum_id where tbl_ogrenciler.ogrenci_no=".$no);
		return $query->result();
	}
	public function profil_tipi($no){
		$query = $this->db->query("SELECT * FROM `tbl_kullanicilar` WHERE  no=".$no);
		return $query->result();
	}
		public function tc_varmi($no){
		$query = $this->db->query("SELECT * FROM `tbl_kimlikbilgileri` WHERE  tc_no=".$no);
		if($query->num_rows() > 0){
			return TRUE;
		}
			else return FALSE;
	}
	
	
	
	public function profil_varmi($no){
		$this->db->select('*');
		$this->db->from('tbl_kimlikbilgileri');
		$this->db->where('ogrenci_no',$no);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return TRUE;
		}
			else return FALSE;
	}
		public function profil_Guncelle($id,$data){
		$this->db->where('ogrenci_no', $id);
		$this->db->update('tbl_kimlikbilgileri',$data);
	}
		public function profil_Guncelle_resim($id,$data){
		$this->db->where('no', $id);
		$this->db->update('tbl_kullanicilar',$data);
	}
	
	public function ogrenci_akademisyen_getir($no,$bolum){
		$query = $this->db->query("select tbl_ogrenciler.akademisyen_no from tbl_ogrenciler join tbl_bolum on tbl_bolum.id=tbl_ogrenciler.bolum_id where tbl_ogrenciler.ogrenci_no=".$no." and tbl_bolum.id=".$bolum."");
		return $query->result();
	}
	
	
	
	
	public function profil_Getir($no,$bolum){
		$query2 = $this->db->query("SELECT * FROM tbl_ogrenciler o INNER JOIN tbl_derssorumlusu ON o.akademisyen_no=tbl_derssorumlusu.no INNER JOIN tbl_kimlikbilgileri k ON o.ogrenci_no=k.ogrenci_no INNER JOIN tbl_bolum b ON o.bolum_id=b.id INNER JOIN tbl_kullanicilar ku ON o.ogrenci_no=ku.no  WHERE o.ogrenci_no=".$no);
		return $query2->result();
	}
	public function profil_Getir2($no){
		 
		$query = $this->db->query("SELECT o.ogrenci_no,o.akademisyen_no,ku.email,b.bolum_adi,o.kalan_gun,o.adres,k.tc_no,
		k.nc_seriNo,k.baba_ad,k.ana_ad,k.dogum_yeri,k.dogum_tarihi,k.il,k.ilce,k.mahalle,k.cilt_no,k.ailesira_no,k.sira_no,
		k.verildigi_yer,k.verildigi_tarih,k.verilis_nedeni FROM tbl_ogrenciler o INNER JOIN tbl_kimlikbilgileri k ON
		o.ogrenci_no=k.ogrenci_no INNER JOIN 
		tbl_bolum b ON o.bolum_id=b.id INNER JOIN tbl_kullanicilar ku ON o.ogrenci_no=ku.no  WHERE o.ogrenci_no=".$no);
		return $query->result();
	}
	public function derssorumlusu_getir($no){
		 
		$query = $this->db->query("SELECT * FROM tbl_ogrenciler o INNER JOIN tbl_akademisyen ON o.akademisyen_no=tbl_akademisyen.akademisyen_no INNER JOIN tbl_kimlikbilgileri k ON o.ogrenci_no=k.ogrenci_no INNER JOIN tbl_bolum b ON o.bolum_id=b.id INNER JOIN tbl_kullanicilar ku ON o.ogrenci_no=ku.no WHERE o.ogrenci_no=".$no);
		return $query->result();
	}
	public function derssorumlusu_varmi2($no){
		 
		$query = $this->db->query("SELECT * FROM tbl_ogrenciler o INNER JOIN tbl_akademisyen ON o.akademisyen_no=tbl_akademisyen.akademisyen_no INNER JOIN tbl_kimlikbilgileri k ON o.ogrenci_no=k.ogrenci_no INNER JOIN tbl_bolum b ON o.bolum_id=b.id INNER JOIN tbl_kullanicilar ku ON o.ogrenci_no=ku.no WHERE o.ogrenci_no=".$no);
		if($query->num_rows() > 0){
			return TRUE;
		}
		else return FALSE;
	}
	
	public function sifre_degis($no,$sifre){
	    $this->db->query('UPDATE tbl_kullanicilar SET sifre="'.$sifre.'" WHERE no="'.$no.'"');

	}
	
	  
	
	
}




?>