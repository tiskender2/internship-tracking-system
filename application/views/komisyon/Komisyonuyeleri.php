<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Akademisyenler</h2>
	</div>
</header>
<div class="col-lg-12">
<?php foreach($akademisyen as $row)			
	{
		$baskan=$row->baskan;
		$yetki=$row->yetki;
	}
						
	if($yetki=="1")
		{
		echo'<div style="padding:10px 0;';if($baskan==1){echo 'float:left;';} echo '">';
			echo '<a href="'.base_url().'Komisyon/Komisyonuye_ekle"><input type="button" class="btn btn-info btn-sm" value="Komisyon Üye Oluştur" style="margin-right:5px;"></a>
		</div>';
		}
	
	if($baskan=="1")
		{
		echo'<div style="padding:10px 0; float:left;">
			<a href="'.base_url().'Komisyon/yetkilileri_gor"><input type="button" class="btn btn-info btn-sm" value="Yetkilileri Gör" style="margin-right:5px;"></a>
		</div>';
		echo'<div style="padding:10px 0;">
		<a href="'.base_url().'Komisyon/komisyon_uye_gor"><input type="button" class="btn btn-info btn-sm" value="Komisyon Üyelerini Gör" style="margin-right:5px;"></a>
		</div>';
		}
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
						
						<?php
						if($yetki=="1")
						{
							
							echo '<th>Ders Sorumlusu Ata</th>';
							if($baskan==1){
							echo '<th>Yetki Ver</th>';
							echo '<th>Komisyona Ekle</th>';
							echo '<th>Komisyon Başkanı Yap</th>';
							echo '<th>Üyeyi Sil</th>';
							}
						}						
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($komisyonuyeleri);
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
							foreach($komisyonuyeleri as $row)
							{
								$uyebasgandurum=$row->baskan;
								echo "<td id='a_no'>".$row->akademisyen_no."</td>";
								if($uyebasgandurum=="1")echo "<td>".$row->ad_soyad."<span style='font-size:9px;'>(Başkan)</span></td>";else echo "<td>".$row->ad_soyad."</td>";
								echo "<td>".$row->email."</td>";
								echo "<td>".$row->unvan."</td>";
								if($yetki=="1")
								{
									
									if($row->sorumlumukontrol!=$row->akademisyen_no)
									echo"<td><div class='col-md-12'> 
								  <a class='col-md-3' ><button id='sorumluata' class='btn btn-warning btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
									</div></td>";
									else echo "<td><center><span class='badge badge-info'>Atandı</span></center></td>";
									if($baskan==1){
										if($uyebasgandurum!="1"){
												if($row->yetki==0){
													echo"<td><div class='col-md-12'> 
													  <a class='col-md-3' ><button id='denetmenata' class='btn btn-warning btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
													</div></td>";
												}else
													echo "<td><center><span class='badge badge-info'>Yetkili</span></center></td>";

											if($row->loginType!="Komisyonuye")
											echo"<td><div class='col-md-12'> 
											<a  class='col-md-3' ><button id='komisyonaekle' class='btn btn-success btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
											</div></td>";
										else
											echo "<td><center><span  class='badge badge-info'>Üye</span></center></td>";
												
											echo"<td><div class='col-md-12'> 
											  <a class='col-md-3' ><button id='komisyonbaskaniyap' class='btn btn-success btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
											</div></td>";
											echo"<td><div class='col-md-12'> 
								  <a class='col-md-3' ><button id='komiyonuyesil' class='btn btn-danger btn-sm'/><i class='fa fa-sign-out' aria-hidden='true'></i></button></a>
									</div></td>";
										}
										else{
											echo "<td><center><span  class='badge badge-info'>Yetkili</span></center></td>";
											echo "<td><center><span  class='badge badge-info'>Üye</span></center></td>";
											echo "<td><center><span  class='badge badge-info'>Başkan</span></center></td>";
											echo "<td><center><span  class='badge badge-info'></span></center></td>";

										}
									}
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
$('#example').on('click', '#denetmenata', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
        ssi_modal.confirm({
                    content: 'Yetki vermek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/komisyon_uyeye_yetki_ver/'+$idim;
							
					}
                }
        );

    });
	
	$('#example').on('click', '#sorumluata', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
        ssi_modal.confirm({
                    content: 'Ders sorumlusu olarak atamak istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/sorumlu_olarak_ata/'+$idim;
							
					}
                }
        );

    });
	
		$('#example').on('click', '#komisyonaekle', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
        ssi_modal.confirm({
                    content: 'Komisyon üyesi olarak atamak istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/komisyon_uyeden_ekle/'+$idim;
							
					}
                }
        );

    });
	
	
	$('#example').on('click', '#komisyonbaskaniyap', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
        ssi_modal.confirm({
                    content: 'Komisyon başkanı olarak atamak istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/KomisyonBaskaniYap/'+$idim;
					}
                }
        );

    });
	
	$('#example').on('click', '#komiyonuyesil', function(){
	 $idim = $(this).parents("tr").find( "#a_no" ).text();
        ssi_modal.confirm({
                    content: 'Akademisyeni silmek istediğinize emin misiniz?', 
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Komisyon/komisyon_uye_sil/'+$idim;
							
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
                    columns: [0,1,2,3,5,6,7 ]
                }
                    }
                ]
            });
         });
	
	
</script>