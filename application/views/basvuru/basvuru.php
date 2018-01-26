<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Staj Başvuru</h2>
	</div>
</header>
<div class="col-lg-12">
	<div style="padding:10px 0">
	<?php
		if($kalan_gun!=0 || count($basvurularım)==0 ){
			echo "<a href=".base_url()."stajbasvuru/basvuruform><input type='button' class='btn btn-info btn-sm' value='Başvuru Formu Doldur' style='margin-right:5px;'></a> "; 
		}
		
	?>
		</div>
	<div class="card">
		<div class="card-body">
			<div>
				<h4 >Başvurularım</h4>
			</div>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>Şirket</th>
					    <th>Başvuru Tarihi</th>
						<th>Başlama Tarihi</th>
						<th>Bitiş Tarihi</th>
						<th>Gün Sayısı</th>
						<th>Onay Durumu</th>
						<th>Başvuru Formu</th>
						<th>Ayarlar</th>

					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($basvurularım);
						if ($count == "0")
						{
							echo'<td>Staj Başvurunuz Bulunmamaktadır.</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>';
								 
						}
						else
						{
							foreach($basvurularım as $row)
							{
								$basvuru_tarihi=$row->basvuru_tarihi;
								$baslama_tarihi=$row->baslama_tarihi;
								$bitis_tarihi=$row->bitis_tarihi;
								$baslama_tarihi=date('d-m-Y',strtotime($baslama_tarihi));
								$basvuru_tarihi=date('d-m-Y',strtotime($basvuru_tarihi));
								$bitis_tarihi=date('d-m-Y',strtotime($bitis_tarihi));
								echo "<td> <input type='hidden' id='idim' value='".$row->idim."'><input type='hidden' id='idim2' value='".$row->idim2."'>".$row->stajyeri_ad."</td>";
								echo "<td>".$basvuru_tarihi."</td>";
								echo "<td>".$baslama_tarihi."</td>";
								echo "<td>".$bitis_tarihi."</td>";
								echo "<td>".$row->staj_gun."</td>";
									if ($row->staj_durum == "0")
									{
										echo "<td><span class='badge badge-warning' style='color:#ffffff;'>Onay Bekleniyor</span></td>";
									}
									else if ($row->staj_durum == "1")
									{
										echo "<td><span class='badge badge-success'>Onaylandı</span></td>";
									}
									else
									{
										echo "<td><span class='badge badge-danger' style='color:#ffffff;'>Reddedildi</span></td>";
									}
									if($row->staj_durum=="1"){
										echo "<td><a href=".base_url()."Stajbasvuru/basvuruformindir?ogrno=".$row->ogrenci_no.">".$row->basvuruform."</a></td>";
									}
									else{
										echo "<td>Başvuru Formu Yok</td>";
									}
									if ($this->session->loginType=="Ogrenci" )
									{
										if ($row->staj_durum != "1")
										{
										echo "<td>
										<div class='col-md-12'> 
										<a class='col-md-3' href=".base_url()."Stajbasvuru/basvuru_Guncelle/".$row->idim."/".$row->staj_durum."><button class='btn btn-warning btn-sm'/><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
										<a  class='col-md-3'><button id='modal2' class='btn btn-danger btn-sm' /><i class='fa fa-times' aria-hidden='true'></i></button></a>
										</div>
										</td>";
										}
										else
										{
										echo "<td>
										<div class='col-md-12'> 
										<a class='col-md-3' href=".base_url()."Stajbasvuru/ogrenci_sirket_goruntule/".$row->idim2."><button class='btn btn-info btn-sm'/><i class='fa fa-eye' aria-hidden='true'></i></button></a>
										</div>
										</td>";
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
$('#example').on('click', '#modal2', function(){
	 $idim = $(this).parents("tr").find( "#idim" ).val();
	$idim2 = $(this).parents("tr").find( "#idim2" ).val();
	console.log($idim);
	console.log($idim2);
        ssi_modal.confirm({
                    content: 'Başvuruyu Silmek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						
							window.location.href = '<?=base_url();?>Stajbasvuru/basvuru_iptalet/'+$idim+"/"+$idim2;
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
						title: 'Başvurularım',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3,4,5,6 ]
                }
                    }
                ]
            });
         });
	
	

</script>