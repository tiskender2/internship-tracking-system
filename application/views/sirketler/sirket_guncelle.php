 <?php 
//verileri cektim
if(!empty($sirketler)){
  foreach ($sirketler as $row) {
	$sirket_ad = $row->stajyeri_ad;
	$sirket_faaliyet = $row->stajyeri_faaliyetAlan;
	$sirket_mail = $row->stajyeri_mail;
	$sirket_tel = $row->stajyeri_telefon;
	$sirket_fax = $row->stajyeri_fax;
	$sirket_adres = $row->stajyeri_adres;
	$sirket_website = $row->stajyeri_website;
	$yetkili_adsoyad = $row->yetkili_adsoyad;
	$yetkili_unvan = $row->yetkili_unvan;
	$yetkili_mail = $row->yetkili_mail;
	$durum = $row->durum;
  }
}
?>

<script>
  
$(function(){
//textboxlara yazdım
  $("input[name=sirket_ad]").val('<?= $sirket_ad ?>');
  $("input[name=sirket_faaliyet]").val('<?= $sirket_faaliyet ?>');
  $("input[name=sirket_mail]").val('<?= $sirket_mail ?>');
  $("input[name=sirket_tel]").val('<?= $sirket_tel ?>');
  $("input[name=sirket_fax]").val('<?= $sirket_fax ?>');
  $("input[name=sirket_adres]").val('<?= $sirket_adres ?>');
  $("input[name=sirket_website]").val('<?= $sirket_website ?>');
  $("input[name=yetkili_adsoyad]").val('<?= $yetkili_adsoyad ?>');
  $("input[name=yetkili_unvan]").val('<?= $yetkili_unvan ?>');
  $("input[name=yetkili_mail]").val('<?= $yetkili_mail ?>');

})




</script>
 
 
 
 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Şirket Düzenle</h2>
            </div>
          </header>  
<div class="col-lg-12" style="padding-top: 51px;">
                  <div class="card">
                  <div class="card-body">


                      <form action="<?= base_url();?>Sirketler/sirket_Guncelle_islemi/<?=@$id;?>" method="post" class="form-horizontal" id="sirketguncelle" enctype="multipart/form-data">


                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Adı *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_ad">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket FaaliyetAlanı *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_faaliyet">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Mail *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_mail" data-validation="required emaill">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Telefon *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_tel">
                          </div>
                        </div>
                        <div class="line"></div>

						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Fax *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_fax">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Adres *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="sirket_adres">
                          </div>
                        </div>
                        <div class="line"></div>
						
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Şirket Website *</label>
                          <div class="col-sm-9">
                             <input type="text" class="form-control"   name="sirket_website">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Yetkili Adsoyad *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="yetkili_adsoyad">
                          </div>
                        </div>
                        <div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Yetkili Unvan *</label>
                          <div class="col-sm-9">
                             <input type="text" class="form-control"   name="yetkili_unvan">
                          </div>
                        </div>
                        <div class="line"></div>

						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Yetkili Mail *</label>
                          <div class="col-sm-9">
                             <input type="text" class="form-control"   name="yetkili_mail" data-validation="required emaill">
                          </div>

                        </div>
                        <div class="line"></div>
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Durum *</label>
                          <div class="col-sm-7 select">
                  		<select name="durum" class="form-control">
                     		<option <?php if ($durum == 1 ) echo 'selected' ; ?> value="1">AKTİF</option>
                     		<option <?php if ($durum == 0 ) echo 'selected' ; ?> value="0">PASİF</option>
                  		</select>
               		</div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                            <input type="submit" name="btn_guncelle" class="btn btn-info btn-sm" value="Kaydet"></input>
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
  form : '#sirketguncelle'
});	
	</script>