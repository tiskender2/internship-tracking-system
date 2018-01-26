<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ana extends MY_Controller {

		public function __construct(){
		parent::__construct();
		$this->load->model('profil_Model');
		$this->load->model('Duyuru_Model'); 	
		$this->load->model('Bildirim_Model'); 			
		$this->load->model('Login_Model');
		$this->load->model('Komisyon_Model');
	}

	public function index(){
		if($this->session->login==FALSE){
			$result=$this->Login_Model->bolum_getir();
			$data['bolum']=$result;
			$result2 = $this->Duyuru_Model->dis_duyuru_Getir();
			$data['duyurular']= $result2;
			$this->load->view('Login',$data);
		}
		else{
			redirect('Ana/anasayfa');
		}
	}


	
	public function anasayfa(){
		if (isset($this->session->login)) {			
			$no=$this->session->no;
		    $query=$this->Komisyon_Model->tbl_akademisyen_getir($no);
			$data['ad_soyad']=$this->session->ad_soyad;
			$data['unvan']=$this->session->unvan; 
			$data['akademisyen']=$query; 
			$this->load->view('header',$data);
			$result = $this->Duyuru_Model->duyuru_Getir();
			$datax['duyurular']= $result;
			$this->load->view('Anasayfa',$datax);
			$this->load->view('footer');
		}
		else redirect();
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect();
	}




}