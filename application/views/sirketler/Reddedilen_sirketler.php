 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Reddedilen Şirketler</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
	
    <div class="card">
		<div class="card-body">
            <table class="table table-striped table-sm">
			<?php 
							$count = count($r_sirketler);
							
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
							$count = count($r_sirketler);
							
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
                             foreach($r_sirketler as $row){
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
								    echo "<td><a href=".base_url()."Sirketler/sirket_Askiyaal/".$row->id."><input class='btn btn-danger btn-sm' type='submit' value='Askıya Al' /></a></td>";
                                }
                                else if ($this->session->loginType=="Komisyonuye" ){
                                    echo "<td style='float:right;'><a href=".base_url()."Sirketler/sirket_Onayla/".$row->id."><input class='btn btn-warning btn-sm' type='submit' value='Onayla' /></a></td>";
									echo "<td><a href=".base_url()."Sirketler/sirket_Askiyaal/".$row->id."><input class='btn btn-danger btn-sm' type='submit' value='Askıya Al' /></a></td>";
                                }
								
                            ?>
					   </tr>
  
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>

