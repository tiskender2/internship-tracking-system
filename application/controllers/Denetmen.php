<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denetmen extends MY_Controller{

  public function __construct(){
    parent::__construct();
	$this->_check_session();
	$this->load->view('header');
    $this->load->model('Denetmen_Model');  
	$this->load->model('Bildirim_Model');
	$this->load->model('Basvuru_Model'); 
	$this->load->model('Komisyon_Model');
  }
  
  	private function _check_session(){
		if($this->session->loginType!='Denetmen' && $this->session->loginType!='Komisyonuye'){
			$this->session->sess_destroy();
			redirect();
		}
	}
  
  
  public function ogrenci_listele(){
	  
	$akademisyen_no=$this->session->no;
	$result=$this->Denetmen_Model->ogrenci_getir();
	$data['ogrenciler']=$result;
	$data['akademisyen_no']=$akademisyen_no;
	$this->load->view('denetmen/ogrenciler',$data); 
	$this->load->view('footer');	
	
  }
  
  public function staj_kabul_gun(){
	  $result=$this->Denetmen_Model->islemleri_bitmis_ogrenci($this->session->bolum_id);
	  $data['ogrenciler']=$result;
	  $this->load->view('denetmen/kabulgun',$data);
	  $this->load->view('footer');	
  }
  
  public function staj_kabul_gun_giris($no){
	  $islem=0;
	  $tarih = date('Y-m-d');
	  $result=$this->Denetmen_Model->islemleri_bitmis_ogrenci($this->session->bolum_id);
	  foreach($result as $row){
		  $kalan_gun=$row->kalan_gun;
		  $staj_gun=$row->staj_gun;
		  $staj_yerisim=$row->stajyeri_ad;
	  }
	  if(isset($_POST['btn_kabulgiris'])){
		  	$result2=$this->Komisyon_Model->idye_gore_denetmen_Getir($this->session->no);
				foreach($result2 as $row)
					{
						$akadi=$row->ad_soyad;
					}
		  $this->form_validation->set_rules('kabul_gun','Kabul Gun Girisi',"required");
		  if($this->form_validation->run()==TRUE){
			$kabul_gun = $this->input->post('kabul_gun');	
						 
			 $data2 = array('ogrenci_no'	  	=>"$no",
							'baslik' 	   	  	=>"Staj Kabül Gün",
							'bolum_id'     	  	=>$this->session->bolum_id,
							'icerik'	  	  	=> "$akadi $staj_gun'Gün yaptığınız stajdan $kabul_gun'Gün kabul etti." ,
							'bildirim_tur'      =>"7",
							'gonderilme_tarih' 	=> $tarih,
							'durum'  			=>"1");
			 
			$this->Bildirim_Model->bildirim_ekle($data2);			
			if($kabul_gun>$staj_gun or $kabul_gun<0){
				$this->session->set_flashdata('gunyanlis','Hatalı gün girişi yapıldı.');
				redirect('Denetmen/staj_kabul_gun');
			}
			else{
				$this->Denetmen_Model->kabul_gun_update($no,$kabul_gun);
				$islem	= $kalan_gun - $kabul_gun;
				if($islem<=0){
					$islem=0;
				}
				$this->Denetmen_Model->ogrenciler_tablosundan_update($no,$islem);
				$this->Denetmen_Model->tbl_stajbilgileri_update($no);
				$query=$this->Komisyon_Model->yeni_tablo_icin_bilgi_getir($no);
				foreach($query as $row){
					$baslama_tarih=$row->baslama_tarihi;
					$bitis_tarih=$row->bitis_tarihi;
					$staj_gun=$row->staj_gun;
					$kabul_gun=$row->kabul_gun;
					$stajyeri_ad=$row->stajyeri_id;
				}
				//yeni tabloya verileri ekle
				$stjbiten=array('ogrenci_no' 	=>$no ,
								'baslama_tarih' =>$baslama_tarih,
								'bitis_tarih' 	=>$bitis_tarih ,
								'staj_gun' 		=>$staj_gun,
								'kabul_gun' 	=>$kabul_gun,
								'stajyeri_id'	=>$stajyeri_ad
								);
				$this->Komisyon_Model->stajbiten_tablosuna_ekle($stjbiten);
				redirect('Denetmen/staj_kabul_gun');
			}
		  }
		  else{
			  $this->session->set_flashdata('bosgirilmez','Kabul edilen günü girmelisiniz.');
			  redirect('Denetmen/staj_kabul_gun');
		  }
	  }
	  
  }
  
  
 


 
}
?>