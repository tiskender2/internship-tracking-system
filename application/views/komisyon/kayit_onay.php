 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Kayıt Onayı Bekleyen Öğrenciler</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
    <div class="card">
		<div class="card-body">
           <table id="example" class="display" cellspacing="0" width="100%">
			   <thead>
                    <tr>
	                    <th>Öğrenci No</th>
	                    <th>Ad Soyad</th>
	                    <th>Telefon</th>
	                    <th>Giriş Yılı</th> 
	                    <th>Adres</th>
						<th>Ayarlar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
							$count = count($ogrenciler);
							
							if ($count == "0")
							{
								echo "<td>Kayıt onayı bekleyen öğrenci bulunmamaktadir!</td>";
								echo "<td></td>";
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
								echo "<td>".$row->adres."</td>";
								echo "<td>
										<input type='hidden' id='ogr_nosu' value='".$row->ogrenci_no."'>
										<a href='".base_url()."Komisyon/ogrenci_kayit_kabul/".$row->ogrenci_no."' class='col-md-3' ><button class='btn btn-success btn-sm'/><i class='fa fa-check' aria-hidden='true'></i></button></a>
										<a class='col-md-3'><button id='kayit_onay' class='btn btn-danger btn-sm' /><i class='fa fa-times' aria-hidden='true'></i></button></a>
									  </td>";
                            ?>
					   </tr>
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>
<script>
$('#example').on('click', '#kayit_onay', function(){
	$ogr_no = $(this).parents("td").find( "#ogr_nosu" ).val();
        ssi_modal.confirm({
                    content: 'Kaydı reddetmek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						window.location.href = '<?=base_url();?>Komisyon/ogrenci_kayit_red/'+$ogr_no;
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
						title: 'Kayıt Onayı Bekleyen Öğrenciler',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3,4]
                }
                    }
                ]
            });
         });
</script>
