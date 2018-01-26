<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Kabul Gün Girişi</h2>
	</div>
</header>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>Öğrenci No</th>
					    <th>Ad Soyad</th>
						<th>Yapılan Gün</th>
						<th>Kalan Gün</th>
						<th>Ayarlar</th>

					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($ogrenciler);
						if ($count == "0")
						{
							echo'<td>Kabul gün girişi bekleye öğrenci bulunmamaktadır</td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
						}
						else
						{
							foreach($ogrenciler as $row) 
							{
								if($row->akademisyen_no==$this->session->no){
									if($row->staj_defteri!='' and $row->anketform!=''){
										echo "<td>".$row->ogrenci_no."</td>";
										echo "<td>".$row->ad_soyad."</td>";
										echo "<td>".$row->staj_gun."</td>";
										echo "<td>".$row->kalan_gun."</td>";
											echo "<td><form action='".base_url()."Denetmen/staj_kabul_gun_giris/".$row->ogrenci_no."' method='post'  id='gungirisform'>
												<div class='col-md-12'> 
													<div class='row'>
													<div class='col-sm-9'><input type='number' class='form-control' name='kabul_gun' min='1' max='".$row->staj_gun."' placeholder='Kabul Gün' required></div>
													<div class='col-sm-3'><button name='btn_kabulgiris' class='btn btn-success btn-sm'  /><i class='fa fa-check' aria-hidden='true'></i></button></div>
												</div></div>
											</form></td>";
									
									}
									else{
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										  
									}
								}
								else{
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
								}
						 ?>
					</tr>
					<?php   
							}  
						}
					?>
				</tbody>
			</table>
			<?php 
			echo "<br><br>";
							$bosgirilmez=$this->session->flashdata('bosgirilmez');
							echo $bosgirilmez;
							$gunyanlis=$this->session->flashdata('gunyanlis');
							echo $gunyanlis;
			?>
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
						title: 'Staj Kabul Gün Girişi',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
                    }
                ]
            });
         });
</script>
