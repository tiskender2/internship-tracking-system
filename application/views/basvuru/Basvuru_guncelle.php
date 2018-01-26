<?php
   $tarihhatasi=$this->session->flashdata('tarihhatasi');
   if ($tarihhatasi != null)
   {
   	echo'<script>alert("'.$tarihhatasi.'")</script>';
   }
   				
   foreach($basvurular as $row)
   {
   	
   ?>
<header class="page-header">
   <div class="container-fluid">
      <h2 class="no-margin-bottom">Başvuru Güncelle</h2>
   </div>
</header>
<div class="col-lg-11 padding-header">
   <div class="card">
      <div class="card-body">
         <div class="col-sm-12">
            <?php if($staj_durum == 2 || $staj_durum == 0)
               {
               	echo'<button type="button" class="btn btn-info btn-sm pull-right"><i id="guncelle_button" class="fa fa-lock" aria-hidden="true" style="float:right;"> Düzenle</i></button>';
               }
               
               ?>
         </div>
         <?php if(($staj_durum == 2 and $row->durum==0) or ($staj_durum == 2 and $row->durum==2))
            {
            	echo'<form id="gonder" class="form-horizontal" method="post" action="'.base_url().'stajbasvuru/basvuru_YenidenGonder_islemi/'.$id2.'/'.$row->id.'">';
            }
			else if($staj_durum == 2 and $row->durum==1)
			{
				echo'	<form id="gonder" class="form-horizontal" method="post" action="'.base_url().'stajbasvuru/basvuru_YenidenGonder_islemi_onayli/'.$id2.'">';
			}
            else
            {
            	echo'	<form id="gonder" class="form-horizontal" method="post" action="'.base_url().'stajbasvuru/basvuru_Guncelle_islemi/'.$id2.'/'.$row->id.'">';
            }
            ?>
            <h6 id="exampleModalLabel" class="modal-title">Yetkili Bilgileri</h6>
            <hr>
            <br>
            <div class="form-group row">
               <label class="col-sm-4 form-control-label">Staja Başlama Tarihi</label>
               <div class="col-sm-8">
                  <div class="form-group">
                     <div class="col-xs-5 date">
                        <div class="input-group input-append date" id="datePickerbasgun">
                           <input type="text" class="form-control a b" name="baslama_tarih" required="required" value='<?=$row->baslama_tarihi?>'>
                           <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="line"></div>
            <div class="form-group row">
               <label class="col-sm-4 form-control-label">Staj Bitiş Tarihi</label>
               <div class="col-sm-8">
                  <div class="form-group">
                     <div class="col-xs-5 date">
                        <div class="input-group input-append date" id="datePickerbitgun">
                           <input type="text" class="form-control a b" name="bitis_tarih" required="required" value='<?=$row->bitis_tarihi?>'>
                           <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="line"></div>
            <div class="form-group row">
               <label class="col-sm-4 form-control-label">Süresi(Gün)</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control a b" name="staj_suresi" id ="gun" data-validation="required gun" value='<?=$row->staj_gun?>'>
               </div>
            </div>
            <br><br>
            <div class="row">
               <?php 
                  echo'<div class="col-sm-6">
                  <h6 id="exampleModalLabel" class="modal-title">Şirket Bilgileri <i id="checked" class="fa fa-check-circle" style="color:#28a745; visibility:hidden; font-size:16px;" aria-hidden="true"></i></h6>
                  <hr>
                  <br>
                  <form action="<?= base_url();?>Stajbasvuru/ogrenci_sirket_ekle/" method="post" class="form-horizontal" enctype="multipart/form-data">
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Kurumun Adı *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_ad" required="required" id="sirket_ad" value="'.$row->stajyeri_ad.'">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Adresi *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_adresi" required="required" id="sirket_adresi" value="'.$row->stajyeri_adres.'">
                  </div>
               </div>
               <div class="line"></div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Hizmet Alanı *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_alan" required="required" id="sirket_alan" value="'.$row->stajyeri_faaliyetAlan.'">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Telefon No *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_tel" id="phone" required="required" id="sirket_tel "value="'.$row->stajyeri_telefon.'">
                  </div>
               </div>
               <div class="line"></div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Faks No *</label>
                  <div class="col-sm-8">
                     <input <input type="text"  class="form-control a" name="sirket_faks" required="required" id="phone" value="'.$row->stajyeri_fax.'">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">E-posta *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_mail" required="required" id="sirket_mail" data-validation="required emaill" value="'.$row->stajyeri_mail.'">
                  </div>
               </div>
               <div class="line"></div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Web Adresi *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="sirket_web" required="required" id="sirket_web" data-validation="required url" value="'.$row->stajyeri_website.'">
                  </div>
               </div>
            </div>
            <!-- col-sm-6 -->
            <div class="col-sm-6">
               <h6 id="exampleModalLabel" class="modal-title">Yetkili Bilgileri <i id="checked2" class="fa fa-check-circle" style="color:#28a745; visibility:hidden; font-size:16px;" aria-hidden="true"></i></h6>
               <hr>
               <br>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Yetkili Adı *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="yetkili_ad" required="required" id="yetkili_ad" value="'.$row->yetkili_adsoyad.'">
                  </div>
               </div>
               <div class="line"></div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">Görev Ve Unvanı *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="yetkili_unvan" required="required" id="yetkili_unvan" value="'.$row->yetkili_unvan.'">
                  </div>
               </div>
               <div class="line"></div>
               <div class="form-group row">
                  <label class="col-sm-4 form-control-label">E-Posta *</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control a" name="yetkili_mail" required="required" id="yetkili_mail" data-validation="required emaill" value="'.$row->yetkili_mail.'">
                  </div>
               </div>
            </div>
            <!-- col-sm-6 -->';
            ?>
            <?php }?>
      </div>
      <!-- row-->
   </div>
   <div class="form-group row">
   <div class="col-sm-7 text-right">
   <?php 

      if(($staj_durum == 2 or $staj_durum == 0)  and ($row->durum == 0 || $row->durum == 2))
      {
		echo '<input id="stajDurum" type="hidden" value="2">';
      	echo '<input id="stajyeriDurum" name="onayli" type="hidden" value="0">';
		  if ($row->durum == 2){
			  echo'<input id="btn_tekrarBasvuru" type="submit" class="btn btn-info btn-sm"  style="visibility: hidden;" value="Başvuruyu Tekrar Gönder" name="btn_tekrargonder">';
		  }
		  else{
			  echo'<input id="btn_tekrarBasvuru" type="submit" class="btn btn-info btn-sm"  style="visibility: hidden;" value="Başvuruyu Güncelle" name="btn_Basvuruguncelle">';

		  }
      	
      	
      }
	 
      else if(($staj_durum == 2 or $staj_durum == 0) and $row->durum == 1 )
      {
      	echo '<input id="stajDurum" type="hidden" value="2">';
      	echo '<input id="stajyeriDurum" name="onayli" type="hidden" value="1">';
		if ($staj_durum == 2){
			  echo'<input id="btn_tekrarBasvuru" type="submit" class="btn btn-info btn-sm"  style="visibility: hidden;" value="Başvuruyu Tekrar Gönder" name="btn_tekrargonder_onayli">';
		  }
		  else{
			  echo'<input id="btn_tekrarBasvuru" type="submit" class="btn btn-info btn-sm"  style="visibility: hidden;" value="Başvuruyu Güncelle" name="btn_Basvuruguncelle">';
		  }
      }
      else
      {
      	echo'<input type="submit" class="btn btn-info btn-sm" value="Başvuru Güncelle" name="btn_Basvuruguncelle">';
      }
      
      ?>
   </div>
   </div>
   </form>
</div>
</div>
</div>
	<script>
	
$.validate({
  form : '#gonder'
});	
	</script>