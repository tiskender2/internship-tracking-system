<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->_check_session();
		$this->load->view('header');
		$this->load->model('profil_Model');
		
	}

	
	private function _check_session(){
		if($this->session->login!=TRUE){
			$this->session->sess_destroy();
			redirect();
		}
	}

	public function akademisyen(){
		$query=$this->profil_Model->akademisyen_bilgi_getir($this->session->no);
		
		$data['akademisyen']=$query;
		
		$this->load->view('profil/akademisyen_profil',$data);
	}
	public function sifre_degis($no){
		
		$profiltipi=$this->profil_Model->profil_tipi($no);
			foreach($profiltipi as $row)
				{
				$loginType=$row->loginType;
				}
				if($loginType=="Ogrenci")
				{
					$query=$this->profil_Model->ogrenci_bilgi_getir($no);
				}
				else
				{
					$query=$this->profil_Model->akademisyen_bilgi_getir($no);
				}
		foreach($query as $row)
		{
			$sifre=$row->sifre;
		}
		$eskisifre=$this->input->post('eski_sifre');
		$yenisifre=$this->input->post('yeni_sifre');
		$resifre  =$this->input->post('yeni_sifre_tekrar');
		if($sifre!=$eskisifre)
		{
			$this->session->set_flashdata('eskisifrehatasi','Eski şifre doğru girilmedi!');
			if($loginType=="Ogrenci")
				{
					redirect('profil/ogrenci_profil_Guncelle/'.$no.'');
				}
				else
				{
					redirect('profil/akademisyen');
				}
			
		}
		else if($sifre == $yenisifre)
		{
				$this->session->set_flashdata('sifrehatasi','Yeni şifre Eski şifre ile aynı olamaz !');
				if($loginType=="Ogrenci")
				{
					redirect('profil/ogrenci_profil_Guncelle/'.$no.'');
				}
				else
				{
					redirect('profil/akademisyen');
				}
				
		}
		else{
			if($loginType=="Ogrenci"){
				$this->profil_Model->sifre_degis($no,$yenisifre);
				redirect('profil');
			}
			else{
				$this->profil_Model->sifre_degis($no,$yenisifre);
				redirect('profil/akademisyen');
			}
		}
		
	}
	
	public function index(){
		$profil = $this->profil_Model->profil_varmi($this->session->no);
		$profil2 = $this->profil_Model->ogrenci_akademisyen_getir($this->session->no,$this->session->bolum_id);
		
		
		foreach($profil2 as $row)
		{
			
			$akademisyen_nosu=$row->akademisyen_no;
		}
		
		$data['profil']=$profil;
		if ($profil==true)
		{
				if($akademisyen_nosu!=0)
				{
				$profilbilgisi = $this->profil_Model->profil_Getir($this->session->no,$this->session->bolum_id);
				$data['profilbilgisi']=$profilbilgisi;
				}
				else
				{
					$profilbilgisi = $this->profil_Model->profil_Getir2($this->session->no);
					$data['profilbilgisi']=$profilbilgisi;
				}
				$this->load->view('profil/profil',$data);
			
		}
		else
		{
		$this->load->view('profil/profil',$data);
		}
		$this->load->view('footer');
		
	}

	public function profil_Ekle_islemi(){
		
		if(isset($_POST['btn_ekle'])){
			
			$this->form_validation->set_rules('tc_no','Tc Kimlik No',"required");
			$this->form_validation->set_rules('ncseri_no','Nufus Cüzdanı Seri No',"required");
			$this->form_validation->set_rules('baba_adi','Baba Adı',"required");
			$this->form_validation->set_rules('ana_adi','Anne Adı',"required");
			$this->form_validation->set_rules('dogum_yeri','Doğum Yeri',"required");
			$this->form_validation->set_rules('dogum_tarihi','Doğum Tarihi',"required");
			$this->form_validation->set_rules('il','İl',"required");
			$this->form_validation->set_rules('ilce','İlçe',"required");
			$this->form_validation->set_rules('mahalle','Mahalle',"required");
			$this->form_validation->set_rules('cilt_no','Cilt No',"required");
			$this->form_validation->set_rules('ailesira_no','Aile Sıra No',"required");
			$this->form_validation->set_rules('sira_no','Sıra No',"required");
			$this->form_validation->set_rules('verildigi_yer','Verildiği Yer İçerik',"required");
			$this->form_validation->set_rules('verildigi_tarih','Verildiği Tarih',"required");
			$this->form_validation->set_rules('verilis_nedeni','Veriliş Nedeni İçerik',"required");

			if($this->form_validation->run()==TRUE){
				
				$ogrenci_no =$this->session->no;
				$tc_no = $this->input->post('tc_no');
				$ncseri_no = $this->input->post('ncseri_no');
				$baba_adi = $this->input->post('baba_adi');
				$ana_adi = $this->input->post('ana_adi');
				$dogum_yeri = $this->input->post('dogum_yeri');
				$dogum_tarihi = $this->input->post('dogum_tarihi');
				$il = $this->input->post('il');
				$ilce = $this->input->post('ilce');
				$mahalle = $this->input->post('mahalle');
				$cilt_no = $this->input->post('cilt_no');
				$ailesira_no = $this->input->post('ailesira_no');
				$sira_no = $this->input->post('sira_no');
				$verildigi_yer = $this->input->post('verildigi_yer');
				$verildigi_tarih = $this->input->post('verildigi_tarih');
				$verilis_nedeni = $this->input->post('verilis_nedeni');

//dosya upload
				$data= array('ogrenci_no'       => $ogrenci_no ,
	  						 'tc_no' 		    => $tc_no ,
	  						 'nc_seriNo'        => $ncseri_no ,
	  						 'baba_ad'  	    => $baba_adi,
	  						 'ana_ad'	     	=> $ana_adi,
	  						 'dogum_yeri'	    => $dogum_yeri,
	  						 'dogum_tarihi'	    => $dogum_tarihi,
	  						 'il'	   		    => $il,
	  						 'ilce'	   		    => $ilce,
	  						 'mahalle'	   	    => $mahalle,
	  						 'cilt_no'	    	=> $cilt_no,
	  						 'ailesira_no'  	=> $ailesira_no,
	  						 'sira_no'	     	=> $sira_no,
	  						 'verildigi_yer'	=> $verildigi_yer,
	  						 'verildigi_tarih'	=> $verildigi_tarih,
	  						 'verilis_nedeni'	=> $verilis_nedeni,
								);
					
					  $tc_kontrol=$this->profil_Model->tc_varmi($tc_no);
					if($tc_kontrol == TRUE)
					{
					
						$this->session->set_flashdata('tc','Tc kimlik numaranız sistemde bulunmaktadır !');
						 redirect('profil/');
						
					}
					else
					{
						$this->profil_Model->profil_ekle($data);
						redirect("profil/");
					}
					


		}
			else{
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$this->load->view('profil/profil_ekle',$data);
				$this->load->view('footer');
			}	
		}
	}
		public function profil_Guncelle_islemi(){
		
		if(isset($_POST['btn_guncelleme'])){
			
			
				
				$ogrenci_no =$this->session->no;
				$tc_no = $this->input->post('tc_no');
				$ncseri_no = $this->input->post('ncseri_no');
				$baba_adi = $this->input->post('baba_adi');
				$ana_adi = $this->input->post('ana_adi');
				$dogum_yeri = $this->input->post('dogum_yeri');
				$dogum_tarihi = $this->input->post('dogum_tarihi');
				$il = $this->input->post('il');
				$ilce = $this->input->post('ilce');
				$mahalle = $this->input->post('mahalle');
				$cilt_no = $this->input->post('cilt_no');
				$ailesira_no = $this->input->post('ailesira_no');
				$sira_no = $this->input->post('sira_no');
				$verildigi_yer = $this->input->post('verildigi_yer');
				$verildigi_tarih = $this->input->post('verilis_tarihi');
				$verilis_nedeni = $this->input->post('verilis_nedeni');

//dosya upload
				$data= array(
							 'tc_no' 		    => $tc_no ,
	  						 'nc_seriNo'        => $ncseri_no ,
	  						 'baba_ad'  	    => $baba_adi,
	  						 'ana_ad'	     	=> $ana_adi,
	  						 'dogum_yeri'	    => $dogum_yeri,
	  						 'dogum_tarihi'	    => $dogum_tarihi,
	  						 'il'	   		    => $il,
	  						 'ilce'	   		    => $ilce,
	  						 'mahalle'	   	    => $mahalle,
	  						 'cilt_no'	    	=> $cilt_no,
	  						 'ailesira_no'  	=> $ailesira_no,
	  						 'sira_no'	     	=> $sira_no,
	  						 'verildigi_yer'	=> $verildigi_yer,
	  						 'verildigi_tarih'	=> $verildigi_tarih,
	  						 'verilis_nedeni'	=> $verilis_nedeni,
								);

					$this->profil_Model->profil_Guncelle($ogrenci_no,$data);
					redirect("profil/");


		}
		
		}
		
		public function resimdegis($id)
		{	
								$resimAdi=uniqid().".jpg";
								$config['upload_path']          = './application_resources/img/';
								$config['allowed_types']        = 'jpg|png';
								$config['max_size']             = 2097152;
								$config['max_width']            = 9999;
								$config['max_height']           = 9999;
								$config['file_name']			=$resimAdi;
								$this->load->library('upload', $config);
								//$this->upload->initialize($config);*/
								 if (!$this->upload->do_upload('resim'))
										{
												$error = array('error' => $this->upload->display_errors());
											   // printf(base_url().'application_resources/img/');
										
												echo 'hata oluştur';
												printf(json_encode($error));
												   redirect();
										}
										else
										{ 
											$data3 = array('upload_data' => $this->upload->data());
											 /*  echo '<pre>';
											print_r($data3);
											echo print_r($resimAdi);
											echo '</pre>';*/
											
											
										}
											$data= array( 'resim'    => $resimAdi );		
											$this->profil_Model->profil_Guncelle_resim($id,$data);
											$this->session->unset_userdata('resim');
											$this->session->set_userdata('resim',$resimAdi);
											$profiltipi=$this->profil_Model->profil_tipi($id);
											foreach($profiltipi as $row)
											{
												
												$loginType=$row->loginType;
											}	
											if($loginType=="Ogrenci")
											{
											redirect('profil/ogrenci_profil_Guncelle/'.$id.'');
											}
											else
											{
											redirect('profil/akademisyen');
											}
										
		}
		public function ogrenci_profil_Guncelle($id)
		{	
			$profil2 = $this->profil_Model->ogrenci_akademisyen_getir($this->session->no,$this->session->bolum_id);
		
		
		foreach($profil2 as $row)
		{
			
			$akademisyen_nosu=$row->akademisyen_no;
		}					
				if($akademisyen_nosu!=0)
				{
				$profilbilgisi = $this->profil_Model->ogrenci_bilgi_getir($this->session->no);
				$data['profilbilgisi']=$profilbilgisi;
				}
				else
				{
					$profilbilgisi = $this->profil_Model->ogrenci_bilgi_getir2($this->session->no);
					$data['profilbilgisi']=$profilbilgisi;
				}
				$this->load->view('profil/ogrenci_profil',$data);
				$this->load->view('footer');
		}
		
		
	

}
?>