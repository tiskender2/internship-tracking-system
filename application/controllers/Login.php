<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	
  public function __construct(){
    parent::__construct();
    $this->load->model('Login_Model'); 
    $this->load->model('profil_Model'); 
	$this->load->model('Komisyon_Model');	
	$this->load->model('Bildirim_Model');	
	$this->load->model('Duyuru_Model');	
	$this->load->library('encrypt');
	$this->load->library('upload');
	$this->load->helper(array('form', 'url'));

  }
 	public function disduyuru($id){
		$query=$this->Duyuru_Model->anasayfa_duyuru($id);
		$data['duyurular']=$query;
		$this->load->view('disduyuru',$data);

	}
	
	public function tumdisduyurular(){
		$result = $this->Duyuru_Model->duyuru_Getir();
		$data['duyurular']= $result;
		$this->load->view('tumdisduyurular',$data);
	}
	

   //public function login_Control(){
    public function logincontrol_ogrenci(){
    if(isset($_POST['btn_login'])){

        $email  = $this->input->post('email');
        $sifre  = $this->input->post('sifre');
        $result = $this->Login_Model->login_Db_Control($email,$sifre);
		$result2= $this->Login_Model->kayit_durum_getir($email,$sifre);
		$result3= $this->Login_Model->logintip($email,$sifre);
		
		$loginType='';
		foreach($result3 as $row3){
			$loginType=$row3->loginType;
		}
		$kayit_durum=0;
		foreach($result2 as $row2){
			$kayit_durum=$row2->kayit_durum;
		}

        if($result and $loginType=="Ogrenci"){
			
				if($loginType=='Ogrenci' and $kayit_durum==0)
				{
				  $sess_data2=array('kayit_durum'  =>TRUE);
				  $this->session->set_userdata($sess_data2);
				}
				
				
          foreach ($result as $row) {
            $ad_soyad="";
			$bolum_id="";
            if($row->loginType=='Komisyonuye' or $row->loginType=='Denetmen'){
              $ad_soyad=$row->a_ad_soyad; 
			  $bolum_id=$row->a_bolum_id;
              echo $ad_soyad;
            }
            else if ($row->loginType=="Ogrenci"){
              $ad_soyad=$row->o_ad_soyad;
			  $bolum_id=$row->o_bolum_id;
              echo $ad_soyad;
            }

            $no="";
            if($row->loginType=='Komisyonuye' or $row->loginType=='Denetmen'){
              $no=$row->a_no; 
              echo $no;
            }
            else if ($row->loginType=="Ogrenci"){
              $no=$row->o_no;
              echo $no;
            }

            $sess_data=array('ad_soyad'       => $ad_soyad,
                             'loginType'      => $row->loginType,
                             'unvan'          => $row->unvan,
                             'resim'          => $row->resim,
                             'no'             => $no,
							 'bolum_id'       => $bolum_id,
                             'login'          => TRUE);
          }
          $this->session->set_userdata($sess_data);
          
		$profil = $this->profil_Model->profil_varmi($no);

		  if($this->session->kayit_durum == TRUE)
		  {
			  redirect("profil");	
		  }
          if($profil!=TRUE and $row->loginType=='Ogrenci'){
			//$this->session->set_flashdata('profil',$profil);
            
			redirect("profil");			
          }
		
          else
          {
			redirect("Ana/anasayfa"); 
          }
        }
        else {  $this->session->set_flashdata("hatalıgiris","E-mail veya şifre yanlış girildi"); redirect();  }
      
     
    }
  }
  
  public function logincontrol_akademisyen(){
    if(isset($_POST['btn_login'])){

        $email  = $this->input->post('email');
        $sifre  = $this->input->post('sifre');
        $result = $this->Login_Model->login_Db_Control($email,$sifre);
		$result2= $this->Login_Model->kayit_durum_getir($email,$sifre);
		$result3= $this->Login_Model->logintip($email,$sifre);
		
		$loginType='';
		foreach($result3 as $row3){
			$loginType=$row3->loginType;
		}
		$kayit_durum=0;
		foreach($result2 as $row2){
			$kayit_durum=$row2->kayit_durum;
		}

        if($result and ($loginType=="Denetmen" or $loginType=="Komisyonuye")){
			
				if($loginType=='Ogrenci' and $kayit_durum==0)
				{
				  $sess_data2=array('kayit_durum'  =>TRUE);
				  $this->session->set_userdata($sess_data2);
				}
				
          foreach ($result as $row) {
            $ad_soyad="";
			$bolum_id="";
            if($row->loginType=='Komisyonuye' or $row->loginType=='Denetmen'){
              $ad_soyad=$row->a_ad_soyad; 
			  $bolum_id=$row->a_bolum_id;
              echo $ad_soyad;
            }
            else if ($row->loginType=="Ogrenci"){
              $ad_soyad=$row->o_ad_soyad;
			  $bolum_id=$row->o_bolum_id;
              echo $ad_soyad;
            }

            $no="";
            if($row->loginType=='Komisyonuye' or $row->loginType=='Denetmen'){
              $no=$row->a_no; 
              echo $no;
            }
            else if ($row->loginType=="Ogrenci"){
              $no=$row->o_no;
              echo $no;
            }

            $sess_data=array('ad_soyad'       => $ad_soyad,
                             'loginType'      => $row->loginType,
                             'unvan'          => $row->unvan,
                             'resim'          => $row->resim,
                             'no'             => $no,
							 'bolum_id'       => $bolum_id,
                             'login'          => TRUE);
          }
          $this->session->set_userdata($sess_data);
          
		$profil = $this->profil_Model->profil_varmi($no);

		  if($this->session->kayit_durum == TRUE)
		  {
			  redirect("profil");	
		  }
          if($profil!=TRUE and $row->loginType=='Ogrenci'){
			//$this->session->set_flashdata('profil',$profil);
            
			redirect("profil");			
          }
		
          else
          {
			redirect("Ana/anasayfa"); 
           
          }
  
					
        }
        else {  $this->session->set_flashdata("hatalıgiris","E-mail veya şifre yanlış girildi"); redirect();  }
      
     
    }
  }
  
  
  
  
  
  public function ogrenci_kayit(){
	$result=$this->Login_Model->bolum_getir();
	$data['bolum']=$result;
	$this->load->view('kayitol',$data);	
  }
   public function sifremiunuttum(){
	$this->load->view('sifremiunuttum');	
  }
	public function kayit_ol_gonder(){
			
		if(isset($_POST['btn_kayit'])){
			
				$ogr_no		= $this->input->post('ogr_no');
				$ad_soyad 	= $this->input->post('ad_soyad');
				$telefon 	= $this->input->post('telefon');
				$sinif 		= $this->input->post('sinif');
				$adres 		= $this->input->post('adres');
				$email 		= $this->input->post('email');
				$sifre 		= $this->input->post('sifre');
				$bolum		= $this->input->post('bolum');
				$kayit_durum=0;
				$unvan 		= 'Öğrenci';
				$loginType	= 'Ogrenci';
				print_r($telefon);
				$ilktarih=explode("-",$sinif);
				$bugununtarih=date("Y");
				$vtye_eklencek_sinif=$bugununtarih-$ilktarih[0];
				
				//////////////////////////
				$email_kontrol=$this->Login_Model->no_getir($email); //email kontrolu icin
				$ogrno_kontrol=$this->Login_Model->ogrno_kontrol($ogr_no);
				$ogr_tblogr	  =$this->Login_Model->ogrno_kontrol_tblogr($ogr_no);
				
				if(count($email_kontrol)==0 && count($ogrno_kontrol)==0 && count($ogr_tblogr)==0){
					
						$tarih=date("Y-m-d");
						$baslik="Yeni Bir Kayit Var !";
						$icerik="$ad_soyad sisteme kayit oldu";
						$data2 = array('ogrenci_no' =>$bolum,
				    	 'baslik' 	     =>$baslik,
						 'bolum_id'      =>$bolum,
	  					 'icerik'	     =>$icerik,
						 'bildirim_tur'  =>"6",
	  				     'durum'  		 =>"1",
						 'gonderilme_tarih' =>$tarih
							);
					$this->Bildirim_Model->bildirim_ekle($data2);

	//	$slider["Image"]=$resimAdi;
/////////////////////////////////////
							

							$data= array(
										 'ogrenci_no' 	=> $ogr_no,
										 'ad_soyad'		=> $ad_soyad,
										 'bolum_id'	    => $bolum,
										 'telefon'  	=> $telefon,
										 'giris_yili' 	=> $sinif,
										 'sinif'		=> $vtye_eklencek_sinif,
										 'adres'  		=> $adres,
										 'kayit_durum'  => $kayit_durum,
										 'akademisyen_no'=> "0"
										);
								
								$resimAdi=uniqid().".jpg";
			  		$config['upload_path']          = './application_resources/img/';
	                $config['allowed_types']        = 'jpg|png';
	                $config['max_size']             = 2097152;
	                $config['max_width']            = 9999;
	                $config['max_height']           = 9999;
	                $config['file_name']			=$resimAdi;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ( ! $this->upload->do_upload('resim'))
										{
												$error = array('error' => $this->upload->display_errors());
											   // printf(base_url().'application_resources/img/');
										
												echo 'ad';
												printf(json_encode($error));
												   
										}
										else
										{ 
											$data3 = array('upload_data' => $this->upload->data());
										/*		   echo '<pre>';
											print_r($data3);
											echo print_r($resimAdi);
											echo '</pre>';*/
											
											
										}
										$data2= array(
										 'no' 			=> $ogr_no ,
										 'email' 		=> $email ,
										 'sifre'		=> $sifre ,
										 'unvan' 		=> $unvan ,
										 'loginType'	=> $loginType,
										 'resim'        => $resimAdi
										 );		
							$kemail=$this->Login_Model->email_Kontrol($email);
							if($kemail == TRUE)
							{
								$this->session->set_flashdata("mailvar","Mail adresiniz sistemimizde bulunmaktadır lütfen baska eposta ile kayit olunuz!");
								redirect();
							}
							else
							{
								$this->Login_Model->ogrenci_tablosuna_yukle($data);
								$this->Login_Model->kullanicilar_tablusona_yukle($data2);
								$this->session->set_flashdata("basarili","Başarıyla Kayıt Oldunuz");
								redirect();
							}
			
				
				}
				else 
					$this->session->set_flashdata("email_ogrno_var","Bu e-mail veya Ogrenci no sistemimizde bulunmaktadır");
					redirect();

		}
	}
	
	 public function emailkontrol()
	 {
		 if(isset($_POST['btn_unuttum'])){
      $this->form_validation->set_rules('email',"Email","required");

      if ($this->form_validation->run()==TRUE) {
	      $email  = $this->input->post('email');
		  $emailvarmi= $this->Login_Model->email_Kontrol($email);
		
		  if($emailvarmi == TRUE)
		  {
	$semail=$this->encrypt->encode($email);
		$tarih = date('Y-m-d');
	$semail=str_replace(array('+', '/', '='), array('-', '_', '~'), $semail);
		   $message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></html><body>';
		$message .='<p>Merhaba,</p>';
		$message .='<p> '.$tarih.' tarihinde sifreni sifirlamak icin bizden yardim isteginde bulundun! <strong><a href="'.base_url() .'Login/sifredegistir/'.$semail.'">
							 buraya </a></strong> tıklayarak sifreni sifirlayabilirsin!';
		$message .='<p>Of Teknoloji Fakültesi/Staj Takip Sistemi</p>';
	require  "mailkutuphane/class.phpmailer.php";
	$mail = new PHPMailer(true);
	$mail->isSMTP();        
	$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
	$mail->SMTPAuth = true;
	$mail->Host     = 'smtp.yandex.com.tr';
	$mail->SMTPSecure = 'ssl';
	$mail->Port =465;// Gucenli baglanti icin 465 Normal baglanti icin 587
	$mail->IsHTML(true);
	$mail->SetLanguage("tr", "phpmailer/language");
	$mail->CharSet  ="utf-8";
	$mail->Username="ktustajtakip@yandex.com"; // Mail adresimizin kullanicı adi
	$mail->Password="kst123456"; // Mail adresimizin sifresi
	$mail->SetFrom("ktustajtakip@yandex.com", "KTU Staj Takip Uygulamasi Bilgilendirme"); // Mail attigimizda gorulecek ismimiz
	$mail->AddAddress($email); // Maili gonderecegimiz kisi yani alici
	$mail->Subject = "Şifre Değiştirme"; // Konu basligi
	$mail->Body = $message; // Mailin icerigi
	if(!$mail->Send()){
    echo "Mailer Error: ".$mail->ErrorInfo;
	} 
	else {
	$this->session->set_flashdata('mailebak','Lütfen Mailinizi kontrol ederek şifre değiştirme işlemini gerçekleştiriniz.');
    redirect();
	}
	

		  }
		  else
		  {
				$data['email']="E-posta adresiniz kayitlarimizda bulunulamadı !"; 
				$this->load->view('sifremiunuttum',$data); 
		  }
	 
	 }
	 else
	 {
		$data['emailbos']="Lütfen geçerli E-posta giriniz !"; 
		$this->load->view('sifremiunuttum',$data); 
	 }
	 }
	 }
	public function sifredegistir($email)
	 {   
		  $dec_username=str_replace(array('-', '_', '~'), array('+', '/', '='), $email);
		  $kemail=$this->encrypt->decode($dec_username);
		  $emailvarmi= $this->Login_Model->email_Kontrol($kemail);

		 if (isset($email)) {
		       if($email == $emailvarmi)
			   {
				$data = array('email' =>$kemail ,'action'=>base_url() . 'Login/sifreguncelle' );
				$this->load->view("sifremidegistir",$data);
			   }
			   else{
				   echo '<h3>Anasayfaya yönlendiriliyorsunuz</h3>';
				   // header("refresh: 2; url='".base_url()."Ana'");
				 
			   }
		    
		}
		else {
			$data["action"] = base_url() . 'Login/sifremiunuttum';
			$data["message"]="Gönderdiğiniz link de bir problem oldu lütfen tekrar şifre sıfırlama isteği gönderin!";
			$this->load->view('sifremiunuttum',$data);
		}

	 }
  	 	public function sifreguncelle()
	 {
		
	 if(isset($_POST['btn_guncelle'])){
			 
      $this->form_validation->set_rules('email',"Email","required");
	  $this->form_validation->set_rules('pass',"Email","required");
	  $this->form_validation->set_rules('repass',"Email","required");

      if ($this->form_validation->run()==TRUE) {
	      $email  = $this->input->post('email');
		  $pass  = $this->input->post('pass');
		  $repass  = $this->input->post('repass');
		   $emailvarmi= $this->Login_Model->email_Kontrol($email);
		  if($emailvarmi == FALSE)
		  {
			  $data = array('email' =>$email,'yok'=>'Eposta adresi sistemimizde bulunulamadı !');
			  $this->load->view("sifremidegistir",$data);
		  }
		 else  if($pass != $repass)
		  {
			  $data = array('email' =>$email,'sifre'=>'Şifreler uyuşmuyor lütfen kontrol ediniz !');
			  $this->load->view("sifremidegistir",$data);
		  }
		  else
		  {
			   $no=$this->Login_Model->no_getir($email);
			   foreach($no as $row)
			   {
				   $ogr_no=$row->no;
			   }
			   $data= array('sifre' => $pass);
			 $this->Login_Model->sifre_guncelle($ogr_no,$data);
			 
	$this->session->set_flashdata('sifre','Şifreniz Başarıyla güncellendi giriş yapabilirsiniz');
    redirect();
		  }
		  
		}
  

	}		
	 }
	

}
?>