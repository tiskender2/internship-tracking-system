	<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Material Admin by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/tez/application_resources/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="/tez/application_resources/css/fontastic.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/tez/application_resources/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/tez/application_resources/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/tez/application_resources/css/custom.css">
		<link rel="stylesheet" href="/tez/application_resources/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Staj </span><strong>Takip</strong></div>
                  <div class="brand-text brand-small"><strong>ST</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a href="/tez"  class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                  
                </li>
               </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="/tez/application_resources/img/tiskender.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4">Misafir Kullanıcı</h1>
              
            </div>
          </div>
          
          
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Bildirimler</h2>
            </div>
          </header>
			<div class="col-lg-12" >
    <div class="card">
		<div class="card-body">
           <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
						
	                    <th>Duyuru Başlık</th>
	                    <th>Duyuru İçerik</th>
	                    <th>Duyuru Tarih</th>
	                    <th>Akademisyen Adı</th> 
	                    <th>Duyuru Dosya</th>
						
						
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
							$count = count($duyurular);
							
							if ($count == "0")
							{
								
								echo "<td>Duyuru bulunmamaktadir!</td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";

								
							}
							else
							{
							
                             foreach($duyurular as $row){
							    
	                            echo "<td> <input type='hidden' id='idsi' value='".$row->id."'>".$row->baslik."</td>";
	                            echo "<td>".$row->icerik."</td>";
	                            echo "<td>".$row->tarih."</td>";
	                            echo "<td>".$row->ad_soyad."</td>";
                                
                                if($row->dosya != "Dosya Yok")
                                    echo "<td><a href=".base_url()."duyuru/dosyaindir?id=".$row->id.">".$row->dosya."</a></td>";
                                else echo "<td>".$row->dosya."</td>";
								
                                
								
								
								 
                            ?>
					   </tr>
							<?php  } }?>
                </tbody>
				
            </table>
        </div>
    </div>
</div>
		</div>
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="/tez/application_resources/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="/tez/application_resources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/tez/application_resources/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/tez/application_resources/vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="/tez/application_resources/js/datatables.js"></script>
      <script src="/tez/application_resources/js/jquery.dataTables.min.js"></script>
    <script src="/tez/application_resources/js/front.js"></script>


		   <script>
         $.extend( $.fn.dataTable.defaults, {
          responsive: true
         } );
         
         $(document).ready(function() {
          $('#example').DataTable();
         } );
      </script>
  </body>
</html>