 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Anasayfa</h2>
            </div>
  </header>   
       
         
<div class="col-lg-12" >
    <div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
				 <div class="card text-white">
					<div class="card-header" style="background-color:#2f333e;">
					<i class="fa fa-volume-up" aria-hidden="true"></i> Duyurular <a href="<?=base_url();?>duyuru" style="float:right; color:white;"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					</div>
					<div class="card-body" style="background-color:transparent; padding:3px;">
						<ul class="list-group list-group-flush">
						<?php
							foreach($duyurular as $row){
											echo "<li class='list-group-item' ><a style='color:#000; text-decoration:none;' href='".base_url()."duyuru/duyuru_icerik/".$row->id."'>".$row->baslik." <span style='float:right;position:absolute;display:inline-block; right:0;font-size:10px;'>".$row->tarih."</span></a></li>";
							}
						?>
						</ul>
					</div>
				</div>
				
				</div>
				
		
		
            </div> 
        </div>
    </div>
</div>



				