<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Ders Sorumluları</h2>
	</div>
</header>
<div class="col-lg-12">
<?php
foreach($akademisyen as $row){
	$yetki=$row->yetki;
}
	if($yetki==1)
	echo '<div style="padding:10px 0">
		<a href="'.base_url().'Komisyon/DersSorumlusu_ekle"><input type="button" class="btn btn-info btn-sm" value="Ders Sorumlusu Ekle" style="margin-right:5px;"></a>
	</div>';
?>
	<div class="card">
		<div class="card-body">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>Ders Sorumlu No</th>
					    <th>Ders Sorumlu Adı</th>
						<th>Email</th>
						<th>Ünvan</th>
						<?php
							 if($yetki==1){
								echo "<th>Öğrenci Ata</th>";
								echo "<th>Kaldır</th>";
							 }
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($derssorumlulari);
						if ($count == "0")
						{
								echo'<td>Ders sorumlusu Bulunmamaktadır.</td>';
								 echo'<td></td>';
								 echo'<td></td>';
								 echo'<td></td>';
								if($yetki==1){
								echo "<td></td>";
								echo "<td></td>";
							 }
								
						}
						else
						{
							foreach($derssorumlulari as $row)
							{
								
								echo "<td id='a_no'>".$row->no."</input></td>";
								echo "<td>".$row->ad_soyad."</td>";
								echo "<td>".$row->email."</td>";
								echo "<td>".$row->unvan."</td>";
								
							 
							   if($yetki==1){
						   echo "<td><div class='col-md-12'> 
											<a href=".base_url()."Komisyon/OgrenciAta/".$row->no."/ class='col-md-3' ><button class='btn btn-success btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
											
									</div></td>";
							echo "<td><div class='col-md-12'> 
									<a class='col-md-3' ><button id='sorumlukaldir' class='btn btn-danger btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
									</div></td>";
							   }
								
								
								
							   
						 ?>
					</tr>
					<?php   
							}   
						}
					?>
					
				</tbody>
			</table>
		
		</div>
	</div>
</div>
<script>
$('#example').on('click', '#sorumlukaldir', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
	 console.log($idim);
        ssi_modal.confirm({
                    content: 'Ders Sorumlusunu kaldırmak istediğinizden emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/sorumlu_tablosundan_kaldir/'+$idim;
							
					}
                }
        );

    });

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