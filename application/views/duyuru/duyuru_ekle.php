 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Duyurular</h2>
            </div>
          </header>  
<div class="col-lg-12 padding-header">
                  <div class="card">
                  <div class="card-body">


                      <form action="<?= base_url();?>duyuru/duyuru_Ekle_islemi/" method="post" class="form-horizontal" enctype="multipart/form-data">


                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Duyuru Başlık *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"   name="duyuru_baslik">
                          </div>
                        </div>


                        <div class="line"></div>

                        
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Duyuru İçerik *</label>
                          <div class="col-sm-9">
                            <textarea style="resize:none;" class="form-control" name="duyuru_icerik"  rows="4" maxlength="200"; required>
							</textarea>
                          </div>
                        </div>
                      
                        

                        <div class="line"></div>


                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Duyuru Dosyası</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control"   name="duyuru_dosya">
                          </div>
                        </div>

                        

                        <div class="line"></div>


                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
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