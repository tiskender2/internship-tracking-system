 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Duyurular</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12" >
	<?php
		if ($this->session->loginType=="Denetmen" || $this->session->loginType=="Komisyonuye")
		{
            echo "<div style='padding:10px 0;'>";
			echo "<a href=".base_url()."duyuru/duyuru_Ekle><input type='button' class='btn btn-info btn-sm' value='Duyuru Ekle' style='margin-right:5px;'></a>";
			echo "<a href=".base_url()."duyuru/duyurularim><input type='button' class='btn btn-info btn-sm' value='Duyurularım'></a>";
			echo "</div>";
		}
	?>
    <div class="card">
		<div class="card-body">
           <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
						
	                    <th>Duyuru Başlık</th>
	                    <th>Duyuru İçerik</th>
	                    <th>Duyuru Tarih</th>
	                    <th>Akademisyen Adı</th> 
	                    <th>Duyuru Dosya</th>
						<th>Ayarlar</th>
						
						
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
							$count = count($duyurular);
							
							if ($count == "0")
							{
								
								echo "<td>Duyuru bulunmamaktadir!</td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								
							}
							else
							{
							
                             foreach($duyurular as $row){
							    
	                            echo "<td>".$row->baslik."</td>";
	                            echo "<td>".$row->icerik."</td>";
	                            echo "<td>".$row->tarih."</td>";
	                            echo "<td>".$row->ad_soyad."</td>";
                                
                                if($row->dosya != "Dosya Yok")
                                    echo "<td><a href=".base_url()."duyuru/dosyaindir?id=".$row->id.">".$row->dosya."</a></td>";
                                else echo "<td>".$row->dosya."</td>";
								
                                if($this->session->loginType=="Denetmen" and $this->session->no==$row->a_no)
                                {
                                    echo "<td><div class='col-xs-12'> 
									<input type='hidden' id='idsi' value='".$row->id."'>
											<a  class='col-xs-3' href=".base_url()."duyuru/duyuru_Guncelle/".$row->id."><button class='btn btn-warning btn-sm' /><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											<button class='btn btn-danger btn-sm' id='modal2' /><i class='fa fa-times' aria-hidden='true'></i></button>
										</div></td>";
                                    
                                }
                                else if ($this->session->loginType=="Komisyonuye" ){
                                    echo "<td><div class='col-xs-12'> 
									<input type='hidden' id='idsi' value='".$row->id."'>
											<a  class='col-xs-3' href=".base_url()."duyuru/duyuru_Guncelle/".$row->id."><button class='btn btn-warning btn-sm' /><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											<button class='btn btn-danger btn-sm' id='modal2' /><i class='fa fa-times' aria-hidden='true'></i></button>
										</div></td>";
                                }
								else echo "<td></td>";
								
								
								 
                            ?>
					   </tr>
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>
 <script>
$('#example').on('click', '#modal2', function(){
	$duyuru_id = $(this).parents("td").find( "#idsi" ).val();
        ssi_modal.confirm({
                    content: 'Duyuruyu silmek istediğinize emin misiniz?',
                    okBtn: {
						
                        className: 'btn btn-sm btn-primary'
					
                    },
                    cancelBtn: {
                        className: 'btn btn-sm btn-danger'
                    }
                }, function (result) {
                    if (result){
						window.location.href = '<?=base_url();?>duyuru/duyuru_Sil/'+$duyuru_id;
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
						title: 'Duyurular',
                        extend: 'print',
                        exportOptions: {
                    columns: [0,1,2,3,4]
                }
                    }
                ]
            });
         });
	
	
</script>
