 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Bütün Bildirimlerim</h2>
            </div>
  </header>   
       
         
<div class="col-lg-12" >
    <div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
				 <div class="card text-white">
					<div class="card-header" style="background-color:#2f333e;">
					<i class="fa fa-volume-up" aria-hidden="true"></i> Bildirimler </a>
					</div>
					<div class="card-body " style="background-color:transparent; padding:3px;">
						<ul class="list-group list-group-flush baslik">
						<?php
							foreach($bildirimler as $row){
					echo "<li class='list-group-item tolgaiskender '"; if($row->tiklandi==0){echo "style='background-color:rgb(238, 238, 238);' ";}  echo "style='background-color:white;'/>
					<a style='color:#000; text-decoration:none; font-weight: bold;'>".$row->baslik." </br> 
					<input type='hidden' id='tur' value=".$row->bildirim_tur.">
					<input type='hidden' id='tiklanma' value=".$row->id.">
					<span style='display:inline-block; font-size:14px; font-weight:normal;'>".$row->icerik."</span>
					<span style='float:right;position:absolute;display:inline-block; right:0;font-size:10px;'>".$row->gonderilme_tarih."</span></a></li>";
							}
						?>
						</ul>
					</div>
				</div>
				
				</div>
				
		
		
            </div> 
        </div>
    </div>
</div>
 <script> 
	  $(document).ready(function () {	
	  	$( ".tolgaiskender" ).click(function()
		{
			 var logintip="<?= $this->session->loginType ?>";
		 if (logintip == "Komisyonuye")
		 {
			   var ogrno=<?= $this->session->bolum_id ?>;	   
		 }
		 else{
			 var ogrno=<?= $this->session->no ?>;
		 }
			deger=$(this).find('#tur').val();
			tiklanma=$(this).find('#tiklanma').val();
			if(deger=="1")
			{
				window.location.href="<?php echo base_url(); ?>" + "Stajbasvuru/basvuru_kabul";
			}
			else if(deger=="2")
			{
				window.location.href="<?php echo base_url(); ?>" + "Sirketler";
			}
			else if(deger=="3") 
			{
				window.location.href="<?php echo base_url(); ?>" + "Stajbasvuru";
			}
			else if(deger=="4")
			{
				window.location.href="<?php echo base_url(); ?>" + "profil";
			}
			else if(deger=="5")
			{
				window.location.href="<?php echo base_url(); ?>" + "Denetmen/ogrenci_listele";
			}
			else if(deger=="6")
			{
				window.location.href="<?php echo base_url(); ?>" + "Komisyon/ogrenci_kayit";
			}
			console.log(deger);
			console.log(tiklanma);
			jQuery.ajax({
			 type: 'POST',
			 url: "<?php echo base_url(); ?>" + "Bildirim/bildirim_tikla", 
			 dataType: 'json',
			 data: {tikla:tiklanma}
			});
			
			
		});
		
		
		});
	  
	  </script>


				