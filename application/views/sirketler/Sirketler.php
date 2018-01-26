 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Şirketler</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
	<?php
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye")
		{
            echo "<div style='padding:10px 0;'>";
			echo "<a href=".base_url()."Sirketler/sirket_Ekle><input type='button' class='btn btn-info btn-sm' value='Şirket Ekle' style='margin-right:5px;'></a>";
			
			echo "</div>";
		}
	?>
    <div class="card">
		<div class="card-body">
			<div class="row">
		<?php
			foreach($sirketler as $row){
				echo "
				<div id='sirket' class='card' style='width: 20rem; margin:5px;'>
				";
				 if($this->session->loginType=="Denetmen" or $this->session->loginType=="Komisyonuye")
                                {
				echo "
		
				<a><button  class='close modal2' aria-label='Close' value='".$row->id."' style='position: absolute; float: right; right: 0; margin-right:2px; color:#ffffff; opacity:1; top:4px;'>
				<span aria-hidden='true' >&times;</span>
				</button> </a>";
				
				
				echo "
				<a href=".base_url()."Sirketler/sirket_Guncelle/".$row->id.">
				<button type='button' class='close' data-dismiss='modal' aria-label='Close' style='position: absolute; float: left; left: 0; margin-left:2px; color:#ffffff; opacity:1;'>
				<span aria-hidden='true' ><i style='font-size:13px; margin-left:2px;' class='fa fa-pencil' aria-hidden='true'></i></span>
				</button></a>";
								}
	echo "
		<div style='background-image:url(".base_url()."application_resources/img/sirketresim.jpg); width:100%; height:200px; padding:3px; ' >
		<h2 style='margin-top:15%; text-align:center; color:#ffffff;'>".$row->stajyeri_ad."</h2>
		</div>	
  <div class='card-block' style='height:100%;'>
    <h4 class='card-title' style='margin-top:10px;'>".$row->stajyeri_faaliyetAlan."</h4>
    <p class='card-text' >".$row->stajyeri_adres."</p>
    <a href='http://".$row->stajyeri_website."' title='dasd' style='position:absolute; bottom:0; margin:5px 5px;' class='btn btn-info'>Web Sayfasına Git</a>
  </div>
</div>";
		

		
			}
		?>
		
            </div> 
        </div>
    </div>
</div>
 <script>
$( ".modal2" ).click(function() {
	$sirket_id = $(this).val();
	console.log($sirket_id);
        ssi_modal.confirm({
                    content: 'Şirketi silmek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						window.location.href = '<?=base_url();?>Sirketler/sirket_Sil/'+$sirket_id;
					}
                }
        );
    });
</script>
