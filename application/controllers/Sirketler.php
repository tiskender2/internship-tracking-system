<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirketler extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->_check_session();
		$this->load->view('header');
		$this->load->model('Sirket_Model');
	}
	
	private function _check_session(){
		if($this->session->login!=TRUE){
			$this->session->sess_destroy();
			redirect();
		}
	}
	
	
	
	public function index(){
		$result = $this->Sirket_Model->sirketleri_Getir();
		$data['sirketler']= $result;
		$this->load->view('sirketler/Sirketler',$data);
		$this->load->view('footer');
	}
	
	public function sirket_Ekle(){ // ogrenici url yi yazıp giremesin diye kontrol eklendi.
			if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
				$this->load->view("sirketler/sirket_ekle");
				$this->load->view('footer');
			}
			else {
				redirect('Sirketler');
			}
		}
		
		
	public function onaylanmamis_sirketler(){ // ogrenici url yi yazıp giremesin diye kontrol eklendi.
			if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
				$result = $this->Sirket_Model->onaylanmamıs_sirketleri_Getir();
				$result2 = $this->Sirket_Model->reddedilen_sirketleri_Getir();
				$data['o_sirketler']= $result;
				$data['r_sirketler']= $result2;
				$this->load->view("sirketler/Onaylanmamis_sirketler",$data);
				$this->load->view('footer');
			}
			else {
				redirect('Sirketler');
			}
		}
		public function reddedilen_Sirketler(){ // ogrenici url yi yazıp giremesin diye kontrol eklendi.
			if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
				$result = $this->Sirket_Model->reddedilen_sirketleri_Getir();
				$data['r_sirketler']= $result;
				$this->load->view("sirketler/Reddedilen_sirketler",$data);
				$this->load->view('footer');
			}
			else {
				redirect('Sirketler');
			}
		}
		
		public function sirket_Onayla($id){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$data= array('durum'  => "1");
			$this->Sirket_Model->sirket_Guncelle($id,$data);
			redirect("Sirketler/onaylanmamis_sirketler");
		}
		else redirect("Sirketler/");
	}
	public function sirket_Red($id){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$data= array('durum'  => "2");
			$this->Sirket_Model->sirket_Guncelle($id,$data);
			redirect("Sirketler/onaylanmamis_sirketler");
		}
		else redirect("Sirketler/");
	}
	public function sirket_Askiyaal($id){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$data= array('durum'  => "0");
			$this->Sirket_Model->sirket_Guncelle($id,$data);
			redirect("Sirketler/reddedilen_Sirketler");
		}
		else redirect("Sirketler/");
	}
	
		
	public function sirket_Ekle_islemi(){
		
		if(isset($_POST['btn_ekle'])){
			
			$this->form_validation->set_rules('sirket_ad','Şirket Adı',"required");
			$this->form_validation->set_rules('sirket_faaliyet','Şirket FaaliyetAlanı',"required");
			$this->form_validation->set_rules('sirket_mail','Şirket Mail',"required");
			$this->form_validation->set_rules('sirket_tel','Şirket Telefon',"required");
			$this->form_validation->set_rules('sirket_fax','Şirket Fax',"required");
			$this->form_validation->set_rules('sirket_adres','Şirket Adres',"required");
			$this->form_validation->set_rules('sirket_website','Şirket Website ',"required");
			$this->form_validation->set_rules('yetkili_adsoyad','Yetkili Adsoyad',"required");
			$this->form_validation->set_rules('yetkili_unvan','Yetkili Unvan',"required");
			$this->form_validation->set_rules('yetkili_mail','Yetkili Mail',"required");
			
			 
			if($this->form_validation->run()==TRUE){
				
				$tarih = date('Y-m-d');
				$sirket_ad = $this->input->post('sirket_ad');
				$sirket_faaliyet = $this->input->post('sirket_faaliyet');
				$sirket_mail = $this->input->post('sirket_mail');
				$sirket_tel = $this->input->post('sirket_tel');
				$sirket_fax = $this->input->post('sirket_fax');
				$sirket_adres = $this->input->post('sirket_adres');
				$sirket_website = $this->input->post('sirket_website');
				$yetkili_adsoyad = $this->input->post('yetkili_adsoyad');
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
							 'durum'					=> "1"
							);

					$this->Sirket_Model->sirket_Ekle($data);
					redirect("Sirketler/");


		}
		/*else if($this->form_validation->run('sirket_mail')==FALSE || $this->form_validation->run('yetkili_mail')==FALSE)
		{
			$data['eksikgiris']="Geçerli Eposta giriniz!";
				$this->load->view('sirketler/sirket_ekle',$data);
		}*/
			else{
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$this->load->view('sirketler/sirket_ekle',$data);
				$this->load->view('footer');
			}	
		}
	}	
	
	public function sirket_Guncelle($id){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$sirketler=$this->Sirket_Model->idye_göre_sirket_Getir($id);
			$data['sirketler']=$sirketler;
			$data['id']=$id;
			$this->load->view("sirketler/sirket_guncelle",$data);
			$this->load->view('footer');
		}
		else redirect("Sirketler/");
	}
	
	public function sirket_Guncelle_islemi($id){
		
		if(isset($_POST['btn_guncelle'])){
			
			$this->form_validation->set_rules('sirket_ad','Şirket Adı',"required");
			$this->form_validation->set_rules('sirket_faaliyet','Şirket FaaliyetAlanı',"required");
			$this->form_validation->set_rules('sirket_mail','Şirket Mail',"required");
			$this->form_validation->set_rules('sirket_tel','Şirket Telefon',"required");
			$this->form_validation->set_rules('sirket_fax','Şirket Fax',"required");
			$this->form_validation->set_rules('sirket_adres','Şirket Adres',"required");
			$this->form_validation->set_rules('sirket_website','Şirket Website ',"required");
			$this->form_validation->set_rules('yetkili_adsoyad','Yetkili Adsoyad',"required");
			$this->form_validation->set_rules('yetkili_unvan','Yetkili Unvan',"required");
			$this->form_validation->set_rules('yetkili_mail','Yetkili Mail',"required");
			
			 
			if($this->form_validation->run()==TRUE){
				
				$tarih = date('Y-m-d');
				$sirket_ad = $this->input->post('sirket_ad');
				$sirket_faaliyet = $this->input->post('sirket_faaliyet');
				$sirket_mail = $this->input->post('sirket_mail');
				$sirket_tel = $this->input->post('sirket_tel');
				$sirket_fax = $this->input->post('sirket_fax');
				$sirket_adres = $this->input->post('sirket_adres');
				$sirket_website = $this->input->post('sirket_website');
				$yetkili_adsoyad = $this->input->post('yetkili_adsoyad');
				$yetkili_mail = $this->input->post('yetkili_mail');
				$yetkili_unvan = $this->input->post('yetkili_unvan');
				$durum = $this->input->post('durum');
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
							 'durum'	   				=> $durum
							);

					$this->Sirket_Model->sirket_Guncelle($id,$data);
					redirect("Sirketler/");


		}
			else {
				
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$data['id']=$id;
			    $this->load->view('sirketler/sirket_guncelle',$data);
				$this->load->view('footer');
			}

		}
	}
	
	public function sirket_Sil($id){
		$result = $this->Sirket_Model->sirket_Sil($id);
		redirect('Sirketler/');
	}


}
?>