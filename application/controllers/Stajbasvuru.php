<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stajbasvuru extends MY_Controller {
  
	public function __construct(){
		parent::__construct();
		$this->_check_session();
		$this->load->view('header');
		$this->load->model('Sirket_Model');
		$this->load->model('Basvuru_Model');
		$this->load->model('Bildirim_Model');
		$this->load->model('Ogrenci_Model');
	
	}
	private function _check_session(){
		if($this->session->loginType!=TRUE){
			$this->session->sess_destroy();
			redirect();
		}
	}
	public function index(){
		$no = $this->session->no;
		$result=$this->Basvuru_Model->basvurularım($no);
		$kalan_gun=$this->Basvuru_Model->kabulgungetir($no);
		$data['basvurularım']=$result;
		$data['kalan_gun']=$kalan_gun;
		$this->load->view('basvuru/basvuru',$data);
		$this->load->view('footer');
	}

	public function basvuruform(){
		$result = $this->Sirket_Model->reddedilmeyen_sirketleri_Getir();
		$data['sirketler']= $result;
		$this->load->view('basvuru/basvuruform',$data);
		$this->load->view('footer');		
	}

	public function basvuru_kabul()
	{
		
		$result = $this->Basvuru_Model->tum_basvurular($this->session->no,$this->session->bolum_id);
		$data['basvurular']=$result;
		$this->load->view('basvuru/basvuru_onay',$data);
		$this->load->view('footer');
	}

	
	public function basvuru_yap(){
		
		if(isset($_POST['btn_Basvurugonder'])){

			$this->form_validation->set_rules('baslama_tarih','Başlama Tarihi',"required");
			$this->form_validation->set_rules('bitis_tarih','Bitiş Tarihi',"required");
			$this->form_validation->set_rules('staj_suresi','Staj Süresi',"required");
			$this->form_validation->set_rules('stajyeri','Staj Yeri',"required");
		
			if($this->form_validation->run()==TRUE)
			{
				
				$result=$this->Basvuru_Model->kimlik_Kontrol($this->session->no);
				if ($result == TRUE)
				{
					$baslama_tarih	= $this->input->post('baslama_tarih');
					$bitis_tarih	= $this->input->post('bitis_tarih');
					$staj_suresi	= $this->input->post('staj_suresi');//gün
					$stajyeri_id	= $this->input->post('stajyeri');
					$adsoyad		= $this->input->post('adsoyad');
					$onaydurumu		= 0;
				
					$tarih = date('Y-m-d');
					$tarihdurum=1;
					
					$baslama_tarih=str_replace('/','-',$baslama_tarih);
					$bitis_tarih=str_replace('/','-',$bitis_tarih);
					if(strtotime($baslama_tarih)< strtotime('+30 day'))
						$tarihdurum=0;
					if(20>$staj_suresi || $staj_suresi>40)
						$tarihdurum=0;
	/*				if(strtotime($bitis_tarih)> (strtotime($baslama_tarih)+strtotime('+60 day')))
						$tarihdurum=0;
					if(strtotime($bitis_tarih)< (strtotime($baslama_tarih)+strtotime('+20 day')))
						$tarihdurum=0;*/
					
					if($tarihdurum==1){
						$baslama_tarih=date('Y-m-d',strtotime($baslama_tarih));
						$bitis_tarih=date('Y-m-d',strtotime($bitis_tarih));
						$data = array('baslama_tarihi' => $baslama_tarih ,
									  'bitis_tarihi'   => $bitis_tarih ,
									  'staj_gun'	   => $staj_suresi ,
									  'stajyeri_id'	   => $stajyeri_id ,
									  'staj_durum'	   => $onaydurumu,
									  'ogrenci_no'     => $this->session->no,
									  'basvuru_tarihi' => $tarih
								 );		
                    $bolum=$this->Basvuru_Model->ogrenci_bolumu($this->session->no);
					foreach($bolum as $row)
					{
						$bolum=$row->bolum_id;
					}
					$baslik="Staj Başvurusu";
					$icerik="$adsoyad staj başvurusunda bulundu";
				    $data2 = array('ogrenci_no' =>$bolum,
				    	 'baslik' 	     =>$baslik,
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>$icerik,
						 'bildirim_tur'  =>"1",
	  				     'durum'  		 =>"1",
						 'gonderilme_tarih' =>$tarih
							);
					$this->Bildirim_Model->bildirim_ekle($data2);
					$this->Basvuru_Model->basvuru_yap($data);
					
				/*	$no=$this->session->no;
					$mail=$this->Ogrenci_Model->mail_getir($no);
					foreach($mail as $row){
						$ak_mail=$row->email;
					}	*/			
					//$isim,$eposta,$icerik,$baslik
					//$this->Bildirim_Model->send_mail($adsoyad,$ak_mail,$icerik,$baslik);
					redirect("/stajbasvuru");
				}
				else{
					$this->session->set_flashdata('tarihhatasi','Lütfen tarih ve gün bilgilerini kontrol ediniz..');
					redirect('stajbasvuru/basvuruform');
				}
				}
				else
				{
					$this->session->set_flashdata('kimlik','1');
					redirect('stajbasvuru/basvuruform');
				}
				
			}
		
		}
	}
		public function ogrenci_sirket_goruntule($id){
		$result=$this->Sirket_Model->idye_göre_sirket_Getir($id);
		$data['sirketbilgileri']=$result;
		$this->load->view('basvuru/sirketbilgi',$data);
		$this->load->view('footer');
	}
	public function sirket_onay($id,$ogrenci_no){
		$result=$this->Sirket_Model->idye_göre_sirket_Getir($id);
		$data['sirketbilgileri']=$result;
		$data['ogrenci_no']=$ogrenci_no;
		$this->load->view('basvuru/basvuru_sirket_onay',$data);
		$this->load->view('footer');
	}
	public function sirketBilgi($id,$ogrenci_no){
		$result=$this->Sirket_Model->idye_göre_sirket_Getir($id);
		$data['sirketbilgileri']=$result;
		$data['ogrenci_no']=$ogrenci_no;
		$this->load->view('basvuru/basvuru_sirket_onay',$data);
		$this->load->view('footer');
	}
	
	public function sirket_onay_kabul($id,$ogrenci_no){
		$tarih = date('Y-m-d');
		$data2 = array('ogrenci_no' 	=>$ogrenci_no,
				    	 'baslik' 	     =>"Şirket Onay durumu",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"Staj yapmak için Eklediniğiniz Şirket Onaylanmıştır.",
	  				     'durum'  		 =>"1",
						 'bildirim_tur'  =>"2",
						 'gonderilme_tarih' =>$tarih
							);
							$this->Bildirim_Model->bildirim_ekle($data2);
		$data=array(
			'durum'	=>	1
		);
		$this->Sirket_Model->sirket_Guncelle($id,$data);
		redirect('stajbasvuru/basvuru_kabul');
	}
	public function sirket_onay_red($id,$ogrenci_no){
		    $tarih = date('Y-m-d');
			$data2 = array('ogrenci_no' 	=>$ogrenci_no,
				    	 'baslik' 	     =>"Şirket Onay durumu",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"Staj yapmak için Eklediniğiniz Şirket Reddedilmiştir.",
	  				     'durum'  		 =>"1",
						 'bildirim_tur'  =>"2",
						 'gonderilme_tarih' =>$tarih
							);
							$this->Bildirim_Model->bildirim_ekle($data2);
		$data=array(
			'durum'	=>	2
		);
		$data2=array(
			'staj_durum'	=>	2
		);
		$this->Sirket_Model->sirket_Guncelle($id,$data);
		$this->Basvuru_Model->stajbilgileri_Guncelle2($id,$data2);
		redirect('stajbasvuru/basvuru_kabul');
	}
	public function sirket_onay_geridon(){
		redirect('stajbasvuru/basvuru_kabul');
	}
	
	public function basvuruyu_kabulet($id,$id2,$ogrenci_no){
		$tarih = date('Y-m-d');
		$icerik="Yapmış olduğunuz staj başvurusu kabul edilmiştir ";
		$baslik="Staj Onay Durumu";
		$data2 = array('ogrenci_no' 	=>$ogrenci_no,
				    	 'baslik' 	    =>$baslik,
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	    =>$icerik,
						 'durum'  		=>"1",
						 'bildirim_tur'  =>"3",
						 'gonderilme_tarih' =>$tarih
							);
		$this->Bildirim_Model->bildirim_ekle($data2);
		//$this->Sirket_Model->sirket_Guncelle($id,$data); hata olan yer
		$result=$this->Basvuru_Model->basvuru_formu_doldurulcak_sorgu($ogrenci_no);

		foreach($result as $row){
			$email						=	$row->email;
			$bolum_adi					=	$row->bolum_adi;
			$ad_soyad					=	$row->ad_soyad;
			$ogrenci_no					=	$row->ogrenci_no;
			$sinif						=	$row->sinif;
			$telefon					=	$row->telefon;
			$adres						=	$row->adres;
			$tc_no						=	$row->tc_no;
			$nc_seriNo					=	$row->nc_seriNo;
			$baba_ad					=	$row->baba_ad;
			$ana_ad						=	$row->ana_ad;
			$dogum_yeri					=	$row->dogum_yeri;
			$dogum_tarihi				=	$row->dogum_tarihi;
			$il							=	$row->il;
			$ilce						=	$row->ilce;
			$mahalle					=	$row->mahalle;
			$cilt_no					=	$row->cilt_no;
			$ailesira_no				=	$row->ailesira_no;
			$sira_no					=	$row->sira_no;
			$verildigi_yer				=	$row->verildigi_yer;
			$verildigi_tarih			=	$row->verildigi_tarih;
			$verilis_nedeni				=	$row->verilis_nedeni;	
			$stajyeri_ad				=	$row->stajyeri_ad;
			$stajyeri_adres				=	$row->stajyeri_adres;
			$stajyeri_faaliyetAlan		=	$row->stajyeri_faaliyetAlan;
			$stajyeri_telefon			=	$row->stajyeri_telefon;
			$stajyeri_mail				=	$row->stajyeri_mail;
			$stajyeri_website			=	$row->stajyeri_website;
			$yetkili_adsoyad			=	$row->yetkili_adsoyad;
			$yetkili_unvan				=	$row->yetkili_unvan;
			$yetkili_mail				=	$row->yetkili_mail;
			$baslama_tarihi				=	$row->baslama_tarihi;
			$bitis_tarihi				=	$row->bitis_tarihi;
			$staj_gun					=	$row->staj_gun;
		}
		$advesoyad=explode(" ",$ad_soyad);
		$ad=$advesoyad[0];
		$soyad=$advesoyad[1];
		//basvuru formu upload
		
		$template_file = './uploads/basvuruform.docx';
		$fileName = "Basvuru_Dosyasi-" . $ogrenci_no . ".docx";

		$folder = "./uploads/Basvurular/";
		$fullpath = $folder . '/' . $fileName;

		try
		{
			if (!file_exists($folder))
				mkdir($folder);
				
			copy($template_file, $fullpath);

			$zip = new ZipArchive;
			
			if($zip->open($fullpath) == true)
			{
				$key_file_name = 'word/document.xml'; 
				$message = $zip->getFromName($key_file_name);				
							
				$timestamp = date('Y-m-d H:i:s');
				
				$message = str_replace("Г",		$bolum_adi,			$message);
				$message = str_replace("Д",		$staj_gun,			$message);
				$message = str_replace("Ж",		$ad_soyad,			$message);
				$message = str_replace("З",		$ogrenci_no,		$message);
				$message = str_replace("И",		$email,				$message);
				$message = str_replace("Й",		$sinif,				$message);
				$message = str_replace("К",		$telefon,			$message);
				$message = str_replace("Л",		$adres,				$message);		
				$message = str_replace("Ф",		$tc_no,				$message);
				$message = str_replace("Ц",		$nc_seriNo,			$message);
				$message = str_replace("Ч",		$ad,				$message);
				$message = str_replace("Ш",		$soyad,				$message);
				$message = str_replace("Ъ",		$baba_ad,			$message);
				$message = str_replace("Я",		$ana_ad,			$message);
				$message = str_replace("Ϛ",		$dogum_yeri,		$message);
				$message = str_replace("ω",		$dogum_tarihi,		$message);
				$message = str_replace("Ϡ",		$il,				$message);
				$message = str_replace("ϟ",		$ilce,				$message);
				$message = str_replace("σ",		$mahalle,			$message);
				$message = str_replace("ϕ",		$cilt_no,			$message);
				$message = str_replace("Θ",		$ailesira_no,		$message);
				$message = str_replace("ͽ",		$sira_no,			$message);
				$message = str_replace("ᶏ",		$verildigi_yer,		$message);
				$message = str_replace("ᶈ",		$verildigi_tarih,	$message);
				$message = str_replace("ᶊ",		$verilis_nedeni,	$message);
				$message = str_replace("Ī",		$stajyeri_ad,		$message);
				$message = str_replace("Ŀ",		$stajyeri_adres,	$message);
				$message = str_replace("Œ",		$stajyeri_faaliyetAlan,$message);
				$message = str_replace("ŧ",		$stajyeri_telefon,	$message);
				$message = str_replace("ƻ",		$stajyeri_mail,		$message);
				$message = str_replace("ƿ",		$stajyeri_website,	$message);
				$message = str_replace("ɺ",		$yetkili_adsoyad,	$message);
				$message = str_replace("ʆ",		$yetkili_unvan,		$message);
				$message = str_replace("ʌ",		$yetkili_mail,		$message);
				$message = str_replace("ɐ",		$baslama_tarihi,	$message);
				$message = str_replace("Ȣ",		$bitis_tarihi,		$message);
		
				$zip->addFromString($key_file_name, $message);
				$zip->close();
					
			
			}
		}
		catch (Exception $e) 
		{
			$error_message =  "Error creating the Word Document";
			//TODO : Handle the error message
		}

		$data=array(
			'staj_durum'	=>1	,
			'onaylanma_tarihi' => $tarih,
			'basvuruform'	=>$fileName
		);
		$this->Basvuru_Model->stajbilgileri_Guncelle($id,$data);
		
		/*$mail=$this->Ogrenci_Model->ogrenci_mail_getir($ogrenci_no);
		foreach($mail as $row){
			$ogr_mail=$row->email;
		}	*/			
		//$isim,$eposta,$icerik,$baslik
		//$this->Bildirim_Model->send_mail($ad_soyad,$ogr_mail,$icerik,$baslik);
		redirect('stajbasvuru/basvuru_kabul');

	}
	
	public function basvuruformindir(){
		if($this->input->get('ogrno'))
		{
			$ogrno=$this->input->get('ogrno');
			$yol="./uploads/Basvurular/";
			$basvuruform=$this->Basvuru_Model->ogrnobasvuruindir($ogrno);
			foreach ($basvuruform as $row) {
				$dosyaadi=$row->basvuruform;
			}
			$dosyatamyol=$yol.$dosyaadi;
			if (file_exists($dosyatamyol)){
				header("Content-length: ".filesize($dosyatamyol)); 
				header('Content-Type: application/octet-stream'); 
				header('Content-Disposition: attachment; filename="' . $dosyaadi . '"'); 
				readfile("$dosyatamyol"); 
			}

		}
	}
	
	
	
	
	public function basvuruyu_reddet($id,$id2,$ogrenci_no){
		$tarih = date('Y-m-d');
			$data2 = array('ogrenci_no' 	=>$ogrenci_no,
				    	 'baslik' 	=>"Staj Onay durumu",
						 'bolum_id' =>$this->session->bolum_id,
	  					 'icerik'	=>"Yapmış olduğunuz staj başvurusu Reddedilmiştir 
									  SEBEB: Önerdiğiniz şirket kabul edilmemiştir.",
	  				     'durum'  	=>"1",
						 'bildirim_tur'  =>"3",
						 'gonderilme_tarih' =>$tarih
							);
		$this->Bildirim_Model->bildirim_ekle($data2);
		$data=array(
			'staj_durum'	=>	2
		);
		$this->Basvuru_Model->stajbilgileri_Guncelle($id,$data);
		redirect('stajbasvuru/basvuru_kabul');
	}
	
	public function onaylanmis_basvurulari_getir(){
		$result = $this->Basvuru_Model->onaylanmis_basvurular($this->session->bolum_id);
		$data['onaylanmis']=$result;
		$this->load->view('basvuru/onaylanmis_basvurular',$data);
		$this->load->view('footer');
	}
	public function reddedilmis_basvurulari_getir(){
		$result=$this->Basvuru_Model->reddedilmis_basvurular($this->session->bolum_id);
		$data['reddedilmis']=$result;
		$this->load->view('basvuru/reddedilmis_basvurular',$data);
		$this->load->view('footer');
	}
	
	
	

public function ogrenci_sirket_ekle(){
		if(isset($_POST['sirket_Kaydet']))
		{
			$this->form_validation->set_rules('sirket_ad','Şirket Adı',"required");
			$this->form_validation->set_rules('sirket_adresi','Şirket Adres',"required");
			$this->form_validation->set_rules('sirket_alan','Şirket Alan',"required");
			$this->form_validation->set_rules('sirket_tel','Şirket Telefon',"required");
			$this->form_validation->set_rules('sirket_faks','Şirket Fax',"required");
			$this->form_validation->set_rules('sirket_mail','Şirket Eposta',"required");
			$this->form_validation->set_rules('sirket_web','Şirket Website ',"required");
			$this->form_validation->set_rules('yetkili_ad','Yetkili Adsoyad',"required");
			$this->form_validation->set_rules('yetkili_unvan','Yetkili Unvan',"required");
			$this->form_validation->set_rules('yetkili_mail','Yetkili Mail',"required");
			
			 
			if($this->form_validation->run()==TRUE){
				
				$tarih = date('Y-m-d');
				$sirket_ad = $this->input->post('sirket_ad');
				$sirket_faaliyet = $this->input->post('sirket_alan');
				$sirket_mail = $this->input->post('sirket_mail');
				$sirket_tel = $this->input->post('sirket_tel');
				$sirket_fax = $this->input->post('sirket_faks');
				$sirket_adres = $this->input->post('sirket_adresi');
				$sirket_website = $this->input->post('sirket_web');
				$yetkili_adsoyad = $this->input->post('yetkili_ad');
				$yetkili_mail = $this->input->post('yetkili_mail');
				$yetkili_unvan = $this->input->post('yetkili_unvan');
				$no = $this->session->no;
				$data= array('stajyeri_ad'   			=> $sirket_ad,
							 'stajyeri_faaliyetAlan' 	=> $sirket_faaliyet,
	  					     'stajyeri_mail'	 	    => $sirket_mail,
	  					     'stajyeri_telefon'  		=> $sirket_tel,
	  						 'stajyeri_fax'	   			=> $sirket_fax,
							 'stajyeri_adres'	   		=> $sirket_adres,
							 'stajyeri_website'	   		=> $sirket_website,
							 'yetkili_adsoyad'	   		=> $yetkili_adsoyad,
							 'yetkili_unvan'	   		=> $yetkili_unvan,
						     'yetkili_mail'	   			=> $yetkili_mail,
							 'durum'					=> "0"
							);

					$result=$this->Sirket_Model->sirket_Ekle($data);
					$data2['last_id']= $result;
					redirect("stajbasvuru/basvuruform",$data2);

		}
		else{
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$this->load->view('basvuru/basvuruform',$data);
				$this->load->view('footer');
			}	
		}
		
	}
		public function basvuru_Guncelle($id,$stajdurum)
		{
			if ($this->session->loginType=="Ogrenci") {
			$basvurular=$this->Basvuru_Model->idye_göre_basvuru_Getir($id);
		   	$data['basvurular']=$basvurular;
			$data['id2']=$id;
			$data['staj_durum']=$stajdurum;
			$this->load->view("basvuru/Basvuru_guncelle",$data);
			$this->load->view('footer');
		
		}
		else redirect('Stajbasvuru/');
		}
		public function basvuru_iptalet($id,$id2)
		{
			if ($this->session->loginType=="Ogrenci") {
			$sirketbilgisi=$this->Sirket_Model->idye_göre_sirket_Getir($id2);
			foreach($sirketbilgisi as $row){
				$durum=$row->durum;
			}
			if ($durum != 1)
			{
				$this->Basvuru_Model->basvuru_iptalet($id,$id2);
				
			}
			else
			{
				$this->Basvuru_Model->basvuru_iptalet($id,0);
			}
			$tarih = date('Y-m-d');
					$adsoyad=$this->session->ad_soyad;
				    $data2 = array('ogrenci_no' =>$this->session->bolum_id,
				    	 'baslik' 	     =>"Staj Başvurusu İptali",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"$adsoyad Staj Başvurusunu İptal Etti",
						 'bildirim_tur'  =>"1",
						 'gonderilme_tarih' =>$tarih,
	  				     'durum'  		 =>"1"
							);
					$this->Bildirim_Model->bildirim_ekle($data2);
		
			redirect('Stajbasvuru/');
		}
		else redirect('Stajbasvuru/');
		}
		
		public function basvuru_Guncelle_islemi($id,$id2){	
		if(isset($_POST['btn_Basvuruguncelle']))
		{
			$tarih = date('Y-m-d');
				$baslama_tarih = $this->input->post('baslama_tarih');
				$bitis_tarih = $this->input->post('bitis_tarih');
				$staj_suresi= $this->input->post('staj_suresi');
			  if ($this->input->post('onayli') != "1")
			  {
				
			
				$sirket_ad = $this->input->post('sirket_ad');
				$sirket_faaliyet = $this->input->post('sirket_alan');
				$sirket_mail = $this->input->post('sirket_mail');
				$sirket_tel = $this->input->post('sirket_tel');
				$sirket_fax = $this->input->post('sirket_faks');
				$sirket_adres = $this->input->post('sirket_adresi');
				$sirket_website = $this->input->post('sirket_web');
				$yetkili_adsoyad = $this->input->post('yetkili_ad');
				$yetkili_mail = $this->input->post('yetkili_mail');
				$yetkili_unvan = $this->input->post('yetkili_unvan');
				$no = $this->session->no;
			  }
			
				
			
					$adsoyad=$this->session->ad_soyad;
				    $data3 = array('ogrenci_no' =>$this->session->bolum_id,
				    	 'baslik' 	     =>"Staj Başvuru Güncellenmesi",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"$adsoyad Staj Başvurusunu Güncelledi",
						 'bildirim_tur'  =>"1",
						 'gonderilme_tarih' =>$tarih,
	  				     'durum'  		 =>"1"
							);
					$this->Bildirim_Model->bildirim_ekle($data3);
				$tarihdurum=1;
					
					$baslama_tarih=str_replace('/','-',$baslama_tarih);
					$bitis_tarih=str_replace('/','-',$bitis_tarih);
					if(strtotime($baslama_tarih)< strtotime('+30 day'))
						$tarihdurum=0;
					if(20>$staj_suresi || $staj_suresi>40)
						$tarihdurum=0;
				if($tarihdurum==1)
				{	
					if ($this->input->post('onayli') != "1")
					{
								$data= array(
								 'stajyeri_ad'   			=> $sirket_ad,
								 'stajyeri_faaliyetAlan' 	=> $sirket_faaliyet,
								 'stajyeri_mail'	 	    => $sirket_mail,
								 'stajyeri_telefon'  		=> $sirket_tel,
								 'stajyeri_fax'	   			=> $sirket_fax,
								 'stajyeri_adres'	   		=> $sirket_adres,
								 'stajyeri_website'	   		=> $sirket_website,
								 'yetkili_adsoyad'	   		=> $yetkili_adsoyad,
								 'yetkili_unvan'	   		=> $yetkili_unvan,
								 'yetkili_mail'	   			=> $yetkili_mail
								);
					}
					
					$data2= array(
								 'baslama_tarihi'   		=> $baslama_tarih,	
								 'bitis_tarihi'   			=> $bitis_tarih,
								 'staj_gun'   				=> $staj_suresi,
								);
					
						
					$this->Basvuru_Model->stajbilgileri_Guncelle($id,$data2);
					if ($this->input->post('onayli') != "1")
					{
						
					$this->Basvuru_Model->sirketbilgileri_Guncelle($id2,$data);
					}
					redirect('Stajbasvuru/');
				}
				else{
					$this->session->set_flashdata('tarihhatasi','Lütfen tarih ve gün bilgilerini kontrol ediniz!');
					redirect('stajbasvuru/basvuru_Guncelle/'.$id."/".$id2);
				}

							
		}
			
		}
		
		public function basvuru_YenidenGonder_islemi($id,$id2)
		{	
		if(isset($_POST['btn_tekrargonder']))
		{
				$tarih = date('Y-m-d');
				$baslama_tarih = $this->input->post('baslama_tarih');
				$bitis_tarih = $this->input->post('bitis_tarih');
				$staj_suresi= $this->input->post('staj_suresi');
				$sirket_ad = $this->input->post('sirket_ad');
				$sirket_faaliyet = $this->input->post('sirket_alan');
				$sirket_mail = $this->input->post('sirket_mail');
				$sirket_tel = $this->input->post('sirket_tel');
				$sirket_fax = $this->input->post('sirket_faks');
				$sirket_adres = $this->input->post('sirket_adresi');
				$sirket_website = $this->input->post('sirket_web');
				$yetkili_adsoyad = $this->input->post('yetkili_ad');
				$yetkili_mail = $this->input->post('yetkili_mail');
				$yetkili_unvan = $this->input->post('yetkili_unvan');
				
				$tarihdurum=1;
					
					$adsoyad=$this->session->ad_soyad;
				    $data3 = array('ogrenci_no' =>$this->session->bolum_id,
				    	 'baslik' 	     =>"Staj Başvuru Güncellenmesi",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"$adsoyad Staj Başvurusunu Güncelledi",
						 'bildirim_tur'  =>"1",
						 'gonderilme_tarih' =>$tarih,
	  				     'durum'  		 =>"1"
							);
					$this->Bildirim_Model->bildirim_ekle($data3);
					$baslama_tarih=str_replace('/','-',$baslama_tarih);
					$bitis_tarih=str_replace('/','-',$bitis_tarih);
					if(strtotime($baslama_tarih)< strtotime('+30 day'))
						$tarihdurum=0;
					if(20>$staj_suresi || $staj_suresi>40)
						$tarihdurum=0;
				if($tarihdurum==1)
				{	
					
					
					$data2= array(
								 'baslama_tarihi'   		=> $baslama_tarih,	
								 'bitis_tarihi'   			=> $bitis_tarih,
								 'staj_gun'   				=> $staj_suresi,
								 'staj_durum'				=> '0'
								);
								$data= array(
								 'stajyeri_ad'   			=> $sirket_ad,
								 'stajyeri_faaliyetAlan' 	=> $sirket_faaliyet,
								 'stajyeri_mail'	 	    => $sirket_mail,
								 'stajyeri_telefon'  		=> $sirket_tel,
								 'stajyeri_fax'	   			=> $sirket_fax,
								 'stajyeri_adres'	   		=> $sirket_adres,
								 'stajyeri_website'	   		=> $sirket_website,
								 'yetkili_adsoyad'	   		=> $yetkili_adsoyad,
								 'yetkili_unvan'	   		=> $yetkili_unvan,
								 'yetkili_mail'	   			=> $yetkili_mail,
								 'durum'                    => "0"
								);
					$this->Basvuru_Model->sirketbilgileri_Guncelle($id2,$data);
					$this->Basvuru_Model->stajbilgileri_Guncelle($id,$data2);
					redirect('Stajbasvuru/');
				}
				else{
					$this->session->set_flashdata('tarihhatasi','Lütfen tarih ve gün bilgilerini kontrol ediniz!');
					redirect('stajbasvuru/basvuru_Guncelle/'.$id."/".$id2);
				}

							
		}
			
		}
		public function basvuru_YenidenGonder_islemi_onayli($id)
		{	
		if(isset($_POST['btn_tekrargonder_onayli']))
		{
				$tarih = date('Y-m-d');
				$baslama_tarih = $this->input->post('baslama_tarih');
				$bitis_tarih = $this->input->post('bitis_tarih');
				$staj_suresi= $this->input->post('staj_suresi');
				$tarihdurum=1;
					
					$adsoyad=$this->session->ad_soyad;
				    $data3 = array('ogrenci_no' =>$this->session->bolum_id,
				    	 'baslik' 	     =>"Staj Başvuru Güncellenmesi",
						 'bolum_id'      =>$this->session->bolum_id,
	  					 'icerik'	     =>"$adsoyad Staj Başvurusunu Güncelledi",
						 'gonderilme_tarih' =>$tarih,
						 'bildirim_tur'  =>"1",
	  				     'durum'  		 =>"1"
							);
					$this->Bildirim_Model->bildirim_ekle($data3);
					$baslama_tarih=str_replace('/','-',$baslama_tarih);
					$bitis_tarih=str_replace('/','-',$bitis_tarih);
					if(strtotime($baslama_tarih)< strtotime('+30 day'))
						$tarihdurum=0;
					if(20>$staj_suresi || $staj_suresi>40)
						$tarihdurum=0;
				if($tarihdurum==1)
				{	
					
					
					$data2= array(
								 'baslama_tarihi'   		=> $baslama_tarih,	
								 'bitis_tarihi'   			=> $bitis_tarih,
								 'staj_gun'   				=> $staj_suresi,
								 'staj_durum'				=> '0'
								);
								
					$this->Basvuru_Model->stajbilgileri_Guncelle($id,$data2);
					redirect('Stajbasvuru/');
				}
				else{
					$this->session->set_flashdata('tarihhatasi','Lütfen tarih ve gün bilgilerini kontrol ediniz!');
					redirect('stajbasvuru/basvuru_Guncelle/'.$id."/".$id2);
				}

							
		}
			
		}
}

?>