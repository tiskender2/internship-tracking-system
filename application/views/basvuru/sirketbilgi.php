<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">İşyeri Bilgi</h2>
            </div>
          </header>
		  <div class="col-lg-12">
<div class="card">
      	<div class="card-body">
<div class="form-group row">
    <div class="col-sm-6">
	<?php 
	foreach($sirketbilgileri as $row){
	?>
			<h6 class="modal-title">Şirket Bilgileri</h6>
			<hr>
			
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Kurumun Adı</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_ad ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Adresi</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_adres ?></label>
					</div>
				</div>
				<div class="line"></div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Hizmet Alanı</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_faaliyetAlan ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Telefon No</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_telefon ?></label>
					</div>
				</div>
				<div class="line"></div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Faks No</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_fax ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">E-posta</label>
					<div class="col-sm-8">
						<label><?= $row->stajyeri_mail ?></label>
					</div>
				</div>
				<div class="line"></div>
					<div class="form-group row">
						<label class="col-sm-4 form-control-label">Web Adresi</label>
						<div class="col-sm-8">
						<label><?= $row->stajyeri_website ?></label>
					</div>
					</div>
			
		</div><!-- col-sm-6 -->
		<div class="col-sm-6">
			<h6 id="exampleModalLabel" class="modal-title">Yetkili Bilgileri</h6>
			<hr>
			
			

			
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Yetkili Adı</label>
					<div class="col-sm-8">
						<label><?= $row->yetkili_adsoyad ?></label>
					</div>
				</div>
				<div class="line"></div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Görev Ve Unvanı</label>
					<div class="col-sm-8">
						<label><?= $row->yetkili_unvan ?></label>
					</div>
				</div>
				<div class="line"></div>
				<div class="form-group row">
					<label class="col-sm-4 form-control-label">Yetkili E-Posta</label>
					<div class="col-sm-8">
						<label><?= $row->yetkili_mail ?></label> 
					</div>
				</div>
	
		</div><!-- col-sm-6 -->
		<div class="col-sm-12">
			<div class="modal-footer" style="display: block; text-align: center;">
				<div class="row">
				<div class="col-sm-8">
				<?php 
				
	}
	?>
				</div>
				<div class="col-sm-4">
					<a href="<?= base_url()?>Stajbasvuru/"><button type="submit" class="btn btn-info btn-sm">Geri Dön</button></a>
				</div>
				</div>
			</div>
			
		</div><!-- col-sm-12 -->         
</div><!-- form-group row-->
</div>
</div>
</div>