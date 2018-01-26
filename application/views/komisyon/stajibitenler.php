<header class="page-header">
	<div class="container-fluid">
						
		<h2 class="no-margin-bottom">Öğrenciler  
		
		
			<a class="pull-right">Staji Biten Öğrenciler</a>
		
		</h2>
	</div>
</header>
<div class="col-lg-12">
	<div style="padding:10px 0">
		
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<div class="row">
					<div class="col-sm-5">
						<select id="ogrenciler" class="form-control" style="height:auto;width:auto;" >
						
						  <option  value="TumOgrenciler">Tüm Öğrenciler</option>
						  <option  value="2012">2012-2013</option>
						  <option  value="2013">2013-2014</option>
						  <option  value="2014">2014-2015</option>
						</select>
					</div>
						
					
						
					</div>
				</div>
			
		<div class="col-sm-7">
			
		</div>
		</div>
			<br>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>Ögrenci No</th>
					    <th>Ögrenci Adı</th>
						<th>Telefon</th>
						<th>Sınıf</th>
						<th>Email</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($stajibitenler);
						if ($count == "0")
						{
								 echo'<td>Öğrenci Bulunmamaktadır.</td>';
								 echo'<td></td>';
								 echo'<td></td>';
								 echo'<td></td>';
								 echo'<td></td>';
						}
							
						
						else
						{
							foreach($stajibitenler as $row)
							{
								
								echo "<td><input type='hidden' name='no' id='ogrNo' value='".$row->ogrenci_no."'>".$row->ogrenci_no."</input></td>";
								echo "<td><input type='hidden' id='idsi' value='".$row->ogrenci_no."'>".$row->ad_soyad."</td>";
								echo "<td>".$row->telefon."</td>";
								echo "<td><input type='hidden' name='no' id='sinif' value='".$tum."'>".$row->giris_yili."</td>";
								echo "<td>".$row->email."</td>";
								
						 ?>
					</tr>
					<?php   
							}   
						}
					?>
					<script>
					var url = window.location.href;
							var params = url.slice(-4);
							$('#ogrenciler').val(params).attr('selected','select');
							
					</script>
						<script>
						$("#ogrenciler").change(function(){
							$sinif = $(this).children(":selected").val();
							window.location.href = '<?=base_url();?>Komisyon/StajiBitenler/'+$sinif;
							
								
						});
				
					
 
	
					</script>
					
					
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
                    columns: [0,1,2,3,4,5,6 ]
                }
                    }
                ]
            });
         });
		 
		
	
	
</script>
				</tbody>
			</table>
			
		</div>
	</div>
</div>