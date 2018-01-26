 <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Rapor Yükle</h2>
            </div>
          </header>   
       
         
<div class="col-lg-12">
	    <div class="card">
			<div class="card-body">
			<br>
<?php
$staj_defteri='';
foreach($data as $row){
	$staj_defteri=$row->staj_defteri;
}
	echo "<h7>Raporlar staj bitiş tarihinden sonra yüklenebilmektedir..</h7><br><br><br>";

if($staj_defteri==""){
	echo "<div class='row'>";
	echo "<div class='col-sm-6'> <h2>Staj Defteri Yükle</h2><br>";
	echo "<form action=".base_url()."Ogrenci/raporu_yukle_stajdefteri/".$this->session->no." method='post' class='form-horizontal' enctype='multipart/form-data'>
	<input type='file' class='form-control'   name='rapor_dosya'><br>
	<input type='submit' class='btn btn-success btn-sm' value='Yükle'/><br>
	<form>
	</div>

	";
	
}
else{
	echo "<table class='display' cellspacing='0' width='100%'>
				<thead>
					<tr>
					    <th>Staj Defteri</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a href=".base_url()."Ogrenci/stajdefteridosyaindir?id=".$row->ogrenci_no.">".$staj_defteri."</a></td>
					</tr>
				</tbody>
			</table>";
	
}

echo "<br>";
$anketform='';
foreach($data as $row){
	$anketform=$row->anketform;
}

if($anketform==""){
	echo "<div class='col-sm-6'> <h2>Anket Yükle</h2><br>";
	echo "<form action=".base_url()."Ogrenci/raporu_yukle_anket/".$this->session->no." method='post' class='form-horizontal' enctype='multipart/form-data'>
	<input type='file' class='form-control'   name='rapor_dosya2'><br>
	<input type='submit' class='btn btn-success btn-sm' value='Yükle'/><br>
	<form>
	</div>
	</div>";
}
else{
	echo "<table class='display' cellspacing='0' width='100%'>
				<thead>
					<tr>
					    <th>Anket</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a href=".base_url()."Ogrenci/anketdosyaindir?id=".$row->ogrenci_no.">".$anketform."</a></td>
					</tr>
				</tbody>
			</table>";
	
}




echo "<br>";
$tiphatasi=$this->session->flashdata('tiphatasi');
echo $tiphatasi;

$tarihyanlis=$this->session->flashdata('tarihyanlis');
echo $tarihyanlis;

$stajyok=$this->session->flashdata('stajyok');
echo $stajyok;

?>
</div>
</div>
</div>