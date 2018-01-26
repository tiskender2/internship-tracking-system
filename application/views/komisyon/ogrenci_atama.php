<?php 
		foreach($denetmen as $row2)
				{
					$akademisyen_no=$row2->no;			
					$ad_soyad=$row2->ad_soyad;	
				}
						
		
		?>
<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Ders Sorumlusuna Öğrenci Atama  <?php echo '<a class="pull-right" style="color:#2f333e">'.$ad_soyad.'</a>'; ?> </h2>
	</div>
	
</header>
<div class="row">
	<div class="card col-md-6">
		<div class="card-body ">
			
			<table id="exampl" class="display" cellspacing="0" width="100%">
			
				<thead>
					<th colspan='4'><h4 style="text-align:center;">Eklenecek Öğrenciler</h4><hr></th>
					
					<tr>
					
					    <th >Ögrenci No</th>
					    <th>Ögrenci Adı</th>
						<th >Sınıf</th>
				
						
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php 
						$count = count($ogrenciler);
						if ($count == "0")
						{
								 echo '<td>Öğrenci Bulunmamaktadır.</td>';
								 echo '<td></td>';
								 echo '<td></td>';
						}
						else
						{
							
								foreach($ogrenciler as $row)
								{
									if($row->kalan_gun!=0){
									echo "<td><input type='hidden' name='no' id='ogrNo' value='".$row->ogrenci_no."'>".$row->ogrenci_no."</input></td>";
									echo "<td>".$row->ad_soyad."</td>";
									echo "<td class='sinif'>".$row->giris_yili."</td>";
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
	
		<div class="card col-md-6">
		<div class="card-body tolga ">
			
			<table id="stopsTable" class="display" cellspacing="0" width="100%">
				<thead>
				<th colspan='3'><h4 style="text-align:center;">Eklenen Öğrenciler</h4><hr></th>
					<tr>
					    <th>Ögrenci No</th>
					    <th>Ögrenci Adı</th>
						<th>Sınıf</th>
						
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			
		</div>
	</div>
	<script>
	var count=0;
	var dizi=[];
		$(function() {
			$('#exampl tbody .sinif').each(function(){
				$(this).append('<button class="btn btn-success copy pull-right" style="margin-bottom:5px;"><i class="fa fa-plus" aria-hidden="true"></i></button>');
			});
			$(document).on('click', '#exampl button.copy', function(){
				var $tr = $(this).parents('tr:first').clone();
				 var $tr = $(this).parents('tr:first').remove();
				$tr.appendTo($('#stopsTable > tbody'));
				$("#stopsTable button.copy").addClass("btn-danger").removeClass("btn-success");
				$("#stopsTable button.copy .fa").addClass("fa-minus").removeClass("fa-plus");
				count++;
				$ogrNo = $(this).parents("tr").find( "#ogrNo" ).val();
				dizi.push($ogrNo);
				console.log(dizi);
				if(count==1)
				{
					$(".tolga").append('<button class="btn btn-success pull-right ogr-ekle" id="modal2">Öğrenci Ekle</button>');
					$( "#modal2" ).on( "click", function() {
        ssi_modal.confirm({
                    content: 'Öğrencileri Eklemek İstediğinize Emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-danger'
                    }
                }, function (result) {
                    if (result){
						
						window.location.href = '<?=base_url();?>Komisyon/derssorumlusuna_ogrenciEkle/<?php echo $akademisyen_no?>/'+dizi;
					}
                }
        );

    });
				}	
						
				
			});	  
			
			
		});

	
			$(document).on('click', '#stopsTable button.copy', function(){
				var $tr = $(this).parents('tr:first').clone();
				 var $tr = $(this).parents('tr:first').remove();
				$tr.appendTo($('#exampl > tbody'));
				$("#exampl  button.copy .fa").addClass("fa-plus").removeClass("fa-minus");
				$("#exampl button.copy").addClass("btn-success").removeClass("btn-danger");
				count--;
				$ogrNo = $(this).parents("tr").find( "#ogrNo" ).val();
				dizi.splice(dizi.indexOf($ogrNo), 1);
				console.log(dizi);
				if(count==0)
					$(".ogr-ekle").remove();
			});
			
	
			
			
			

								
	</script>
	
	 <script>

</script>
</div>
