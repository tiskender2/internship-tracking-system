<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Sorumlu Öğrencilerim</h2>
            </div>
          </header>   
       
        
<div class="col-lg-12" >
    <div class="card">
		<div class="card-body">
           <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
	                    <th>No</th>
	                    <th>Öğrenci Adı</th>
						<th>Telefon No</th>
						<th>Sınıf</th>
						<th>E-mail</th>
						<th>Kalan Gün</th>
						
			
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
							$count = count($ogrenciler);
							
							if ($count == "0")
							{
								echo "<td>Henüz öğrenciniz bulunmamaktadir!</td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";

							}
							else
							{
							
                             foreach($ogrenciler as $row){
								 
								echo "<td>".$row->ogrenci_no."</td>";
								echo "<td>".$row->ad_soyad."</td>";
								echo "<td>".$row->telefon."</td>";
								echo "<td>".$row->giris_yili."</td>";
								echo "<td>".$row->email."</td>";
								echo "<td>".$row->kalan_gun."</td>";
								

								 
                            ?>
					   </tr>
							<?php  } }?>
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
						title: 'Duyurular',
                        extend: 'print'
                        
                    }
                ]
            });
         });
</script>