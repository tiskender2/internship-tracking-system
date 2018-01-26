<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Profil</h2>
            </div>
</header>   
         
    <div class="col-lg-12" style="padding-top: 51px;">
        <div class="card">
            <div class="card-body">

			 <div class="row col-sm-12" style="margin-left:auto;margin-right:auto;">
			  
				<div class="col-sm-3">
				 <form id="resimsec" method="post" action="<?=base_url();?>/profil/resimdegis/<?=$this->session->no?>" enctype='multipart/form-data' style="margin-bottom:0;" onSubmit="return validates();">
					<img src="<?=base_url();?>/application_resources/img/<?=$this->session->resim?>" style="height:200px; width:200px;"   alt="..." class="img-thumbnail">
						<div class="col-sm-12" style="margin-left:-15px" >
							<input id="resim" style="padding:10px 10px;" class="ozel-select"  name="resim" accept=".jpg, .jpeg, .png"  value="Resim Seç" type="file" data-validation="required imagee" style="margin:10px 15px;">
						<span id="file_error"></span>
						</div>
						<input type='submit' class='btn btn-info btn-sm' value='Resim Değiştir' style='margin-right:5px;'>
					</form>
				</div>
				
				<div class="col-sm-9" >
					<table class="table table-sm table-size">
						<tbody>
							
							<?php
							
								foreach($profilbilgisi as $row){
									if ($row->akademisyen_no == 0)
									{
										echo "<tr><th>Ders Sorumlusu :</th><td> Ders sorumlusu  Yok</td></tr>";
									}
									else
									{
									echo "<tr><th>Ders Sorumlusu :</th><td>".$row->ad_soyad."</td></tr>";
									}
									echo "<tr><th>Numarası :</th><td>".$row->ogrenci_no."</td></tr>";
									echo "<tr><th>Bölümü :</th><td>".$row->bolum_adi."</td></tr>";
									echo "<tr><th>E-posta :</th><td>".$row->email."</td></tr>";
									echo "<tr><th>Yapılacak Staj Gun Sayısı :</th><td>".$row->kalan_gun."</td></tr>";
									echo "<tr><th>Adres :</th><td>".$row->adres."</td></tr>";
									
									
									
									

							?>
							</tr>
								<?php } ?>
						</tbody>
					</table> 
		
				</div>
			 </div>
			  <div class="col-lg-12" style="padding-top: 51px;">
                  <div class="card" style="box-shadow:none;">
			 
					 <form id="sifredegistir" method="post" action="<?=base_url();?>profil/sifre_degis/<?=$this->session->no?>" enctype="multipart/form-data" style="margin-bottom:0;" onSubmit="return kontrol();">
						<div class="col-sm-12" >
							<label><b>Eski Şifre</b></label>
							<input id="eski_sifre" type="password" name="eski_sifre"  data-validation="required password" >
						</div>
						
						<div class="col-sm-12">
							<label><b>Yeni Şifre</b></label>
							<input id="yeni_sifre" type="password" name="yeni_sifre"   data-validation="required password" >
						</div>
						
						<div class="col-sm-12">
							<label><b>Şifre Tekrar</b></label>
							<input id="yeni_sifre_tekrar" type="password" name="yeni_sifre_tekrar" data-validation="required password"> 
						</div>
						
						<div class="col-sm-12" style="padding: 15px 15px;">
							<a name="btn_kayit" ><button name="btn_degis" id="btn_degis"  class="btn btn-sm btn-info">Şifreyi Değiştir</button> </a>
						</div>    	 

					</form>
					   <span class="col-sm-12 " id="file_error2"></span>
			      <?php 
					echo $this->session->flashdata('eskisifrehatasi');
					echo $this->session->flashdata('sifrehatasi');
				  ?>
			 
		</div>
	</div>
</div>
</div></div>
	<script>
	
$.validate({
  form : '#resimsec,#sifredegistir'
});	

function validates() {
	$("#file_error").html("");
	$(".input-material").css("border-color","#F0F0F0");
	var file_size = $('#resim')[0].files[0].size; 
	if(file_size>2097152) {
		$("#file_error").html("Resim 2MB'dan az olmalı");
		$("#file_error").css("color","red");
		return false;
	
	} 
	return true;
}
	</script>
	<script>
	function kontrol()
	{
	 sifre=$("#yeni_sifre").val();
	 resifre=$("#yeni_sifre_tekrar").val();
	 esifre=$("#eski_sifre").val();
	 if(sifre!=resifre)
	 {
		 $("#file_error2").html("Şifreler eşleşmiyor");
		$("#file_error2").css("color","red");
		return false;
	 }
	 
	 else
	 {
		 $("#file_error2").html("");
	 }
	 return true;
	}
	</script>
