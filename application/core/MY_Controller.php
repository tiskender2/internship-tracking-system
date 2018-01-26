<?php 

class MY_Controller extends CI_Controller {

   public $site_data;

   function __construct() {
       parent::__construct();
	   	   $this->load->model('Bildirim_Model');
		   $this->load->model('Komisyon_Model');
		   $this->load->model('Ogrenci_Model');
		  	
		  
	   if($this->session->loginType== "Ogrenci" or $this->session->loginType== "Denetmen")
	       {
			    $bildir = $this->Bildirim_Model->bildirim_Getir($this->session->no);
				$bildirsayi = $this->Bildirim_Model->bildirim_Sayisi($this->session->no);
			    $tumbildirimler = $this->Bildirim_Model->tumbildimler($this->session->no);
				$data['bildirim']=$bildir;
				$data['bildirim_sayisi']=$bildirsayi;
				$no=$this->session->no;
				$query=$this->Komisyon_Model->tbl_akademisyen_getir($no);
				//$global_data = array('akademisyen'=>$query);
				$global_data = array('bildirim'=>$bildir,'bildirimsayi'=>$bildirsayi,'tumbildirimler'=>$tumbildirimler,'akademisyen'=>$query);
				
		    if($this->session->loginType== "Ogrenci")
				{
				$bitenstaj = $this->Ogrenci_Model->biten_staj_sayisi($this->session->no);
				$global_data = array('bildirim'=>$bildir,'bildirimsayi'=>$bildirsayi,'tumbildirimler'=>$tumbildirimler,'akademisyen'=>$query,'bitenstaj'=>$bitenstaj);
			 
				}
				$this->load->vars($global_data);
	        }
			
		else if ($this->session->loginType == "Komisyonuye")
			{
					$query2=$this->Komisyon_Model->artirilacak_yil_getir();
					$global_data = array('tarih'=>$query2);
					$this->load->vars($global_data);
				 $derssorumlu = $this->Bildirim_Model->derssorumlusumu($this->session->no);
				  if($derssorumlu==TRUE)
				{
			
				 $bildir = $this->Bildirim_Model->bildirim_Getiralayi($this->session->no,$this->session->bolum_id);
				$bildirsayi = $this->Bildirim_Model->bildirim_Sayisialayi($this->session->no,$this->session->bolum_id);
			    $tumbildirimler = $this->Bildirim_Model->tumbildimleralayi($this->session->no,$this->session->bolum_id);
				$data['bildirim']=$bildir;
				$data['bildirim_sayisi']=$bildirsayi;
				$no=$this->session->no;
				$query=$this->Komisyon_Model->tbl_akademisyen_getir($no);
				//$global_data = array('akademisyen'=>$query);
				$global_data = array('bildirim'=>$bildir,'bildirimsayi'=>$bildirsayi,'tumbildirimler'=>$tumbildirimler,'akademisyen'=>$query,'derssorumlu'=>TRUE);
				$this->load->vars($global_data);
				$onayli=1;
				$onaylidegil=0;
				$result=$this->Komisyon_Model->tumogrencileri_getir($onayli,$this->session->bolum_id);
				$result2=$this->Komisyon_Model->tumogrencileri_getir($onaylidegil,$this->session->bolum_id);
				$global_data = array('onaylilar'=>$result,'onaybekleyenler'=>$result2);
				$this->load->vars($global_data);
				$no=$this->session->no;
				$query=$this->Komisyon_Model->tbl_akademisyen_getir($no);
				$global_data = array('akademisyen'=>$query);
				$this->load->vars($global_data);
				}
				else
				{
				$bildir = $this->Bildirim_Model->komisyon_bildirim_Getir($this->session->no,$this->session->bolum_id);
				$bildirsayi = $this->Bildirim_Model->komisyon_bildirim_Sayisi($this->session->no,$this->session->bolum_id);
				$tumbildirimler = $this->Bildirim_Model->tumbildimler($this->session->bolum_id);
				$data['bildirim']=$bildir;
				$data['bildirim_sayisi']=$bildirsayi;
				$global_data = array('bildirim'=>$bildir,'bildirimsayi'=>$bildirsayi,'tumbildirimler'=>$tumbildirimler,'derssorumlu'=>FALSE);
				$this->load->vars($global_data);
				   
				$onayli=1;
				$onaylidegil=0;
				$result=$this->Komisyon_Model->tumogrencileri_getir($onayli,$this->session->bolum_id);
				$result2=$this->Komisyon_Model->tumogrencileri_getir($onaylidegil,$this->session->bolum_id);
				$global_data = array('onaylilar'=>$result,'onaybekleyenler'=>$result2);
				$this->load->vars($global_data);
				$no=$this->session->no;
				$query=$this->Komisyon_Model->tbl_akademisyen_getir($no);
				$global_data = array('akademisyen'=>$query);
				$this->load->vars($global_data);
				}
			}
			
	  

       
   }
   
   
   	
}


?>