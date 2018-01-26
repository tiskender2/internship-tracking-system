<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->_check_session();
		$this->load->view('header');
		$this->load->model('Duyuru_Model');
	}
		
	private function _check_session(){
		if($this->session->login!=TRUE){
			$this->session->sess_destroy();
			redirect();
		}
	}

	public function index(){

		$result = $this->Duyuru_Model->duyuru_Getir();
		$data['duyurular']= $result;
		$this->load->view('duyuru/duyuru',$data);
		$this->load->view('footer');	
	}



	public function dosyaindir(){
		if($this->input->get('id'))
		{
			$id=$this->input->get('id');
			$yol="./uploads/";
			$duyurular=$this->Duyuru_Model->idye_göre_duyuru_Getir($id);
			foreach ($duyurular as $row) {
				$dosyaadi=$row->dosya;
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


	public function duyuru_Ekle(){ // ogrenici url yi yazıp giremesin diye kontrol eklendi.
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$this->load->view("duyuru/duyuru_ekle");
			$this->load->view('footer');	
		}
		else {
			redirect('duyuru');
		}
	}



	public function duyuru_Ekle_islemi(){
		
		if(isset($_POST['btn_ekle'])){
			
			$this->form_validation->set_rules('duyuru_baslik','Duyuru Başlık',"required");
			$this->form_validation->set_rules('duyuru_icerik','Duyuru İçerik',"required");
			
			if($this->form_validation->run()==TRUE){
				
				$tarih = date('Y-m-d');
				$duyuru_baslik = $this->input->post('duyuru_baslik');
				$duyuru_icerik = $this->input->post('duyuru_icerik');
				$no = $this->session->no;
//dosya upload
				$hedefdosya="Dosya Yok";
				if(isset($_FILES['duyuru_dosya'])){

					$hata = $_FILES['duyuru_dosya']['error'];
  					if($hata == 0) {
		        		$hedefdizin="./uploads/";
		        		$hedefdosya=$hedefdizin.$_FILES['duyuru_dosya']['name'];		// veritabanına dosya yolu kaydedilir.
		        		
						$tmp_name=$_FILES['duyuru_dosya']['tmp_name'];
		        		
		        		$dosyaadi=$_FILES['duyuru_dosya']['name'];
		        		$uzanti=explode(".", $dosyaadi);
		        		$uzanti=$uzanti[count($uzanti)-1];

		        		if(!file_exists($hedefdosya)){
			        		if($uzanti == "txt" || $uzanti == "pdf" || $uzanti == "doc" || $uzanti == "docx" || $uzanti == "rar"){
			        			move_uploaded_file($tmp_name, $hedefdosya);
			        		}
			       			else{
        						$this->session->set_flashdata('tiphatasi','Seçtiğiniz dosya yüklenemez lütfen uzantısı txt , pdf , docx veya rar olan dosyaları yükleyin..');
        						redirect("duyuru/duyuru_Ekle");			
			        		}
        				}
        				else{
        					$this->session->set_flashdata('dosyamevcut','Yüklemeye çalıştığınız dosya daha önceden zaten yüklenmiş.. Bu dosyayı yüklemek istiyorsanız lütfen ismini değiştirin.');
        					redirect("duyuru/duyuru_Ekle");
        				}

        			}
//**
                        $hedefdosya=explode("/", $hedefdosya);     
                        $hedefdosya=$hedefdosya[count($hedefdosya)-1];

				}
					$data= array('baslik'   		=> $duyuru_baslik ,
	  						     'icerik' 			=> $duyuru_icerik ,
	  						     'tarih'	 	    => $tarih ,
	  						     'akademisyen_no'  	=> $no,
	  						     'dosya'	   		=> $hedefdosya
								);

					$this->Duyuru_Model->duyuru_Ekle($data);
					redirect("duyuru/");


		}
			else{
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$this->load->view('duyuru/duyuru_ekle',$data);
				$this->load->view('footer');	
			}	
		}
	}



	public function duyurularim(){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$a_no=$this->session->no;
			$result = $this->Duyuru_Model->denetmene_göre_duyuru_Getir($a_no);
			$data['duyurular']= $result;
			$this->load->view('duyuru/duyurularim',$data);
			$this->load->view('footer');	
		}
		else redirect('duyuru');
	}





	public function duyuru_Sil($id){
		$result = $this->Duyuru_Model->duyuru_Sil($id);
		redirect('duyuru/');
	}








	public function duyuru_Guncelle($id){
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye") {
			$duyurular=$this->Duyuru_Model->idye_göre_duyuru_Getir($id);
			$data['duyurular']=$duyurular;
			$data['id']=$id;
			$this->load->view("duyuru/duyuru_guncelle",$data);
			$this->load->view('footer');	
		}
		else redirect('duyuru');
	}

	public function duyuru_Guncelle_islemi($id){
		

		if(isset($_POST['btn_guncelle'])){
			$this->form_validation->set_rules('duyuru_baslik','Duyuru Başlık',"required");
			$this->form_validation->set_rules('duyuru_icerik','Duyuru İçerik',"required");


			if($this->form_validation->run()==TRUE){
				$duyuru_baslik = $this->input->post('duyuru_baslik');
				$duyuru_icerik = $this->input->post('duyuru_icerik');


				$hedefdosya="Dosya Yok";
				if(isset($_FILES['duyuru_dosya'])){

					$hata = $_FILES['duyuru_dosya']['error'];
  					if($hata == 0) {

		        		$hedefdizin="uploads/";
		        		$hedefdosya=$hedefdizin.$_FILES['duyuru_dosya']['name'];		// veritabanına dosya yolu kaydedilir.
		        		
						$tmp_name=$_FILES['duyuru_dosya']['tmp_name'];
		        		
		        		$dosyaadi=$_FILES['duyuru_dosya']['name'];
		        		$uzanti=explode(".", $dosyaadi);
		        		$uzanti=$uzanti[count($uzanti)-1];
		        		

		        		if(!file_exists($hedefdosya)){
			        		if($uzanti == "txt" || $uzanti == "pdf" || $uzanti == "doc" || $uzanti == "docx" || $uzanti == "rar"){
			        			move_uploaded_file($tmp_name, $hedefdosya);
			        		}
			       			else{
        						$this->session->set_flashdata('tiphatasi','Seçtiğiniz dosya yüklenemez lütfen uzantısı txt , pdf , docx veya rar olan dosyaları yükleyin..');
        						redirect("duyuru/duyuru_Guncelle/".$id."");			
			        		}
        				}
        				else{
        					$this->session->set_flashdata('dosyamevcut','Yüklemeye çalıştığınız dosya daha önceden zaten yüklenmiş.. Bu dosyayı yüklemek istiyorsanız lütfen ismini değiştirin.');
        					redirect("duyuru/duyuru_Guncelle/".$id."");
        				}
        			}

        			    $hedefdosya=explode("/", $hedefdosya);     
                        $hedefdosya=$hedefdosya[count($hedefdosya)-1];
				}

				$data= array('baslik'   => $duyuru_baslik ,
	  					     'icerik' => $duyuru_icerik ,
	  					     'dosya'	   => $hedefdosya
							);
					
				$this->Duyuru_Model->duyuru_Guncelle($id,$data);
				redirect("duyuru/");

			}

			else {
				$data['eksikgiris']="Lütfen tüm alanları doldurunuz..";
				$data['id']=$id;
			$this->load->view('duyuru/duyuru_guncelle',$data);
			$this->load->view('footer');	
			}
		}
	}
	
	
	public function duyuru_icerik($id){
		$query=$this->Duyuru_Model->anasayfa_duyuru($id);
		$data['duyurular']=$query;
		$this->load->view('duyuru/duyuru_icerik',$data);
		$this->load->view('footer');	
	}
	
	






}
?>