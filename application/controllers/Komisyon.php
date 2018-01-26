<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komisyon extends MY_Controller{
	
		public function __construct(){
		parent::__construct();
		$this->_check_session();
		$this->load->view('header');
		$this->load->model('Komisyon_Model');
		$this->load->model('Ogrenci_Model'); 
		$this->load->model('Denetmen_Model');

	}
	
	private function _check_session(){
		if($this->session->loginType!='Komisyonuye'){
			$this->session->sess_destroy();
			redirect();
		}
	}
	
	/*public function Denetmenler()
	{
		$result=$this->Komisyon_Model->denetmen_Getir();
		$data['denetmenler']=$result;
		$this->load->view('komisyon/denetmenler',$data);
		$this->load->view('footer');	
	}*/
	
	public function yil_artir(){
		$query=$this->Komisyon_Model->artirilacak_yil_getir();
		foreach($query as $row){
			$tarih=$row->tarih;
		}
		$a= date('Y-m-d');
	
		if($a >= $tarih)
		{

			$islem=explode("-",$tarih);
			$yil=$islem[0];
			$yil=$yil+1;
			$islem[0]=$yil;
			$yeni_tarih=implode("-",$islem);
			
			$this->Komisyon_Model->tarih_update($yeni_tarih);
			$this->Komisyon_Model->ogrenci_yil_update();
			redirect("Ana/anasayfa");
		}
		else
		redirect("Ana/anasayfa");
	}
	
	
	public function DersSorumlulari()
	{
		$result2=$this->Komisyon_Model->tbl_akademisyen_getir($this->session->no); 
		$data['akademisyen']=$result2;
		$result=$this->Komisyon_Model->derssorumlusu_Getir($this->session->bolum_id);
		$data['derssorumlulari']=$result;
		$this->load->view('komisyon/DersSorumlulari',$data);
		$this->load->view('footer');	
	}

	public function Komisyonuyeleri()
	{
		if (isset($this->session->login)) {			
		$result=$this->Komisyon_Model->komisyonuyeleri_Getir($this->session->bolum_id);
		$result2=$this->Komisyon_Model->tbl_akademisyen_getir($this->session->no); 
		$data['komisyonuyeleri']=$result;
		$data['akademisyen']=$result2;
		$this->load->view('komisyon/Komisyonuyeleri',$data);
		$this->load->view('footer');	
		}
		else redirect();
	}

	public function komisyon_uye_gor(){
		$query=$this->Komisyon_Model->komisyon_uye_gor($this->session->bolum_id);
		$data["komisyonuye"]=$query;
		$this->load->view("komisyon/komisyon_uyeleri_gor",$data);
				$this->load->view('footer');	
	}
	public function komisyon_uyeden_cikar($no){
		$data="Denetmen";
	
		$this->Komisyon_Model->logintype_update($no,$data);
		redirect("Komisyon/komisyon_uye_gor");
	}
	public function komisyon_uyeden_ekle($no){
		$data="Komisyonuye";
	
		$this->Komisyon_Model->logintype_update($no,$data);
		redirect("Komisyon/Komisyonuyeleri");
	}
	
	
	public function Ogrenciler($id)
	{
		$result3=$this->Komisyon_Model->tbl_akademisyen_getir($this->session->no); 
		$data['akademisyen']=$result3;
		$result=$this->Komisyon_Model->ogrencileri_Getir($id,$this->session->bolum_id);
		$result2=$this->Komisyon_Model->derssorumlusu_Getir($this->session->bolum_id);
		$data['ogrenciler']=$result;
		$data['derssorumlulari']=$result2;
		$data['tum']=$id;
		$this->load->view('komisyon/komisyon',$data);
		$this->load->view('footer');	
	}
	public function StajiBitenler($id)
	{
	
		$result=$this->Komisyon_Model->stajibiten_ogrencileri_Getir($id,$this->session->bolum_id);
		$data['stajibitenler']=$result;
		$data['tum']=$id;
		$this->load->view('komisyon/stajibitenler',$data);
		$this->load->view('footer');	
	}
	public function DersSorumlusu_ekle(){
		
		$result = $this->Komisyon_Model->unvan_getir();
		$data['unvanlar']= $result;
		$this->load->view("komisyon/DersSorumlusuEkle",$data);
				$this->load->view('footer');	
	}
	public function Komisyonuye_ekle(){
		
		$result = $this->Komisyon_Model->unvan_getir();
		$data['unvanlar']= $result;
		$this->load->view("komisyon/KomisyonuyeEkle",$data);
				$this->load->view('footer');	
	}
	public function derssorumlusu_olustur(){
		if(isset($_POST['btn_kayit'])){
			
			$this->form_validation->set_rules('derssorumlusu_adi','derssorumlusu_adi',"required");
			$this->form_validation->set_rules('akademisyen_no','akademisyen_no',"required");
			$this->form_validation->set_rules('email','email',"required");
			$this->form_validation->set_rules('sifre','sifre',"required");
			$this->form_validation->set_rules('unvan','unvan',"required");

			if($this->form_validation->run()==TRUE){
				$derssorumlusu_adi	= $this->input->post('derssorumlusu_adi');
				$akademisyen_no 	= $this->input->post('akademisyen_no');
				$email 				= $this->input->post('email');
				$sifre 				= $this->input->post('sifre');
				$unvan 				= $this->input->post('unvan');
				$loginType	= 'Denetmen';
				
				$no=$this->session->no;
				$sorgu=$this->Komisyon_Model->noya_gore_bolumid_getir($no);
				foreach($sorgu as $row){
					$bolum_id=$row->bolum_id;
				}
				$data= array(
							 'no' 				=> $akademisyen_no ,
							 'ad_soyad'			=> $derssorumlusu_adi,
							 'bolum'			=> $bolum_id
							);
				$data2= array(
							 'no' 			=> $akademisyen_no ,
							 'email' 		=> $email ,
							 'sifre'		=> $sifre ,
							 'unvan' 		=> $unvan ,
							 'loginType'	=> $loginType,
							 );
				$data3= array(
							 'akademisyen_no' 	=> $akademisyen_no ,
							 'bolum_id'			=> $bolum_id ,
							 'ad_soyad'			=> $derssorumlusu_adi,
							 'baskan'			=> 0 ,
							 'durum'			=> 1 ,
							 'yetki'			=> 0 ,
							 'ders_sorumlusu'	=> 1 ,
							 );	
				$this->Komisyon_Model->derssorumlusu_tblsine_ekle($data);
				$this->Komisyon_Model->kullanicilar_tblsine_ekle($data2);
				$this->Komisyon_Model->akademisyen_tblsine_ekle($data3);
				redirect("Komisyon/DersSorumlulari");
			}
			else{
				$this->session->set_flashdata("eksikgiris","Lütfen tüm alanları doldurunuz..");
				redirect('Komisyon/DersSorumlusu_ekle');
			}	
		}
	}
	
	public function sorumlu_olarak_ata($no){
		$query=$this->Komisyon_Model->sorumlu_tablosuna_eklemek_icin_bilgi_getir($no);
		foreach($query as $row){
			$ad_soyad=$row->ad_soyad;
			$bolum=$row->bolum_id;
		}
		$data=array("no"		=>$no,
					"ad_soyad" 	=>$ad_soyad,
					"bolum"		=>$bolum
		);
		$data2=1;
		$this->Komisyon_Model->ders_sorumlusu_update($no,$data2);
		$this->Komisyon_Model->ders_sorumlusu_tablosuna_ekle($data);
		redirect("Komisyon/Komisyonuyeleri");
		
	}
	
	public function sorumlu_tablosundan_kaldir($no){
		$data2=0;
		$this->Komisyon_Model->ders_sorumlusu_update($no,$data2);
		$this->Komisyon_Model->ders_sorumlusu_tablosundan_sil($no);
		
		$query=$this->Komisyon_Model->sorumlunun_ogrencilerini_getir($no);

		foreach($query as $row){
			$ogrenci_no=$row->ogrenci_no;
			$this->Komisyon_Model->ogrencilerin_denetmenini_yok_yap($ogrenci_no);
		}
		redirect("Komisyon/DersSorumlulari");
	}
	
	
	public function komisyonUye_olustur(){
		if(isset($_POST['btn_kayit2'])){
			
			$this->form_validation->set_rules('komisyonuye_adi','komisyonuye_adi',"required");
			$this->form_validation->set_rules('akademisyen_no','akademisyen_no',"required");
			$this->form_validation->set_rules('email','email',"required");
			$this->form_validation->set_rules('sifre','sifre',"required");
			$this->form_validation->set_rules('unvan','unvan',"required");

			if($this->form_validation->run()==TRUE){
				$derssorumlusu_adi	= $this->input->post('komisyonuye_adi');
				$akademisyen_no 	= $this->input->post('akademisyen_no');
				$email 				= $this->input->post('email');
				$sifre 				= $this->input->post('sifre');
				$unvan 				= $this->input->post('unvan');
				$loginType	= 'Komisyonuye';
				
				$no=$this->session->no;
				$sorgu=$this->Komisyon_Model->noya_gore_bolumid_getir($no);
				foreach($sorgu as $row){
					$bolum_id=$row->bolum_id;
				}
				$data= array(
							 'akademisyen_no' 	=> $akademisyen_no ,
							 'ad_soyad'			=> $derssorumlusu_adi,
							 'bolum_id'			=> $bolum_id,
							 'baskan'			=> '0', 
							 'durum'			=> '1',
							 'yetki'			=> 0 ,
							 'ders_sorumlusu'	=> 0 ,
							);
				$data2= array(
							 'no' 			=> $akademisyen_no ,
							 'email' 		=> $email ,
							 'sifre'		=> $sifre ,
							 'unvan' 		=> $unvan ,
							 'loginType'	=> $loginType,
							 );			
				$this->Komisyon_Model->akademisyen_tblsine_ekle($data);
				$this->Komisyon_Model->kullanicilar_tblsine_ekle($data2);
				redirect("Komisyon/Komisyonuyeleri");
			}
			else{
				$this->session->set_flashdata("eksikgiris","Lütfen tüm alanları doldurunuz..");
				redirect('Komisyon/Komisyonuye_ekle');
			}	
		}
	}
	public function yetkilileri_gor(){
		$result=$this->Komisyon_Model->komisyonuyeleri_yetkilileri_Getir($this->session->bolum_id);
		$data['yetkililer']=$result;
		$this->load->view("/komisyon/yetkilileri_gor",$data);
				$this->load->view('footer');	
	}
	public function komisyon_uyeye_yetki_ver($no){
		$query=$this->Komisyon_Model->komisyon_uyeye_yetki_ver($no);
		redirect("Komisyon/Komisyonuyeleri");
	}
	public function komisyon_uyeye_yetki_gerial($no){
		$query=$this->Komisyon_Model->komisyon_uyeye_yetki_gerial($no);
		redirect("Komisyon/yetkilileri_gor");
	}
	
	public function ogrenci_kayit(){
		$bolum_id=$this->session->bolum_id;
		$query=$this->Komisyon_Model->kayit_onaylanmamis_ogrenci($bolum_id);
		$data["ogrenciler"]=$query;
		$this->load->view("komisyon/kayit_onay",$data);
				$this->load->view('footer');	
	}
	public function ogrenci_kayit_kabul($no){
		$data=array("kayit_durum" => 1);
		$query=$this->Komisyon_Model->kayit_durum_update($no);
		$tarih = date('Y-m-d');
		$data2 = array('ogrenci_no' =>$no,
				    	 'baslik' 	     =>"Kayıt Durum",
						 'bolum_id'     		 =>$this->session->bolum_id,
	  					 'icerik'	     => "Kayıt Onaylandı Lütfen Tekrar Giriş Yapınız",
						  'gonderilme_tarih' => $tarih,
	  				      'durum'  		 =>"1");
						  $this->Bildirim_Model->bildirim_ekle($data2);
		redirect("Komisyon/ogrenci_kayit");
	}
	public function ogrenci_kayit_red($no){
		$tarih = date('Y-m-d');
		$query=$this->Komisyon_Model->kayit_durum_sil($no);
		$data2 = array('ogrenci_no' =>$no,
				    	 'baslik' 	     =>"Kayıt Durum",
						 'bolum_id'     		 =>$this->session->bolum_id,
	  					 'icerik'	     => "Kayıt Reddedildi",
						  'gonderilme_tarih' => $tarih,
	  				      'durum'  		 =>"1");
						  $this->Bildirim_Model->bildirim_ekle($data2);
		redirect("Komisyon/ogrenci_kayit");
	}
	
	
	//sınıfa_gore_ogrencileri_Getir
	public function denetmeni_Degistir($kid,$oid,$sinif)
	{ 
					$tarih = date('Y-m-d');
					$result2=$this->Komisyon_Model->idye_gore_denetmen_Getir($kid);
					$result4=$this->Komisyon_Model->idye_gore_denetmen_Getir($this->session->no);
					$result3=$this->Ogrenci_Model->idye_ogr_getir($oid);
					foreach($result2 as $row)
					{
						$akadi=$row->ad_soyad;
					}
					foreach($result4 as $row)
					{
						$komiad=$row->ad_soyad;
						
					}
					foreach($result3 as $row)
					{
						$ogadi=$row->ad_soyad;
					}
					$data2 = array('ogrenci_no' =>$oid,
				    	 'baslik' 	     =>"Yeni denetmeniniz atandı!",
						 'bolum_id'     		 =>$this->session->bolum_id,
	  					 'icerik'	     => "$komiad  yeni denetmenizi $akadi yaptı" ,
						  'bildirim_tur'  =>"4",
						  'gonderilme_tarih' => $tarih,
	  				     'durum'  		 =>"1");
						
							  $data3 = array('ogrenci_no' =>$kid,
							'bolum_id'     		 =>$this->session->bolum_id,
							'baslik' 	     =>" Yeni öğrenciniz atandı!",
							'icerik'	     => "$komiad denetleyeceğiniz öğrencilere $ogadi atandı" ,
							'bildirim_tur'  =>"5",
							'gonderilme_tarih' => $tarih,
							'durum'  		 =>"1");
						 
						 
						
					$this->Bildirim_Model->bildirim_ekle($data2);
					$this->Bildirim_Model->bildirim_ekle($data3);						
		$this->Komisyon_Model->denetmen_degistir_islem($kid,$oid);
		redirect('Komisyon/Ogrenciler/'.$sinif.'');
	}
	public function OgrenciAta($no)
	{
		$query3=$this->Komisyon_Model->baskan_getir($this->session->bolum_id);
		foreach($query3 as $row){
			$baskan_no=$row->akademisyen_no;
		}

		$result=$this->Komisyon_Model->denetmen_olmayan_ogrenci_Getir($this->session->bolum_id);
		$result2=$this->Komisyon_Model->idye_gore_derssorumlusu_Getir($no,$this->session->bolum_id);
		$data['ogrenciler']=$result;
		$data['denetmen']=$result2;
		$this->load->view('komisyon/ogrenci_atama',$data);
		$this->load->view('footer');	
	}
	public function KomisyonBaskaniYap($no)
	{
        $this->Komisyon_Model->akademisyen_pasif_yap($this->session->no);
		$this->Komisyon_Model->akademisyen_komisyonBaskan_yap($no);
		redirect('Ana/logout');
	}
	public function komisyon_uye_sil($no){
		$this->Komisyon_Model->komisyon_uye_sil($no);
		redirect("Komisyon/Komisyonuyeleri");
	}
	public function derssorumlusuna_ogrenciEkle($ano,$dizi)
	{
		$array = explode(",",$dizi);
		$tarih = date('Y-m-d');
		$result2=$this->Komisyon_Model->idye_gore_derssorumlusu_Getir($ano);
		$result4=$this->Komisyon_Model->idye_gore_derssorumlusu_Getir($this->session->no);
		foreach($result2 as $row)
					{
						$akadi=$row->ad_soyad;
					}
					foreach($result4 as $row)
					{
						$komiad=$row->ad_soyad;
					}
				foreach($array as $row3)
				{
					$this->Komisyon_Model->denetmen_degistir_islem($ano,$row3);
					
					
					$result3=$this->Ogrenci_Model->idye_ogr_getir($row3);
					
					foreach($result3 as $row)
					{
						$ogadi=$row->ad_soyad;
					}
					$data2 = array('ogrenci_no' =>$row3,
				    	 'baslik' 	     =>"Yeni denetmeniniz atandı!",
						 'bolum_id'     		 =>$this->session->bolum_id,
	  					 'icerik'	     => "$komiad  yeni denetmenizi $akadi yaptı" ,
						  'gonderilme_tarih' => $tarih,
						  'bildirim_tur'  =>"4",
	  				     'durum'  		 =>"1");
						 $data3 = array('ogrenci_no' =>$ano,
						 'bolum_id'     		 =>$this->session->bolum_id,
				    	 'baslik' 	     =>" $komiad denetleyeceğiniz öğrencilere $ogadi atandı",
						 'bildirim_tur'  =>"5",
	  					 'icerik'	     => "" ,
						  'gonderilme_tarih' => $tarih,
	  				     'durum'  		 =>"1");
						 
					$this->Bildirim_Model->bildirim_ekle($data2);
					$this->Bildirim_Model->bildirim_ekle($data3);
				}	
		redirect('Komisyon/DersSorumlulari');
	}
	

	
	
}