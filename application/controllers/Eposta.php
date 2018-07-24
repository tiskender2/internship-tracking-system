<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eposta extends MY_Controller {


	public function index()
	{
		redirect();
	}
	public function send_mail() { 
	require  "mailkutuphane/class.phpmailer.php";
	$mail = new PHPMailer(true);
	$mail->isSMTP();        
	$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";      // Connect using a TLS connection
	$mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
	$mail->Port = 465; // Gucenli baglanti icin 465 Normal baglanti icin 587
	$mail->IsHTML(true);
	$mail->SetLanguage("tr", "phpmailer/language");
	$mail->CharSet  ="utf-8";
	$mail->Username="tolgaiskendr@gmail.com"; // Mail adresimizin kullanicý adi
	$mail->Password="-----"; // Mail adresimizin sifresi
	$mail->SetFrom("tolgaiskendr@gmail.com", "KTU Staj Takip Uygulamasi Bilgilendirme"); // Mail attigimizda gorulecek ismimiz
	$mail->AddAddress("m.furkanozturkk@gmail.com"); // Maili gonderecegimiz kisi yani alici
	$mail->Subject = "Mesaj Basligi"; // Konu basligi
	$mail->Body = "sa ben tolga ÝSKENDER"; // Mailin icerigi
	if(!$mail->Send()){
    echo "Mailer Error: ".$mail->ErrorInfo;
	} 
	else {
    echo "Mesaj gonderildi";
	}
	
	} 

	
}
