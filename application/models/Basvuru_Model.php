<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basvuru_Model extends CI_Model{

	public function basvuru_yap($data){
		$this->db->insert('tbl_stajbilgileri',$data);
		//return $this->db->result();
	}
	public function basvurularım($ogrenci_id){ 
	$result = $this->db->query('SELECT tbl_stajbilgileri.id idim ,ogrenci_no,tbl_stajbilgileri.stajyeri_id,
	tbl_stajbilgileri.basvuruform,tbl_stajbilgileri.anketform,	tbl_stajbilgileri.basvuru_tarihi,tbl_stajbilgileri.onaylanma_tarihi,
	tbl_stajbilgileri.staj_gun,tbl_stajbilgileri.kabul_gun,`baslama_tarihi`,`bitis_tarihi`,`staj_defteri`,
	`staj_durum` , tbl_stajyeri.id idim2,`stajyeri_faaliyetAlan`,`stajyeri_ad`,`stajyeri_mail`,`stajyeri_telefon`,`stajyeri_fax`,
	`stajyeri_adres`,`stajyeri_website`,`yetkili_adsoyad`,`yetkili_unvan`,`yetkili_mail`,`durum`FROM `tbl_stajbilgileri` 
	INNER JOIN tbl_stajyeri on tbl_stajbilgileri.stajyeri_id=tbl_stajyeri.id where ogrenci_no ='.$ogrenci_id.'')->result();
		return $result;
	}
	public function kabulgungetir($no){
		$result = $this->db->query('SELECT * FROM tbl_ogrenciler where ogrenci_no='.$no.'')->result();
		return $result;
	}

	
	 public function idye_göre_basvuru_Getir($id)
	 {
		$result = $this->db->query('SELECT * FROM tbl_stajbilgileri x LEFT JOIN tbl_stajyeri y on x.stajyeri_id=y.id where x.id='.$id.'')->result();
		return $result;
	 }
	  public function stajbasvuru_Guncelle($id)
	 {
		$result = $this->db->query('SELECT * FROM tbl_stajbilgileri x LEFT JOIN tbl_stajyeri y on x.stajyeri_id=y.id where x.id='.$id.'')->result();
		return $result;
	 }
	 public function ogrnobasvuruindir($no){
		$result = $this->db->query('select * from tbl_stajbilgileri where ogrenci_no='.$no.'');
		return $result->result();
	 }
	 
	 public function stajbilgileri_Guncelle($id,$data){
		$this->db->where('id', $id); 
		$this->db->update('tbl_stajbilgileri',$data);
	 }
	  public function stajbilgileri_Guncelle2($id,$data2){
		$this->db->where('stajyeri_id', $id); 
		$this->db->update('tbl_stajbilgileri',$data2);
	 }
	 public function sirketbilgileri_Guncelle($id,$data){
		$this->db->where('id', $id); 
		$this->db->update('tbl_stajyeri',$data);
	 }
	  public function basvuru_iptalet($id,$id2)
	  {
		  if ($id2 != '0')
		  {
			   $this->db->query('DELETE FROM `tbl_stajyeri` WHERE id='.$id2.'');
			   $this->db->query('DELETE FROM `tbl_stajbilgileri` WHERE id='.$id.'');
		  }
		  else
		  {
			  $this->db->query('DELETE FROM `tbl_stajbilgileri` WHERE id='.$id.'');
		  }
	  }


	 public function tum_basvurular($id,$bolum)
	 {
		$result = $this->db->query('SELECT ogr.ogrenci_no,ogr.ad_soyad,sbilgi.id sbilgi_id,sbilgi.baslama_tarihi,
		sbilgi.bitis_tarihi,sbilgi.staj_durum,sbilgi.staj_gun,syeri.stajyeri_ad,syeri.stajyeri_faaliyetAlan,syeri.id, 
		syeri.stajyeri_mail,syeri.stajyeri_telefon,syeri.stajyeri_fax,syeri.stajyeri_adres,syeri.stajyeri_website,
		syeri.yetkili_adsoyad,syeri.yetkili_unvan,syeri.yetkili_mail,syeri.durum FROM tbl_stajbilgileri sbilgi INNER JOIN
		tbl_stajyeri syeri on sbilgi.stajyeri_id=syeri.id INNER JOIN tbl_ogrenciler ogr on ogr.ogrenci_no = sbilgi.ogrenci_no
		join tbl_bolum on tbl_bolum.id=ogr.bolum_id where sbilgi.staj_durum = 0 and bolum_id='.$bolum)->result();
		return $result;
	 } 
	 public function onaylanmis_basvurular($bolum)
	 {
		$result = $this->db->query('SELECT ogr.ogrenci_no,ogr.ad_soyad,sbilgi.id sbilgi_id,sbilgi.baslama_tarihi,sbilgi.bitis_tarihi,sbilgi.staj_durum,sbilgi.staj_gun,syeri.stajyeri_ad,syeri.stajyeri_faaliyetAlan,syeri.id,
		syeri.stajyeri_mail,syeri.stajyeri_telefon,syeri.stajyeri_fax,syeri.stajyeri_adres,syeri.stajyeri_website,syeri.yetkili_adsoyad,syeri.yetkili_unvan,syeri.yetkili_mail,syeri.durum
		FROM tbl_stajbilgileri sbilgi INNER JOIN tbl_stajyeri syeri on sbilgi.stajyeri_id=syeri.id 
		INNER JOIN tbl_ogrenciler ogr on ogr.ogrenci_no = sbilgi.ogrenci_no join tbl_bolum on ogr.bolum_id=tbl_bolum.id 
		where staj_durum=1 and ogr.bolum_id="'.$bolum.'"')->result();
		return $result;
	 } 
	 public function reddedilmis_basvurular($bolum)
	 {
		$result = $this->db->query('SELECT ogr.ogrenci_no,ogr.ad_soyad,sbilgi.id sbilgi_id,sbilgi.baslama_tarihi,sbilgi.bitis_tarihi,sbilgi.staj_durum,sbilgi.staj_gun,syeri.stajyeri_ad,syeri.stajyeri_faaliyetAlan,syeri.id,
		syeri.stajyeri_mail,syeri.stajyeri_telefon,syeri.stajyeri_fax,syeri.stajyeri_adres,syeri.stajyeri_website,syeri.yetkili_adsoyad,syeri.yetkili_unvan,syeri.yetkili_mail,syeri.durum
		FROM tbl_stajbilgileri sbilgi INNER JOIN tbl_stajyeri syeri on sbilgi.stajyeri_id=syeri.id 
		INNER JOIN tbl_ogrenciler ogr on ogr.ogrenci_no = sbilgi.ogrenci_no join tbl_bolum on ogr.bolum_id=tbl_bolum.id 
		where staj_durum=2 and ogr.bolum_id="'.$bolum.'"')->result();
		return $result;
	 } 
	 public function kimlik_Kontrol($ogrenci_no)
	 {
		 	$query = $this->db->query('SELECT * FROM `tbl_kimlikbilgileri` WHERE ogrenci_no ='.$ogrenci_no.'')->result();
			if(count($query) > 0){
			return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	
	public function basvuru_formu_doldurulcak_sorgu($id){
		$query=$this->db->query('select tbl_kullanicilar.email,tbl_bolum.bolum_adi,tbl_ogrenciler.ad_soyad,tbl_ogrenciler.ogrenci_no,
		tbl_ogrenciler.giris_yili,tbl_ogrenciler.telefon,tbl_ogrenciler.adres,tblkimlik.tc_no,tblkimlik.nc_seriNo,tblkimlik.baba_ad,
		tblkimlik.ana_ad,tblkimlik.dogum_yeri,tblkimlik.dogum_tarihi,tblkimlik.il,tblkimlik.ilce,tblkimlik.mahalle,tblkimlik.cilt_no,
		tblkimlik.ailesira_no,tblkimlik.sira_no,tblkimlik.verildigi_yer,tblkimlik.verildigi_tarih,tblkimlik.verilis_nedeni,
		tbl_stajyeri.stajyeri_ad,tbl_stajyeri.stajyeri_adres,tbl_stajyeri.stajyeri_faaliyetAlan,tbl_stajyeri.stajyeri_telefon,
		tbl_stajyeri.stajyeri_mail,tbl_stajyeri.stajyeri_website,tbl_stajyeri.yetkili_adsoyad,tbl_stajyeri.yetkili_unvan,
		tbl_stajyeri.yetkili_mail,tbl_stajbilgileri.baslama_tarihi,tbl_stajbilgileri.bitis_tarihi,
		tbl_stajbilgileri.staj_gun from tbl_kimlikbilgileri tblkimlik join tbl_ogrenciler ON
		tblkimlik.ogrenci_no=tbl_ogrenciler.ogrenci_no JOIN tbl_bolum ON tbl_ogrenciler.bolum_id=tbl_bolum.id  join tbl_kullanicilar on tbl_kullanicilar.no=tbl_ogrenciler.ogrenci_no 
		join tbl_stajbilgileri on tbl_stajbilgileri.ogrenci_no=tbl_ogrenciler.ogrenci_no JOIN tbl_stajyeri 
		ON tbl_stajyeri.id=tbl_stajbilgileri.stajyeri_id where tbl_ogrenciler.ogrenci_no='.$id.' ');
		return $query->result();
	}
	public function ogrenci_bolumu($ogrenci_no)
	{
		$query = $this->db->query('SELECT * FROM `tbl_ogrenciler` WHERE ogrenci_no ='.$ogrenci_no.'')->result();
		return $query;
	}
	 

}