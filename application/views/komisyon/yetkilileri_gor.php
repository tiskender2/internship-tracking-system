<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Akademisyenler</h2>
	</div>
</header>
<div class="col-lg-12">
<?php 
						
			echo'<div style="padding:10px 0">
			<a href="'.base_url().'Komisyon/Komisyonuyeleri"><input type="button" class="btn btn-info btn-sm" value="Geri Dön" style="margin-right:5px;"></a>
		</div>';
						
?>
	<div class="card">
		<div class="card-body">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>No</th>
					    <th>Ad Soyad</th>
						<th>Email</th>
						<th>Ünvan</th>
						<th>Yetkiyi Geri Al</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($yetkililer);
						if ($count == "0")
						{
							echo'<td>Komisyon Uye  Bulunmamaktadır.</td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
								
								
						}
						else
						{
							foreach($yetkililer as $row)
							{
								echo "<td id='a_no'>".$row->akademisyen_no."</input></td>";
								echo "<td>".$row->ad_soyad."</td>";
								echo "<td>".$row->email."</td>";
								echo "<td>".$row->unvan."</td>";
								echo"<td><div class='col-md-12'> 
								<a  class='col-md-3' ><button id='yetkikaldir' class='btn btn-danger btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
								</div></td>";

									
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
$('#example').on('click', '#yetkikaldir', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
	 console.log($idim);
        ssi_modal.confirm({
                    content: 'Yetkiyi kaldırmak istediğinizden emin misiniz?',
                    okBtn: {
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/komisyon_uyeye_yetki_gerial/'+$idim;
							
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