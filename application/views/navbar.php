 <html><div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="data:image/jpeg;base64,<?= base64_encode( $this->session->resim )  ?>"   alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><?= $this->session->ad_soyad  ?> </h1>
              <p><?= $this->session->unvan; ?></p>
              <?php
                if ($this->session->loginType=="Ogrenci")
					
                  {
					  $profil=$this->session->flashdata('profil');
					  echo '<p><a href='.base_url().'profil/>Profilim</a></p>';
				  }
                ?>
              
            </div>
          </div>
          <ul class="list-unstyled">
         
          <?php

          if($this->session->loginType == "Komisyonuye" ){
            echo '<li> <a href='.base_url().'Ana/anasayfa><i class="icon-home"></i>Anasayfa</a></li>';
            echo '<li> <a href='.base_url().'duyuru/> <i class="icon-grid"></i>Duyurular </a></li>';
            echo '<li> <a href='.base_url().'Sirketler> <i class="icon-picture"></i>Şirketler</a></li>';
            echo '<li> <a href='.base_url().'Komisyon/Denetmenler> <i class="icon-interface-windows"></i>Denetmenler</a></li>';
            echo '<li> <a href='.base_url().'Komisyon/Ogrenciler/TumOgrenciler> <i class="icon-interface-windows"></i>Öğrenciler</a></li>';
            echo '<li> <a href='.base_url().'Komisyon/staj_kabul_gun_onay> <i class="icon-interface-windows"></i>Staj Kabul Gün Onayı</a></li>';
          }

          if($this->session->loginType == "Ogrenci" ){
            echo '<li> <a href='.base_url().'Ana/anasayfa><i class="icon-home"></i>Anasayfa</a></li>';
			echo '<li id="profilim"> <a href='.base_url().'profil/><i class="fa fa-user" aria-hidden="true"></i> Profilim </a></li>';
            echo '<li> <a href='.base_url().'stajbasvuru/> <i class="icon-padnote"></i>Başvuru Formu </a></li>';
            echo '<li> <a href='.base_url().'Ogrenci/raporyukleme> <i class="icon-screen"></i>Rapor Yükle </a></li>';
            echo '<li> <a href='.base_url().'Sirketler/> <i class="icon-picture"></i>Şirketler</a></li>';
          }

          if($this->session->loginType == "Denetmen" ){
            echo '<li> <a href='.base_url().'Ana/anasayfa><i class="icon-home"></i>Anasayfa</a></li>';
            echo '<li> <a href='.base_url().'duyuru/> <i class="icon-grid"></i>Duyurular </a></li>';
            echo '<li> <a href='.base_url().'Sirketler/> <i class="icon-picture"></i>Şirketler</a></li>';
            echo '<li> <a href='.base_url().'Denetmen/ogrenci_listele> <i class="icon-interface-windows"></i>Öğrenciler</a></li>';
            echo '<li> <a href='.base_url().'Stajbasvuru/basvuru_kabul> <i class="icon-interface-windows"></i>Staj Başvuru Onayı</a></li>';
            echo '<li> <a href='.base_url().'Denetmen/staj_kabul_gun> <i class="icon-interface-windows"></i>Staj Kabul Gün Girişi</a></li>';
          }



           ?>

          </ul></html>