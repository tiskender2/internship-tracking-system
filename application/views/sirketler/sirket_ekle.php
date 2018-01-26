 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Şirket Ekle</h2>
            </div>
          </header>  
<div class="col-lg-12" style="padding-top: 51px;">
                  <div class="card">
                  <div class="card-body">


                      <form action="<?= base_url();?>Sirketler/sirket_Ekle_islemi/" id="sirketekle" method="post" class="form-horizontal" enctype="multipart/form-data">
						<div class="row">
	                        <div class="col-sm-6">
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Adı *</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"   name="sirket_ad">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket FaaliyetAlanı *</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"   name="sirket_faaliyet">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Mail *</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"   name="sirket_mail" data-validation="required emaill">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Telefon *</label>
                          <div class="col-sm-8">
                            <input id="sirket_tel" type="text" class="form-control"   name="sirket_tel">
                          </div>
                        </div>
                        <div class="line"></div>

						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Fax *</label>
                          <div class="col-sm-8">
                            <input id="sirket_faks" type="text" class="form-control"   name="sirket_fax">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Adres *</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"   name="sirket_adres">
                          </div>
                        </div>
                        <div class="line"></div>
						
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Şirket Website *</label>
                          <div class="col-sm-8">
                             <input id="sirket_web" type="text" class="form-control"   name="sirket_website">
                          </div>
                        </div>
                        <div class="line"></div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Yetkili Adsoyad *</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"   name="yetkili_adsoyad">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Yetkili Unvan *</label>
                          <div class="col-sm-8">
                             <input type="text" class="form-control"   name="yetkili_unvan">
                          </div>
                        </div>
                        <div class="line"></div>

						<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Yetkili Mail *</label>
                          <div class="col-sm-8">
                             <input type="text" class="form-control"   name="yetkili_mail" data-validation="required emaill">
                          </div>
                        </div>
                        <div class="line"></div>
					</div>
                        <div class="col-sm-12">
							<div class="" style="display: block; text-align: center;">
	         									<input type="submit" name="btn_ekle" class="btn btn-info btn-sm" value="Kaydet"></input>
	         								</div>
                        </div>
						


<?php 

echo @$eksikgiris;

$tiphatasi=$this->session->flashdata('tiphatasi');
echo $tiphatasi;

$dosyamevcut=$this->session->flashdata('dosyamevcut');
echo $dosyamevcut;


?>

                      </form>



                    </div>
                  </div>
</div>
	<script>
	
$.validate({
  form : '#sirketekle'
});	
	</script>