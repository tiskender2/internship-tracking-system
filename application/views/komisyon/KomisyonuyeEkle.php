<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Komisyon Üye Oluştur</h2>
	</div>
</header>

<div class="login-page2">
		<div class="container d-flex align-items-center">
			<div class="form-holder has-shadow">
				<div class="row">
					<div class="col-lg-12 bg-white">
						<div class="form d-flex align-items-center">
							<div class="content">
								<form method="post" action="<?=base_url();?>Komisyon/komisyonUye_olustur" id="kform" novalidate="novalidate" style="max-width:100%;">
									<div class="row">
										
										<div class="col-sm-6" style="padding:10px;">
											<div class="form-group">
												<input id="login-ogrno" type="text" name="komisyonuye_adi" data-validation="required" class="input-material">
												<label for="login-ogrno" class="label-material">Komisyon Üye Adı</label>
											</div>
											<div class="form-group">
												<input id="login-name" type="text" name="akademisyen_no" data-validation="required" class="input-material">
												<label for="login-name" class="label-material">Akademisyen Numarası</label>
											</div>
											<div class="form-group">
											 <select name="unvan" class="form-control">
											<?php 
												if(!empty($unvanlar)){
													foreach ($unvanlar as $row) {
													echo'<option value='.$row->id.'>'.$row->unvan.'</option>';
													}
												}
											?>
											</select>
											  
											</div>	
										</div>
										<div class="col-sm-6" style="padding:10px;">
											<div class="form-group">
												<input id="login-mail" type="text" name="email" data-validation="required emaill" class="input-material">
												<label for="login-mail" class="label-material">E-mail</label>
											</div>
											<div class="form-group">
											  <input id="login-password" type="password" name="sifre"  data-validation="required password" class="input-material">
											  <label for="login-password" class="label-material">Şifre</label>
											</div>
										</div>
										<div class="col-sm-12"style="padding:10px;">
											<input type="submit" name="btn_kayit2" class="btn btn-sm btn-info"  value="Komisyon Uye Oluştur" />	
										</div>
										<?php 
						
												echo'<div class="col-sm-12"style="padding:10px;">
												<a href="'.base_url().'Komisyon/Komisyonuyeleri"></a>
											</div>';
						
										?>
									</div>
								</form>
								  <?php
									$eksikgiris=$this->session->flashdata('eksikgiris');
									echo $eksikgiris;
								  ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
		<script src="<?php echo base_url();?>application_resources/js/jquery.form-validator.js" ></script>
	<script>
	
$.validate({
  form : '#kform'
});
  
		
	</script>
	