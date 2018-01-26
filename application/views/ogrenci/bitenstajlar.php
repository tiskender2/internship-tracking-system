<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Biten Stajlarım</h2>
	</div>
</header>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Staj Yeri</th>
					    <th>Başlama Tarihi</th>
					    <th>Bitiş Tarihi</th>
						<th>Yapılan Gün</th>
						<th>Kabul Gün</th>
					
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
				
					
							foreach($bitenstajlar as $row)
							{
								echo "<td>".$row->stajyeri_ad."</td>";
								echo "<td>".$row->baslama_tarih."</input></td>";
								echo "<td>".$row->bitis_tarih."</td>";
								echo "<td>".$row->staj_gun."</td>";
								echo "<td>".$row->kabul_gun."</td>";
								
							 

								
							   
						 ?>
					</tr>
					<?php     
						}
					
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
						title: 'Öğrenciler',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3]
                }
                    }
                ]
            });
         });
	
	
</script>