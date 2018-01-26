 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Onaylanmayı Bekleyen Şirketler</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
	<?php
			$count = count($r_sirketler);
							
							if ($count != "0")
							{
								
							
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye")
		{
            echo "<div style='padding:10px 0;'>";
			echo "<a href=".base_url()."Sirketler/reddedilen_Sirketler><input type='button' class='btn btn-info btn-sm' value='Reddedilen Şirketler' style='margin-right:5px;'></a>";
			
			echo "</div>";
		}
							}
	?>
    <div class="card">
		<div class="card-body">
            <table class="table table-striped table-sm">
               <?php 
							$count = count($o_sirketler);
							
							if ($count != "0")
							{
								echo "    <thead>
                    <tr>
						<th>Öğrenci no</th>
	                    <th>Öğrenci ad soyad</th>
	                    <th>Adı</th>
	                    <th>Faaliyetalanı</th>
	                    <th>Mail</th>
	                    <th>Telefon</th>
	                    <th>Fax</th>
						<th>Adres</th>
						<th>Website</th>
						<th>Yetkili</th>
						<th>Yetkili Unvan</th>
						<th>Yetkili Mail</th>
                    </tr>
                </thead>";
								
							}
							?>
                <tbody>
                    <tr>
                        <?php 
							$count = count($o_sirketler);
							
							if ($count == "0")
							{
								echo "<td>Şuan Şirket bulunmamaktadir!</td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
							}
							else
							{
                             foreach($o_sirketler as $row){
								echo "<td>".$row->ogrenci_no."</td>";
								echo "<td>".$row->ad_soyad."</td>";
	                            echo "<td>".$row->stajyeri_ad."</td>";
	                            echo "<td>".$row->stajyeri_faaliyetAlan."</td>";
	                            echo "<td>".$row->stajyeri_mail."</td>";
	                            echo "<td>".$row->stajyeri_telefon."</td>";
								echo "<td>".$row->stajyeri_fax."</td>";
	                            echo "<td>".$row->stajyeri_adres."</td>";
	                            echo "<td>".$row->stajyeri_website."</td>";
	                            echo "<td>".$row->yetkili_adsoyad."</td>";
								echo "<td>".$row->yetkili_unvan."</td>";
	                            echo "<td>".$row->yetkili_mail."</td>";
	                           
								
                                
                           
                                if($this->session->loginType=="Denetmen" /*and $this->session->no==$row->a_no*/)
                                {
                                    echo "<td style='float:right;'><a href=".base_url()."Sirketler/sirket_Onayla/".$row->id."><input class='btn btn-warning btn-sm' type='submit' value='Onayla'/></a></td>";
                                    echo "<td >
									<input type='hidden' id='idsi' value='".$row->id."'>
									<a href=".base_url()."Sirketler/sirket_Red/".$row->id."><input id='sirket-reddet' class='btn btn-danger btn-sm' type='submit' value='Reddet'  /></a>
									</td>";
                                }
                                else if ($this->session->loginType=="Komisyonuye" ){
                                    echo "<td style='float:right;'><a href=".base_url()."Sirketler/sirket_Onayla/".$row->id."><input class='btn btn-warning btn-sm' type='submit' value='Onayla' /></a></td>";
                                    echo "<td>
									<input type='hidden' id='idsi' value='".$row->id."'>
									<a><input id='sirket-reddet' class='btn btn-danger btn-sm' type='submit' value='Reddet' /></a>
									</td>";
                                }
								
                            ?>
					   </tr>
  
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>
<script>
$('#example').on('click', '#sirket-reddet', function(){
	$idim = $(this).parents("td").find( "#idsi" ).val();
        ssi_modal.confirm({
                    content: 'Şirketi reddetmek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						window.location.href = '<?=base_url();?>Sirketler/sirket_Red/'+$idim;
					}
                }
        );

    });
</script>

