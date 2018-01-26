 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Reddedilmiş Başvurular</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
<?php 
echo "<a href=".base_url()."Stajbasvuru/basvuru_kabul><input type='submit' class='btn btn-info btn-sm' value='Geri Dön'/></a>";


?>
    <div class="card">
		<div class="card-body">
			 <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>

	                    <th>No</th>
	                    <th>Ad Soyad</th>
	                    <th>Başlama Tarihi</th>
	                    <th>Bitiş Tarihi</th>
	                    <th>Gün</th>
						<th>İşyeri Bilgileri</th>
						<th>Stajyeri Onay</th>
						<th>Başvuru Onayı</th>
						
	                    
						
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
					
							$count = count($reddedilmis);
							
							if ($count == "0")
							{
								echo "<td>Başvuru bulunmamaktadir!</td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								
							}
							else
							{
                             foreach($reddedilmis as $row){
	                            echo "<td>".$row->ogrenci_no."</td>";
	                            echo "<td>".$row->ad_soyad."</td>";
	                            echo "<td>".$row->baslama_tarihi."</td>";
	                            echo "<td>".$row->bitis_tarihi."</td>";
								echo "<td>".$row->staj_gun."</td>";
	                            echo "<td>".$row->stajyeri_ad."<a href=".base_url()."stajbasvuru/sirketBilgi/".$row->id."/".$row->ogrenci_no." class='col-md-3 pull-right' id='info-sirket' ><button class='btn btn-info btn-sm'/><i class='fa fa-eye' aria-hidden='true'></i></button></a> </td>";
	                            
								if($row->durum == 1){
								echo "<td><span class='badge badge-success'>Onaylı</span></td>";
								}
								else if($row->durum == 0){
								echo "<td><span class='badge badge-warning' style='color:#ffffff;'>Onay Bekleniyor</span></td>";
								}
								else if($row->durum == 2){
								echo "<td><span class='badge badge-danger' style='color:#ffffff;'>Reddedildi</span></td>";
								}
								echo "<td><span class='badge badge-danger'>Reddedildi</span></td>";
                            ?>
					   </tr>
  
							<?php  } }	

							?>
		
                </tbody>
				
            </table>
        </div>

    </div>
</div>
<script>
 $.extend( $.fn.dataTable.defaults, {
          responsive: true
         } );
	$(document).ready(function() {
         
				
				$('#example').DataTable({
                dom: 'Bfrtip',
				extend: 'print',
                buttons: [
                    {
						title: 'Reddedilmiş Başvurular',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
                    }
                ]
            });
         });
</script>
