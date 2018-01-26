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
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
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
                </thead>
                <tbody>
                    <tr>
                        <?php 
							$count = count($sirketler);
							
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
                             foreach($sirketler as $row){
								
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
                                    echo "<td style='float:right;'><a href=".base_url()."Sirketler/sirket_Guncelle/".$row->id."><input class='btn btn-warning btn-sm' type='submit' value='Düzenle'/></a></td>";
                                    echo "<td ><a href=".base_url()."Sirketler/sirket_Sil/".$row->id."><input class='btn btn-danger btn-sm' type='submit' value='Sil'  /></a></td>";
                                }
                                else if ($this->session->loginType=="Komisyonuye" ){
                                    echo "<td style='float:right;'><a href=".base_url()."Sirketler/sirket_Guncelle/".$row->id."><input class='btn btn-warning btn-sm' type='submit' value='Düzenle' /></a></td>";
                                    echo "<td><a href=".base_url()."Sirketler/sirket_Sil/".$row->id."><input class='btn btn-danger btn-sm' type='submit' value='Sil' 	 /></a></td>";
                                }
								
                            ?>
					   </tr>
  
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>

