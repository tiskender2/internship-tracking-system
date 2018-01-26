<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staj Takip Sistemi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>application_resources/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url();?>application_resources/css/fontastic.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>application_resources/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url();?>application_resources/css/style.default.css" id="theme-stylesheet"><link id="new-stylesheet" rel="stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url();?>application_resources/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url();?>application_resources/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

<body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Staj Takip Sistemi</h1>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
              <div class="content">
				<form method="post" action="<?=base_url();?>Login/emailkontrol" novalidate="novalidate">
                    <div class="form-group">
                      <input id="login-username" type="email" name="email" required="" class="input-material">
                      <label for="login-username" class="label-material">E-mail</label>
                    </div>
					  <div class="form-group">
					
                   <input type="submit" name="btn_unuttum" class="btn btn-primary" value="Şifre sıfırlama isteği gönder" />
				  
                  </form>
				  <a href="<?=base_url();?>" class="forgot-pass" >Geri dön</a><br>
                 <?=  @$email;  ?> 
				 <?=  @$emailbos;  ?>
                 <?=  @$message;  ?>






                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url();?>application_resources/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url();?>application_resources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>application_resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo base_url();?>application_resources/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>application_resources/js/front.js"></script>
  
</body>