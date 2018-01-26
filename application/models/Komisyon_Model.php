<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komisyon_Model extends CI_Model{
	
	 public function ogrencileri_Getir($giris_yili,$bolum)
	 {
		 if ($giris_yili == "TumOgrenciler"  )
		 {
			 $query=$this->db->query('SELECT tblo.ogrenci_no,tblo.ad_soyad,tblo.telefon,tblo.giris_yili,tblk.email,
			 tblo.kalan_gun,tbld.no,tbld.ad_soyad ds_ad FROM tbl_ogrenciler tblo join tbl_kullanicilar tblk 
			 on tblo.ogrenci_no=tblk.no left join tbl_derssorumlusu tbld on tblo.akademisyen_no=tbld.no join 
			 tbl_bolum tblb on tblo.bolum_id=tblb.id join tbl_bolum on tbl_bolum.id=tblo.bolum_id where 
			 tblo.giris_yili and tblo.kalan_gun>0 and tblo.bolum_id="'.$bolum.'"'); 
		 }
		
		 else
		 {
			$query=$this->db->query('SELECT tblo.ogrenci_no,tblo.ad_soyad,tblo.telefon,tblo.giris_yili,tblk.email,
			tblo.kalan_gun,tbld.no,tbld.ad_soyad ds_ad FROM tbl_ogrenciler tblo join tbl_kullanicilar tblk on 
			tblo.ogrenci_no=tblk.no left join tbl_derssorumlusu tbld on tblo.akademisyen_no=tbld.no join tbl_bolum tblb 
			on tblo.bolum_id=tblb.id where tblo.giris_yili = '.$giris_yili.' and tblo.kalan_gun>0 and tblo.bolum_id="'.$bolum.'"');

		 }
		return $query->result();
	 }
	 
	 public function artirilacak_yil_getir(){
		$query=$this->db->query('select tarih from tbl_tarih');
		return $query->result();
	 }
	 
	 public function ogrenci_yil_update(){
		$this->db->query('UPDATE tbl_ogrenciler SET sinif=(sinif+1) WHERE 1 ');
	 }
	 public function tarih_update($yeni_tarih){
		 $this->db->query('UPDATE tbl_tarih SET tarih="'.$yeni_tarih.'" WHERE id=1 ');
	 }
	 
	 
	 public function stajibiten_ogrencileri_Getir($giris_yili,$bolum)
		 {
			 	 if ($giris_yili == "TumOgrenciler"  )
			{
			 $query=$this->db->query('SELECT tblo.ogrenci_no,tblo.ad_soyad,tblo.telefon,tblo.giris_yili,tblk.email FROM
			 tbl_ogrenciler tblo join tbl_kullanicilar tblk on tblo.ogrenci_no=tblk.no  join tbl_bolum tblb 
			 on tblo.bolum_id=tblb.id where tblo.giris_yili and tblo.kalan_gun=0'); 
			}
			else
			{
				$query=$this->db->query('SELECT tblo.ogrenci_no,tblo.ad_soyad,tblo.telefon,tblo.giris_yili,tblk.email 
				FROM tbl_ogrenciler tblo join tbl_kullanicilar tblk on tblo.ogrenci_no=tblk.no  join tbl_bolum tblb on
				tblo.bolum_id=tblb.id where tblo.giris_yili = '.$giris_yili.' and tblo.kalan_gun=0');
			}
			
			return $query->result();
		 }
	 public function denetmen_olmayan_ogrenci_Getir($bolum)
	 {
		$query=$this->db->query('SELECT * FROM `tbl_ogrenciler` join tbl_bolum on tbl_bolum.id=tbl_ogrenciler.bolum_id 
		where akademisyen_no=0 and tbl_ogrenciler.bolum_id="'.$bolum.'"');
		return $query->result();
	 }
	 public function tumogrencileri_getir($durum,$bolum)
	 {
		$query=$this->db->query('SELECT tblo.ogrenci_no,tblo.kayit_durum,tblo.ad_soyad,tblo.telefon,tblo.giris_yili,
		tblk.email,tblo.kalan_gun,tbld.no,tbld.ad_soyad ds_ad FROM tbl_ogrenciler tblo join tbl_kullanicilar tblk on
		tblo.ogrenci_no=tblk.no left join tbl_derssorumlusu tbld on tblo.akademisyen_no=tbld.no join tbl_bolum tblb on
		tblo.bolum_id=tblb.id join tbl_bolum on tbl_bolum.id=tblo.bolum_id where tblo.kayit_durum="'.$durum.'" and tblo.bolum_id="'.$bolum.'" ');
		return $query->result();
	 }
	 
	 public function komisyon_Kontrol()
	 {
		$query2=$this->db->query(' SELECT * FROM `tbl_kullanicilar` INNER JOIN tbl_akademisyen on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no where loginType = "Komisyonuye"');
		return $query2->result();
	 }
	
	  public function denetmen_Getir()// burası kullanılmıyorsa silinecek
	 {
		$query=$this->db->query('SELECT * FROM `tbl_kullanicilar` INNER JOIN tbl_akademisyen on tbl_akademisyen.akademisyen_no = tbl_kullanicilar.no WHERE loginType = "Denetmen"');
		return $query->result();
	 }
	   public function derssorumlusu_Getir($bolum)
	 {
		$query=$this->db->query('SELECT * FROM `tbl_kullanicilar` INNER JOIN tbl_derssorumlusu on 
		tbl_derssorumlusu.no = tbl_kullanicilar.no join tbl_akademisyen on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no 
		INNER JOIN tbl_unvan on tbl_unvan.id=tbl_kullanicilar.unvan join tbl_bolum on tbl_bolum.id=tbl_akademisyen.bolum_id 
		where bolum_id="'.$bolum.'"');
		return $query->result();
	 }
	public function idye_gore_denetmen_Getir($id)
	 {
		$query=$this->db->query('SELECT * FROM `tbl_akademisyen` inner join tbl_kullanicilar on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no WHERE akademisyen_no = '.$id.'');
		return $query->result();
	 }
	 public function idye_gore_derssorumlusu_Getir($id)
	 {
		$query=$this->db->query('SELECT * FROM `tbl_derssorumlusu` WHERE no = '.$id.'');
		return $query->result();
	 }

	 public function denetmen_degistir_islem($id,$data){
	    $this->db->query('UPDATE tbl_ogrenciler SET akademisyen_no='.$id.' WHERE ogrenci_no='.$data.'');
	 }
	 
	 public function bolume_gore_komisyonuye_getir($bolum){
		 $query=$this->db->query("select akademisyen_no from tbl_akademisyen join tbl_bolum on tbl_akademisyen.bolum_id=tbl_bolum.id 
		 where tbl_akademisyen.baskan=1 and bolum_id=".$bolum."");
		 return $query->result();
	 }
	 
	 
	 
	 public function kayit_onaylanmamis_ogrenci($bolum_id){
		 $query=$this->db->query("SELECT * FROM tbl_ogrenciler join tbl_bolum on tbl_ogrenciler.bolum_id=tbl_bolum.id where kayit_durum=0 and bolum_id=".$bolum_id."");
		 return $query->result();
	 }
	 public function kayit_durum_update($no){
		 $query=$this->db->query("UPDATE tbl_ogrenciler SET kayit_durum=1 where ogrenci_no=".$no."");
	 }
	 public function kayit_durum_sil($no){
		 $query=$this->db->query("DELETE FROM `tbl_ogrenciler` WHERE ogrenci_no=".$no."");
	 }
	 public function noya_gore_bolumid_getir($no){
		 $query=$this->db->query("SELECT * FROM tbl_akademisyen join tbl_bolum on tbl_bolum.id=tbl_akademisyen.bolum_id where akademisyen_no=".$no."");
		 return $query->result();
	 }
	 public function akademisyen_tblsine_ekle($data){
		 $this->db->insert('tbl_akademisyen',$data);
	 }
	 public function derssorumlusu_tblsine_ekle($data){
		 $this->db->insert('tbl_derssorumlusu',$data);
	 }
	 public function kullanicilar_tblsine_ekle($data){
		 $this->db->insert('tbl_kullanicilar',$data);
	 }
	 
	 public function stajbiten_tablosuna_ekle($data){
		$this->db->insert('tbl_bitenstaj',$data);
	 }
	 public function staj_bilgileri_tablosunu_guncelle($no,$data){
		$this->db->where('ogrenci_no', $no);
		$this->db->update('tbl_stajbilgileri', $data);  
	 }
	 public function tbl_akademisyen_getir($no){
		 $query=$this->db->query("select * from tbl_akademisyen where akademisyen_no=".$no."");
		 return $query->result();
	 }
	 public function yeni_tablo_icin_bilgi_getir($no){
		$query=$this->db->query("SELECT * FROM tbl_stajbilgileri join tbl_stajyeri 
		on tbl_stajbilgileri.stajyeri_id=tbl_stajyeri.id where ogrenci_no=".$no."");
		return $query->result();
	 }
	 public function akademisyen_pasif_yap($no){
		$query=$this->db->query("UPDATE tbl_akademisyen SET baskan=0,yetki=0 where akademisyen_no=".$no."");
	 }
	 public function akademisyen_komisyonBaskan_yap($no){
		$query=$this->db->query("UPDATE tbl_akademisyen SET baskan=1,yetki=1 where akademisyen_no=".$no."");
	 }
	 public function komisyon_uye_sil($no){
		$query=$this->db->query("DELETE FROM `tbl_akademisyen` WHERE akademisyen_no=".$no."");
		$query=$this->db->query("DELETE FROM `tbl_kullanicilar` WHERE no=".$no."");
		$query=$this->db->query("DELETE FROM `tbl_derssorumlusu` WHERE no=".$no."");
	 }
	
	  public function unvan_getir(){
		$query=$this->db->query("SELECT * FROM tbl_unvan");
		return $query->result();
	 }
	 public function komisyonuyeleri_Getir($bolumid){
		$query=$this->db->query("SELECT tbl_unvan.unvan,tbl_kullanicilar.email,tbl_kullanicilar.loginType,tbl_akademisyen.ad_soyad,
		tbl_akademisyen.akademisyen_no,tbl_akademisyen.baskan,tbl_derssorumlusu.no as sorumlumukontrol,tbl_akademisyen.yetki FROM `tbl_akademisyen` 
		JOIN tbl_kullanicilar on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no LEFT JOIN tbl_derssorumlusu on 
		tbl_derssorumlusu.no=tbl_akademisyen.akademisyen_no JOIN 
		tbl_unvan on tbl_unvan.id=tbl_kullanicilar.unvan where tbl_akademisyen.bolum_id=".$bolumid);
		return $query->result();
	 }

	 public function sorumlu_tablosuna_eklemek_icin_bilgi_getir($no){
		 $query=$this->db->query("SELECT * FROM `tbl_bolum` join tbl_akademisyen on tbl_akademisyen.bolum_id=tbl_bolum.id where
		 tbl_akademisyen.akademisyen_no=".$no."");
		 return $query->result();
	 }
	 public function ders_sorumlusu_tablosuna_ekle($data){
		$this->db->insert('tbl_derssorumlusu',$data);
	 }
	 public function ders_sorumlusu_tablosundan_sil($no){
		 $query=$this->db->query("DELETE FROM `tbl_derssorumlusu` WHERE no=".$no."");
	 }
	 public function komisyon_uyeye_yetki_ver($no){
		 $this->db->query('UPDATE tbl_akademisyen SET yetki=1 WHERE akademisyen_no='.$no.'');
	 }
	 public function komisyon_uyeye_yetki_gerial($no){
		 $this->db->query('UPDATE tbl_akademisyen SET yetki=0 WHERE akademisyen_no='.$no.'');
	 }
	 public function komisyonuyeleri_yetkilileri_Getir($bolum_id){
		 $query=$this->db->query("SELECT tbl_unvan.unvan,tbl_kullanicilar.email,tbl_akademisyen.ad_soyad,
		tbl_akademisyen.akademisyen_no,tbl_akademisyen.baskan,tbl_derssorumlusu.no as sorumlumukontrol,tbl_akademisyen.yetki FROM `tbl_akademisyen` 
		JOIN tbl_kullanicilar on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no LEFT JOIN tbl_derssorumlusu on 
		tbl_derssorumlusu.no=tbl_akademisyen.akademisyen_no JOIN 
		tbl_unvan on tbl_unvan.id=tbl_kullanicilar.unvan where yetki=1 and baskan!=1 and tbl_akademisyen.bolum_id=".$bolum_id);
		return $query->result();
	 }
	 
	 public function ders_sorumlusu_update($no,$data){
		$this->db->query('UPDATE tbl_akademisyen SET ders_sorumlusu='.$data.' WHERE akademisyen_no='.$no.'');
	 }
	 public function komisyon_uye_gor($bolum){
		$query=$this->db->query("Select * from tbl_kullanicilar join tbl_unvan on tbl_kullanicilar.unvan=tbl_unvan.id 
		join tbl_akademisyen on tbl_kullanicilar.no=tbl_akademisyen.akademisyen_no join tbl_bolum on 
		tbl_bolum.id=tbl_akademisyen.bolum_id where loginType='Komisyonuye' and tbl_akademisyen.baskan!=1
		and tbl_akademisyen.bolum_id='".$bolum."'");
		return $query->result();
	 }
	 public function logintype_update($no,$data){
		$this->db->query('UPDATE tbl_kullanicilar SET loginType="'.$data.'" WHERE no='.$no.'');
	 }
	
	public function sorumlunun_ogrencilerini_getir($no){
		$query=$this->db->query("select * from tbl_ogrenciler where akademisyen_no=".$no."");
		return $query->result();
	}
	public function ogrencilerin_denetmenini_yok_yap($no){
		$this->db->query('UPDATE tbl_ogrenciler SET akademisyen_no=0 WHERE ogrenci_no='.$no.'');
	}
	public function baskan_getir($no){
		$query=$this->db->query("select akademisyen_no from tbl_akademisyen where bolum_id=".$no." and baskan=1");
		return $query->result();
	}
	
	
}	