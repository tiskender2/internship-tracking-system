
	

    <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Staj Başvuru</h2>
            </div>
          </header>
<div class="col-lg-11 padding-header">
   	<div class="card">
      	<div class="card-body">
         	<form class="form-horizontal" method="post" id="basvuru" action="<?=base_url();?>stajbasvuru/basvuru_yap">
            	Staj Tarihi Bilgileri 
            	<br><br>
            	<div class="form-group row">
               		<label class="col-sm-4 form-control-label">Staja Başlama Tarihi</label>
               		<div class="col-sm-8">
                  		<div class="form-group">
                    		<div class="col-xs-5 date">
                        		<div class="input-group input-append date" id="datePickerbas">
                           			<input type="text" class="form-control" name="baslama_tarih" required="required" placeholder="Başlama tarihi en erken 30 gün sonrası seçilmelidir." />
                           			<span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span></span>
                        		</div>
                     		</div>
                  		</div>
               		</div>
            	</div>
            	<div class="line"></div>
            	<div class="form-group row">
               		<label class="col-sm-4 form-control-label">Staj Bitiş Tarihi</label>
               		<div class="col-sm-8">
                  		<div class="form-group">
                     		<div class="col-xs-5 date">
                        		<div class="input-group input-append date" id="datePickerbit">
                           			<input type="text" class="form-control" name="bitis_tarih" required="required" />
                           			<span class="input-group-addon add-on" style="margin-top:8px;"><span class="fa fa-calendar"></span></span>
                        		</div>
                     		</div>
                  		</div>
               		</div>
            	</div>
            	<div class="line"></div>
            	<div class="form-group row">
               		<label class="col-sm-4 form-control-label">Süresi(Gün)</label>
               		<div class="col-sm-8">
                  		<input type="text" class="form-control" name="staj_suresi" id ="gun" data-validation="required gun" placeholder="En az 20 en fazla 40 gün staj yapılabilmektedir.">
               		</div>
					
            	</div>
            	<div class="line"></div>
            	<div class="form-group row">
               		<label class="col-sm-4 form-control-label">Şirket Seçiniz</label>
               		<div class="col-sm-6 select">
                  		<select name="stajyeri" class="js-example-responsive ozel-select">
								 <?php 
								
								if(!empty($sirketler)){
								  foreach ($sirketler as $row) {
									echo'
									<option value='.$row->id.'>'.$row->stajyeri_ad.'</option>';
								  }
								}
								else
								{
									echo'
									<option value="null">Şuan Şirket Bulunmuyor.</option>';
								}
								?>
                     		
                  		</select>
               		</div>

               		<div class="col-sm-2">
                  		<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info" style="float: right;">Şirket Ekle</button>
               		</div>
            	</div>
            	<div class="form-group row">
               		<div class="col-sm-7 text-right">
						<input type="hidden" class="form-control form-control" name="adsoyad" value="<?= $this->session->ad_soyad ?>">
						
                  		<input type="submit" class="btn btn-info btn-sm" value="Başvuruyu Gönder" name="btn_Basvurugonder">
               		</div>
					
            	</div>
				</form>
            	<div class="form-group row">
               <!-- Modal-->
               		<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" class="modal fade text-left" style="display: none;" aria-hidden="true">
                  		<div role="document" class="modal-dialog" style="max-width:70%;">
                     		<div class="modal-content">
                        		<div class="modal-header">
                           			<h4 id="exampleModalLabel" class="modal-title">Yeni Şirket Ekle</h4>
                           			<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        		</div>
	                        	<div class="modal-body">
	                           		<div class="row">
	                              		<div class="col-sm-6">
	                                 		<h6 id="exampleModalLabel" class="modal-title">Şirket Bilgileri</h6>
	                                 		<hr>
	         								<form action="<?= base_url();?>Stajbasvuru/ogrenci_sirket_ekle/" method="post" class="form-horizontal" enctype="multipart/form-data">
		         								<div class="form-group row">
		         									<label class="col-sm-4 form-control-label">Kurumun Adı *</label>
		         									<div class="col-sm-8">
		         										<input type="text" class="form-control" name="sirket_ad" required="required" id="sirket_ad">
		         									</div>
		         								</div>
												
		         								<div class="form-group row">
		         									<label class="col-sm-4 form-control-label">Adresi *</label>
		        									<div class="col-sm-8">
		         										<input type="text" class="form-control" name="sirket_adresi" required="required" id="sirket_adresi">
		         									</div>
		         								</div>
		         								<div class="line"></div>
										        <div class="form-group row">
										        	<label class="col-sm-4 form-control-label">Hizmet Alanı *</label>
										         	<div class="col-sm-8">
										         		<input type="text" class="form-control" name="sirket_alan" required="required" id="sirket_alan">
										         	</div>
										        </div>
										        <div class="form-group row">
										         	<label class="col-sm-4 form-control-label">Telefon No *</label>
										         	<div class="col-sm-8">
										         		<input type="text" class="form-control" name="sirket_tel" required="required" id="sirket_tel">
										         	</div>
										        </div>
												
		         								<div class="line"></div>
										        <div class="form-group row">
										         	<label class="col-sm-4 form-control-label">Faks No *</label>
										         	<div class="col-sm-8">
										         		<input <input type="text"  class="form-control" name="sirket_faks" required="required" id="sirket_faks">
										         	</div>
										        </div>
										        <div class="form-group row">
										         	<label class="col-sm-4 form-control-label">E-posta *</label>
										         	<div class="col-sm-8">
										         		<input type="text" class="form-control" name="sirket_mail" data-validation="required emaill" id="sirket_mail">
										         	</div>
										        </div>
										        <div class="line"></div>
										        	<div class="form-group row">
										         		<label class="col-sm-4 form-control-label">Web Adresi *</label>
										         		<div class="col-sm-8">
										         			<input type="text" class="form-control" name="sirket_web"  data-validation="required url" id="sirket_web">
										         		</div>
										         	</div>
									    	
									    </div><!-- col-sm-6 -->
									    <div class="col-sm-6">
									        <h6 id="exampleModalLabel" class="modal-title">Yetkili Bilgileri</h6>
									        <hr>
									        
									         	<div class="form-group row">
									         		<label class="col-sm-4 form-control-label">Yetkili Adı *</label>
									         		<div class="col-sm-8">
									         			<input type="text" class="form-control" name="yetkili_ad" required="required" id="yetkili_ad" pattern="([A-Za-z]+( )*[A-Za-z]*( )*)+">
									         		</div>
									         	</div>
									         	<div class="line"></div>
									         	<div class="form-group row">
									         		<label class="col-sm-4 form-control-label">Görev Ve Unvanı *</label>
									         		<div class="col-sm-8">
									         			<input type="text" class="form-control" name="yetkili_unvan" required="required" id="yetkili_unvan">
									         		</div>
									         	</div>
	         									<div class="line"></div>
										        <div class="form-group row">
										         	<label class="col-sm-4 form-control-label">E-Posta *</label>
										         	<div class="col-sm-8">
										         		<input type="text" class="form-control form-control" name="yetkili_mail" data-validation="required emaill" id="yetkili_mail">
										         	</div>
										        </div>
	         							
	         							</div><!-- col-sm-6 -->
	         							<div class="col-sm-12">
	         								<div class="modal-footer" style="display: block; text-align: center;">
											
	         									<button type="submit" class="btn btn-info btn-sm" name="sirket_Kaydet" id="sirket_Kaydet">Kaydet</button>
	         								</div>
											<?php 
											echo @$eksikgiris;
											?>
											</form>
											
			
											
	         							</div><!-- col-sm-12 -->
	         						</div><!-- row-->
	         					</div><!-- modal-body -->
         					</div><!-- modal-content -->
         				</div><!--Modal Dialog -->
         			</div><!-- modal fade text-left-->
         		</div><!-- form-group row-->

				<?php
					
					$tarihhatasi=$this->session->flashdata('tarihhatasi');
					echo $tarihhatasi;
					$kimlik=$this->session->flashdata('kimlik');
					if ($kimlik == '1')
					{
					 $onayla='<script language="javascript">
						
						</script>';
						if ($onayla==true)
						{	echo'<script>alert("Lütfen ilk önce Kimlik Bilgilerinizi Doldurunuz!")</script>';
							echo '<script> window.location.href="'.base_url().'Profil/"</script>';
						}

					}
				?>
				
				<script>
			
				</script>

	 </div>
   	</div>
</div>
	<script>
	
$.validate({
  form : '#myModal,#basvuru'
});	
	</script>
