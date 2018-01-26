<?php 
if ($profil==0)
{
	echo '
 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Profil</h2>
            </div>
          </header>   
       
    <div class="col-lg-12" style="padding-top: 30px;">
	<div class="card">
                  <div class="card-body">
    <form action="'.base_url().'Profil/profil_Ekle_islemi/" method="post" id="kontrolyaz" class="form-horizontal" enctype="multipart/form-data">
	<br>
        <div class="row">
       
                
                <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Tc Kimlik No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="tc_no" type="text" data-validation="required tc" id="tc_no"  maxlength="11">
			</div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Nufus Cüzdanı Seri No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ncseri_no"  required="required">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Baba Adı</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="baba_adi" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Anne Adı</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ana_adi" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Doğum Yeri</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="dogum_yeri" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Doğum Tarihi</label>
           <div class="col-sm-8">
                        <div class="form-group">
                            <div class="col-xs-5 date">
                                <div class="input-group input-append date" id="datePickerdog">
                                    <input type="text" class="form-control" name="dogum_tarihi" required="required"/>
                                    <span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">İl</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="il" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">İlçe</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ilce" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
         <div class="form-group row">
            <label class="col-sm-4 form-control-label">Mahalle</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="mahalle" required="required" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Cilt No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="cilt_no" required="required" pattern="[0-9]*">
            </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 form-control-label">Aile Sıra No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ailesira_no" required="required" pattern="[0-9]*">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Sıra No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="sira_no" required="required" pattern="[0-9]*">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Verildiği Yer</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="verildigi_yer" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
         <div class="form-group row">
                    <label class="col-sm-4 form-control-label">Verildiği Tarih</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <div class="col-xs-5 date">
                                <div class="input-group input-append date" id="datePickerver">
                                    <input type="text" class="form-control" name="verildigi_tarih" required="required" />
                                    <span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Veriliş Nedeni</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="verilis_nedeni" required="required" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12" style="text-align: center;">
         <input type="submit" name="btn_ekle" class="btn btn-info btn-sm" value="Kaydet">
    </div>
</div>
    </form>
	'.  $this->session->flashdata('tc').'
</div>
</div>
</div>

';
}
else
{
	foreach($profilbilgisi as $row)
	{
	echo '
<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Profil</h2>
            </div>
          </header>   
       
         
    <div class="col-lg-12" style="padding-top: 51px;">
                  <div class="card">
                  <div class="card-body">
    
         <br><br>
		 <div class="row col-sm-11" style="margin-left:auto;margin-right:auto;">
			<div class="col-sm-3">
				<img src="'.base_url("application_resources/img/".$this->session->resim).'" style="height:200px; width:200px;"   alt="..." class="img-thumbnail">
			</div>
			<div class="col-sm-9" >

<table class="table table-sm table-size">
        <tbody>
          <tr>
            <td><b>Ders Sorumlusu</b></b></td>';
			if($row->akademisyen_no!=0)
			{
				echo'<td>'.$row->ad_soyad.'</td>';
			}
			else{
				echo'<td> Ders sorumlusu  Yok </td>';
			}
		
          echo'</tr>
		   <tr>
            <td><b>Numarası</b></td>
			 <td>'.$row->ogrenci_no.'</td>
          </tr>
		  <tr>
            <td><b>E-posta</b></td>
			 <td>'.$row->email.'</td>
          </tr>
		  <tr>
            <td><b>Bölümü</b></td>
			 <td>'.$row->bolum_adi.'</td>
          </tr>';
		  if($row->kalan_gun!=0)
		  {
			  echo'<tr>
				<td><b>Yapılacak Staj Gün Sayısı</b></td>
				<td>'.$row->kalan_gun.'</td>
				</tr>';
		  }
		  else
		  {
			   echo'<tr>
				<td><b>Yapılacak Staj Gün Sayısı</b></td>
				<td>Stajınız Tamamlanmıştır</td>
				</tr>';
		  }
		   
		  echo'<tr>
            <td><b>Adres</b></td>
			 <td>'.$row->adres.'</td>
          </tr>
           
        </tbody>
      </table> 
			</div>
		 </div>
		 <form id="kontrolguncelle" action="'.base_url().'Profil/profil_Guncelle_islemi/" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="row col-sm-11" style="margin-left:auto;margin-right:auto;">
		<div class="col-sm-12">
		<button type="button" id="btn-ac" class="btn btn-info btn-sm pull-right"><i id="guncelle_button" class="fa fa-lock" aria-hidden="true" style="float:right;"> Düzenle</i></button>
		<button type="button"  class="btn btn-info btn-sm pull-right" style="margin-right:5px; " ><a href="'.base_url().'Profil/ogrenci_profil_Guncelle/'.$this->session->no.'" class="fa fa-cog" aria-hidden="true" style="float:right; color:white;"> Profil Ayarları</a></button>
			
		</div>
                
                <div class="col-sm-6">
				<br>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Tc Kimlik No</label>
            <div class="col-sm-8">
			<input type="text" class="form-control p" name="tc_no" id="tc_no" data-validation="required tc" value="'.$row->tc_no.'" style="color:#aaaaaa;" disabled="disabled">
            
              
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Seri No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="ncseri_no" required="required" value="'.$row->nc_seriNo.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Baba Adı</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="baba_adi" required="required" value="'.$row->baba_ad.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Anne Adı</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="ana_adi" required="required" value="'.$row->ana_ad.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Doğum Yeri</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="dogum_yeri" required="required" value="'.$row->dogum_yeri.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
      <div class="form-group row" >
                    <label class="col-sm-4 form-control-label">Doğum Tarihi</label>
					<div class="col-sm-8 date">
                        		<div class="input-group input-append date" id="datePickerbasa" >
									<input type="text" class="form-control p" name="dogum_tarihi" required="required" value="'.$row->dogum_tarihi.'" style="color:#aaaaaa;" disabled>
                           			<span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span>
                        		</div>
                     		</div>
           
                </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">İl</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="il" required="required" value="'.$row->il.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">İlçe</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="ilce" required="required" value="'.$row->ilce.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
	<br>
         <div class="form-group row">
            <label class="col-sm-4 form-control-label">Mahalle</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="mahalle" required="required" value="'.$row->mahalle.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Cilt No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="cilt_no" required="required" value="'.$row->cilt_no.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 form-control-label">Aile Sıra No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="ailesira_no" required="required" value="'.$row->ailesira_no.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Sıra No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="sira_no" required="required" value="'.$row->sira_no.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Verildiği Yer</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="verildigi_yer" required="required" value="'.$row->verildigi_yer.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
		
         <div class="form-group row" >
                    <label class="col-sm-4 form-control-label">Verildiği Tarih</label>
					<div class="col-sm-8 date">
                        		<div class="input-group input-append date" id="datePickerbita" >
									<input type="text" class="form-control p" name="verilis_tarihi" required="required" value="'.$row->verildigi_tarih.'" style="color:#aaaaaa;" disabled>
                           			<span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span>
                        		</div>
                     		</div>
           
                </div>
        <div class="form-group row">
            <label class="col-sm-4 form-control-label">Veriliş Nedeni</label>
            <div class="col-sm-8">
                <input type="text" class="form-control p" name="verilis_nedeni" required="required" value="'.$row->verilis_nedeni.'" style="color:#aaaaaa;" disabled>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12" style="text-align: center;">
         <input type="submit" name="btn_guncelleme" id="btn_guncelle" style="visibility: hidden;" class="btn btn-info btn-sm" value="Güncelle">
		
    </div>
</div>
    </form>
</div>
</div>
</div>



';
	
	}
}
?>

	<script>
	
$.validate({
  form : '#kontrolguncelle,#kontrolyaz'
});	
	</script>
	<script>
	$("#btn-ac").click(function(){
		$( "#btn_guncelle" ).css("visibility","visible");
	});
	</script>
	