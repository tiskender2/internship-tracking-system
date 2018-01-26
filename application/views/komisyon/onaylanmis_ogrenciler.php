<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Kabul Gün Onay</h2>
	</div>
</header>
<div class="col-lg-12">
	<div style="padding:10px 0">
		<a href="<?=base_url();?>Komisyon/staj_kabul_gun_onay"><input type='button' class='btn btn-info btn-sm' value='Geri Dön' style='margin-right:5px;'></a>  
	</div>
	<div class="card">
		<div class="card-body">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
					    <th>Öğrenci No</th>
					    <th>Ad Soyad</th>
						<th>Staj Defteri</th>
						<th>Yapılan Gün</th>
						<th>Kabul Edilen Gün</th>
						<th>Kalan Gün</th>
						

					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($ogrenciler);
						if ($count == "0")
						{
							echo'<td>Kabul gün girişi yapılmış öğrenci bulunmamaktadır.</td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							
						}
						else
						{
							foreach($ogrenciler as $row)
							{
								if($row->staj_defteri!='' and $row->anketform!=''){
									echo "<td>".$row->ogrenci_no."</td>";
									echo "<td>".$row->ad_soyad."</td>";
									echo "<td>".$row->staj_defteri."</td>";
									echo "<td>".$row->staj_gun."</td>";
									echo "<td>".$row->kabul_gun."</td>";
									echo "<td>".$row->kalan_gun."</td>";
									
									
								
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