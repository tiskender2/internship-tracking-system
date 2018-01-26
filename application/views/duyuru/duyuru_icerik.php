<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Anasayfa</h2>
            </div>
  </header>   
<div class="col-lg-12" >
    <div class="card">
	 <?php
		foreach($duyurular as $row){
			echo "<div class='card-header' style='background-color:#f5f5f5;'>
					<h3 style='text-align:center;'>".$row->baslik."</h3>
				</div>
				<div class='card-body'>
				
				<p class='card-text'>".$row->icerik."</p><hr>";
				if($row->dosya=="Dosya Yok"){
					echo "<a></a>";
				}
				else{
					echo "<a href=".base_url()."duyuru/dosyaindir?id=".$row->id.">".$row->dosya."</a>";
				}
				
				echo "
					
					<span class='badge badge-info' style='color:#ffffff; float:right; font-size:14px'>Ekleyen : ".$row->ad_soyad."</span><br>
					<span class='badge badge-info' style='color:#ffffff; float:right; font-size:14px;'>Tarih : ".$row->tarih."</span>
  </div>
</div>";
							}?>
</div>


				