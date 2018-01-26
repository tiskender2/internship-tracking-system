<!DOCTYPE html>
<html>
<title>Staj Takip Sistemi</title>
<link href="/tez/application_resources/css/logincss.css" rel="stylesheet" type="text/css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/tez/application_resources/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/tez/application_resources/js/jquery.form-validator.js" ></script>
 
<body  background="application_resources/img/fakulte.jpg" style="background-repeat: no-repeat; background-size:cover;">

<div class="col-md-12" style="margin-top:10%;"></div>
<div class="col-md-4 col-xs-2"></div>
<div class="col-md-4 col-xs-8 content-form"> 
<div class="msg msg-danger" style="display:none;"> <span class="glyphicon glyphicon glyphicon-remove "></span> 
	<span class="error_messagee"><?=  $email_ogrno_var=$this->session->flashdata('email_ogrno_var'); ?></span>
	<span class="error_messagee"><?=  $hatalıgiris=$this->session->flashdata('hatalıgiris');  ?></span>
	<span class="error_messagee"><?=  $eksikgiris=$this->session->flashdata('eksikgiris');  ?></span>
	<span class="error_messagee"><?=  $sifre=$this->session->flashdata('sifre');?></span>
	<span class="error_messagee"><?=  $mailebak=$this->session->flashdata('mailebak');?></span>
	<span class="error_messagee"><?=  $kayitdurum=$this->session->flashdata('kayitdurum');?></span>
	<span class="error_messagee"><?=  @$mailebakma?></span>
</div>
<div class="msg msg-success" style="display:none;"> <span class="glyphicon glyphicon glyphicon-remove "></span> 
	<span class="error_messagee2"><?=  $kayit_basarili=$this->session->flashdata('basarili'); ?></span>
</div>
<div class="col-md-6 col-xs-2"> 

    <div class="rowr pull-left" onclick="document.getElementById('id01').style.display='block';init();"  style="cursor:pointer">
  <img src="application_resources/img/studentt.png"  alt="Avatar" class="image" >
  <div class="middle">
    <div class="text" >Öğrenci</div>
  </div>
	</div>
</div>
<div class="col-md-6">
    <div class="rowr pull-right" onclick="document.getElementById('id02').style.display='block';init2();" style="cursor:pointer">
  <img src="application_resources/img/akademisyen.png" alt="Avatar" class="image" >
  <div class="middle">
    <div class="text" >Akademisyen</div>
  </div>
	</div> 
</div>
</div>
<div class="col-md-12">
<div class="col-md-4 col-xs-2"></div>
<div class="col-md-4 col-xs-8" style="padding-right:0;padding-left:0; padding-top:10px;"> 
		<div class="text-white">
			<div class="content-form col-md-12">
				<i class="fa fa-volume-up" style="color:#ffffff;" aria-hidden="true"></i> <span style="color:#ffffff;">Duyurular</span> <a href="<?=base_url();?>Login/tumdisduyurular" style="float:right; color:white;"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
			</div>
			<div class="col-md-12" style="background-color:transparent; padding:0px;">
				<ul class="list-group" style="border-top-left-radius: 0; border-top-right-radius: 0;">
					<?php
						foreach($duyurular as $row){
							echo "<li class='list-group-item'  ><a style='color:#000; text-decoration:none;' href='".base_url()."Login/disduyuru/".$row->id."'>".$row->baslik." <span class='pull-right' style='float:right;margin-top:1%;font-size:10px;'>".$row->tarih."</span></a></li>";
						}
					?>
				</ul>
			</div>
		</div>


</div>
</div> 
<div class="col-md-4">
</div>
<div class="">
<div class="col-md-4"></div>
 <div class="col-md-4">
 </div>
<div class="col-md-4"></div>
</div>
<div id="id01" class="modal" style="overflow:auto;">
<div class="col-md-4 signinogr"></div>
<div class="col-md-2 register"></div>
<div class="col-md-4 signinogr">

  <form class="modal-content animate" id="girisform" method="post"  enctype="multipart/form-data" style="margin-bottom:0;" onSubmit="return dogru();">
  <button type="button" onclick="document.getElementById('id01').style.display='none'" style="color:white;" class="cancelbtn pull-right">X</button>

    <div class="" >
 	<div class="col-sm-12"><label><b>E-Mail</b></label></div>
  	<div class="col-sm-12"><input type="text" placeholder="Öğrenci Mail" name="email"  id="email"  data-validation="fill"></div>
 	<div class="col-sm-12"><label><b>Şifre</b></label></div>
	
  	<div class="col-sm-12"><input type="password" placeholder="Şifre" name="sifre"  id="sifre"  data-validation=" fill"></div>


	<div class="col-md-12"><label><b>Güvenlik Kodu</b></label></div>
	<div class="col-md-5"><canvas id="c" width="150"  height="30"></canvas></div>
	<div class="col-md-4" style="padding-right:0; padding-left:0;"><input type="text" style="padding:0;margin:0;margin-left:30%; height:30px;" placeholder="Güvenlik Kodu" name="gkod"  id="gkod" ></div>
	<div class="col-md-3" style="padding-left:12%; padding-top:5px;"><a onclick="degis()"><i class="fa fa-refresh" aria-hidden="true"></i></a></div></br>
	

   <span class="col-sm-12 " id="file_error2"></span>
	 <div class="col-sm-12" style="padding-top:3%; margin-bottom:10%;">
		<button name="btn_login"  class="btn btn-success" onclick="girisKontrol();" >Giriş</button> 
		<a name="btn_kayit" style="margin-top:10px;" class="btn btn-primary pull-right  kayit_btn" > Kayıt Ol </a>
		<span style="float:left;" class="psw btn_passogr  pull-left"><a href="#">Şifremi Unuttum</a></span>
	</div>    
	<div class="col-sm-12"></div>	
    </div>
  </form>
</div>
<div class="col-md-8 register">

  <form class="modal-content animate" id="kodal" method="post" action="<?=base_url();?>Login/kayit_ol_gonder" enctype="multipart/form-data" style="margin-bottom:0;" onSubmit="return validates();">
  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn pull-right" style="color:white;">X</button>
	<div class="col-sm-6" >
			<div class="col-sm-12" style="margin-top:40px;">
				<label><b>Öğrenci No</b></label>
				<input id="login-ogrno" type="text" name="ogr_no" data-validation="required" maxlength="6">
			</div>
			<div class="col-sm-12">
				<label><b>Ad Soyad</b></label>
				<input id="login-name" type="text" name="ad_soyad" data-validation="required" >
			</div>
			<div class="col-sm-12"> 
				<label><b>Telefon</b></label>
				<input id="login-tel" type="text" name="telefon" data-validation="required"> 
			</div>
			<div class="col-sm-12">
				<label><b>Giriş Yılı</b></label>
				<select name='sinif' class="ozel-select">
					<option value='2013-2014'>2013-2014</option>
					<option value='2014-2015'>2014-2015</option>
					<option value='2015-2016'>2015-2016</option>
					<option value='2016-2017'>2016-2017</option>
					<option value='2017-2018'>2017-2018</option>
					<option value='2018-2019'>2018-2019</option>
					<option value='2020-2021'>2020-2021</option>
					<option value='2021-2022'>2021-2022</option>
				</select>	 
			</div>
			<div class="col-sm-12" style="margin-left:" >
				<label style="margin-left:0;"><b>Resim Seç</b></label>	<span id="file_error"></span>
				<input id="resim" style="padding:10px 10px;" class="ozel-select"  name="resim" accept=".jpg, .jpeg, .png"  value="Resim Seç" type="file" data-validation="imagee" style="margin:10px 15px;">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-sm-12">
				<label><b>Adres</b></label>
				<input id="login-adres" type="text" name="adres" data-validation="required">
			</div>
			<div class="col-sm-12">
				<label><b>E-Mail</b></label>

				<input id="login-mail" type="text" name="email"  data-validation="required emaill" >
			</div>
			<div class="col-sm-12">
				<label><b>Şifre</b></label>

				<input id="login-password" type="password" name="sifre"  data-validation="required password" >
			</div>
			<div class="col-sm-12">
				<label><b>Şifre Tekrar</b></label>
				<input id="login-password2" type="password" name="resifre" data-validation="required"> 
			</div>
			<div class="col-sm-12" >
				<label><b>Bölüm</b></label>
				<select name='bolum' class="ozel-select">
					<?php foreach($bolum as $row){ ?>
						<option value='<?=$row->id?>'><?=$row->bolum_adi?></option>						
					<?php } ?>
				</select>
			</div>
		</div>
	
		<div class="col-sm-12" style="padding: 15px 30px;">
			<a name="" class="btn btn-primary btn-sm pull-left giris_btn">Geri Dön </a>
			<a name="btn_kayit" class="pull-right kayit_btn btn-sm"><button name="btn_kayit" id="btn_kayit"  class="btn btn-sm btn-success">Kayıt Ol</button> </a>
		</div>    	 
	
  </form>
</div>
<div class="col-md-4 pass"></div>
<div class="col-md-4 pass" style="display:none;  background-color:white;"">

	<form method="post" action="<?=base_url();?>Login/emailkontrol" novalidate="novalidate"> 
  <button type="button" class="cancelbtn cancelpassogr pull-right" style="color:white;">X</button>
<div class="col-sm-12"><label><b>E-Mail</b></label></div>
  	<div class="col-sm-12"><input id="login-username" type="text" placeholder="Email" name="email" data-validation="required"></div>
	<div class="col-sm-12" style="padding-top:3px;">		
		<a name="btn_unuttum" class="pull-left"><input type="submit" name="btn_unuttum" class="btn btn-sm btn-primary" value="Şifre sıfırlama isteği gönder" /> </a>
	</div> 
   	
  </form>
</div>
</div>

<div id="id02" class="modal">
  
<div class="col-md-4 signinak"></div>

<div class="col-md-4 signinak ">

  <form id="girisform2" class="modal-content animate" method="post"  onSubmit="return dogru2();">
  <button type="button" onclick="document.getElementById('id02').style.display='none'" style="color:white;" class="cancelbtn pull-right">X</button>

    <div class="row">
 	<div class="col-sm-12"><label><b>Email</b></label></div>
  	<div class="col-sm-12"><input type="text" placeholder="Email" name="email" id="email2" ></div>
 	<div class="col-sm-12"><label><b>Şifre</b></label></div>
  	<div class="col-sm-12"><input type="password" placeholder="Şifre" name="sifre" id="sifre2" ></div>
     
	<div class="col-sm-12"><label><b>Güvenlik Kodu</b></label></div>
	<div class="col-sm-5"><canvas id="c2" width="190"  height="30"></canvas></div>
	<div class="col-sm-4" style="padding-right:0; padding-left:0;"><input type="text" style="padding:0;margin:0; height:30px;" placeholder="Güvenlik Kodunu giriniz" name="gkod2"  id="gkod2" ></div>
	<div class="col-sm-3" style="padding-left:5px; padding-top:5px;"><a onclick="degis()"><i class="fa fa-refresh" aria-hidden="true"></i></a></div></br>
	
   <span class="col-sm-12 " id="file_error3"></span>
	 <div class="col-sm-12" style="padding-top:3px;">		
		<a name="btn_login" class="pull-left"><input type="submit" name="btn_login" class="btn btn-sm btn-success" onclick="girisKontrol2();" value="Giriş" /> </a>

	</div>    
	<div class="col-sm-12"><span class="psw btn_passden pull-left"><a href="#">Şifremi Unuttum</a></span></div>	
    </div>
  </form>
</div>
<div class="col-md-4 passo"></div>
<div class="col-md-4 passak" style="display:none; background-color:white;">

				<form method="post" action="<?=base_url();?>Login/emailkontrol" novalidate="novalidate">
  <button type="button" class="cancelbtn cancelpassden pull-right" style="color:white;">X</button>
  
 	<div class="col-sm-12"><label><b>E-Mail</b></label></div>
  	<div class="col-sm-12"><input id="login-username2" type="text" placeholder="Email" name="email" data-validation="required"></div>
	<div class="col-sm-12" style="padding-top:3px;">		
		<a name="btn_unuttum" class="pull-left"><input type="submit" name="btn_unuttum" class="btn btn-sm btn-primary" value="Şifre sıfırlama isteği gönder" /> </a>
	</div> 

   	
  </form>
</div>
</div>
</div>
 <script>
 $msgg=$(".error_messagee").text();
 if($msgg!="")
 {
	 $(".msg-danger").show("slow");
	 $(".msg-danger").delay(3000).hide("slow");
 }
 else{
	 $(".msg-danger").hide();
 }
 
  $msgg2=$(".error_messagee2").text();
 if($msgg2!="")
 {
	 $(".msg-success").show("slow");
	 $(".msg-success").delay(3000).hide("slow");
 }
 else{
	 $(".msg-success").hide();
 }


 </script>
<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
	$(".signin").show();
	$(".register").hide();
	$(".pass").hide();
		
    }
}
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
		$(".signin").hide();
		$(".register").show();
		$(".pass").hide();
    }
}
</script>
<script>
$(".kayit_btn").click(function(){
	$(".signinogr").hide();
	$(".register").show();
	$(".pass").hide();
});

$(".giris_btn").click(function(){
	$(".signinogr").show();
	$(".register").hide();
	$(".pass").hide();
});
$(".btn_passogr").click(function(){
	$(".signinogr").hide();
	$(".register").hide();
	$(".pass").show();
});
$(".cancelpassogr").click(function(){
	$(".signinogr").show();
	$(".pass").hide();
});

$(".btn_passden").click(function(){
	$(".signinak").hide();
	$(".register").hide();
	$(".passak").show();
});

$(".cancelpassden").click(function(){
	$(".signinak").show();
	$(".passak").hide();
});

</script>
     <script>


(function( jQuery, window, undefined ) {
  "use strict";

  var matched, browser;

  jQuery.uaMatch = function( ua ) {
    ua = ua.toLowerCase();

  	var match = /(opr)[\/]([\w.]+)/.exec( ua ) ||
  		/(chrome)[ \/]([\w.]+)/.exec( ua ) ||
  		/(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
  		/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
  		/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
  		/(msie) ([\w.]+)/.exec( ua ) ||
  		ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
  		ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
  		[];

  	var platform_match = /(ipad)/.exec( ua ) ||
  		/(iphone)/.exec( ua ) ||
  		/(android)/.exec( ua ) ||
  		/(windows phone)/.exec( ua ) ||
  		/(win)/.exec( ua ) ||
  		/(mac)/.exec( ua ) ||
  		/(linux)/.exec( ua ) ||
  		/(cros)/i.exec( ua ) ||
  		[];

  	return {
  		browser: match[ 3 ] || match[ 1 ] || "",
  		version: match[ 2 ] || "0",
  		platform: platform_match[ 0 ] || ""
  	};
  };

  matched = jQuery.uaMatch( window.navigator.userAgent );
  browser = {};

  if ( matched.browser ) {
  	browser[ matched.browser ] = true;
  	browser.version = matched.version;
  	browser.versionNumber = parseInt(matched.version);
  }

  if ( matched.platform ) {
  	browser[ matched.platform ] = true;
  }

  // These are all considered mobile platforms, meaning they run a mobile browser
  if ( browser.android || browser.ipad || browser.iphone || browser[ "windows phone" ] ) {
  	browser.mobile = true;
  }

  // These are all considered desktop platforms, meaning they run a desktop browser
  if ( browser.cros || browser.mac || browser.linux || browser.win ) {
  	browser.desktop = true;
  }

  // Chrome, Opera 15+ and Safari are webkit based browsers
  if ( browser.chrome || browser.opr || browser.safari ) {
  	browser.webkit = true;
  }

  // IE11 has a new token so we will assign it msie to avoid breaking changes
  if ( browser.rv )
  {
  	var ie = "msie";

  	matched.browser = ie;
  	browser[ie] = true;
  }

  // Opera 15+ are identified as opr
  if ( browser.opr )
  {
  	var opera = "opera";

  	matched.browser = opera;
  	browser[opera] = true;
  }

  // Stock Android browsers are marked as Safari on Android.
  if ( browser.safari && browser.android )
  {
  	var android = "android";

  	matched.browser = android;
  	browser[android] = true;
  }

  // Assign the name and platform variable
  browser.name = matched.browser;
  browser.platform = matched.platform;


  jQuery.browser = browser;
})( jQuery, window );

(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery);

/*     My Javascript      */

$(function(){

  $("#login-tel").mask("(0999) 999 99 99");


  
	

  $("#phone").on("blur", function() {
      var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

      if( last.length == 5 ) {
          var move = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );

          var lastfour = last.substr(1,4);

          var first = $(this).val().substr( 0, 9 );

          $(this).val( first + move + '-' + lastfour );
      }
  });

    	$("#sirket_Kaydet").click(function() {
					$deg=$("#sirket_tel").unmask();
					console.log($deg);
				});
}); 
	  </script>
	  <script>
	  

$.validate({
  form : '#kodal,#girisform'
});
  



function validate() {
  var pass = $("#kodal #login-password").val();
  var repass = $("#kodal #login-password2").val();

	if(pass != repass){
	alert("Şifreler eşleşmiyor !")
  }  
  else
  {	
 
	$.post($("#kodal").attr("action"), $("$kodal :input").serializeArray());		
  }
  return false;
}


$("#btn_kayit").bind("click", validate);
	  </script>
	  
<script>
function validates() {
	$("#file_error").html("");
	$(".input-material").css("border-color","#F0F0F0");
	var file_size = $('#resim')[0].files[0].size; 
	if(file_size>2097152) {
		$("#file_error").html("Resim 2MB'dan az olmalı");
		$("#file_error").css("color","red");
		return false;
	
	} 
	return true;
}
function dogru() {
	$("#file_error2").html("");
	 e =  $("#girisform #email").val();
	 s =  $("#girisform #sifre").val();

	$(".gkod").css("border-color","#F0F0F0");
	 var gkod = $("#girisform #gkod").val();
	  if(e=="" || s== "") {
		$("#file_error2").html("Boş alanları doldurunuz");
		$("#file_error2").css("color","red");
		return false;
	} 
	else if(gkod=="") {
		$("#file_error2").html("Güvenlik Kodu boş olamaz");
		$("#file_error2").css("color","red");
		return false;
	} 
	else if(gkod!=key) {
		$("#file_error2").html("Güvenlik Kodu hatalı");
		$("#file_error2").css("color","red");
		return false;
	}
	
	return true;
}
function dogru2() {
	$("#file_error2").html("");
	 e =  $("#girisform2 #email2").val();
	 s =  $("#girisform2 #sifre2").val();

	$(".gkod2").css("border-color","#F0F0F0");
	 var gkod = $("#girisform2 #gkod2").val();
	  if(e=="" || s== "") {
		$("#file_error3").html("Boş alanları doldurunuz");
		$("#file_error3").css("color","red");
		return false;
	} 
	else if(gkod=="") {
		$("#file_error3").html("Güvenlik Kodu boş olamaz");
		$("#file_error3").css("color","red");
		return false;
	} 
	else if(gkod!=key) {
		$("#file_error3").html("Güvenlik Kodu hatalı");
		$("#file_error3").css("color","red");
		return false;
	} 
	
	return true;
}
function girisKontrol() {
    var gkod = $("#girisform #gkod").val();
	
   if (gkod != key)
	{
		 return false;
	}
	else
	{	
		$( "#girisform" ).attr( "method", "post" );
		$( "#girisform" ).attr( "action", "<?=base_url();?>Login/logincontrol_ogrenci" );
		$.post($("#girisform").attr("action"), $("$girisform :input").serializeArray());
	 return true;
	}
	
	
}
function girisKontrol2() {
    var gkod = $("#girisform2 #gkod2").val();
	
   if (gkod != key)
	{
		 return false;
	}
	else
	{	
		$( "#girisform2" ).attr( "method", "post" );
		$( "#girisform2" ).attr( "action", "<?=base_url();?>Login/logincontrol_akademisyen" );
		$.post($("#girisform2").attr("action"), $("$girisform2 :input").serializeArray());
	 return true;
	}
	
	
}
var ctx;
var init=function()
{
ctx=document.getElementById("c").getContext("2d");
ctx.fillStyle="#bbeeff";
degis();
}
var init2=function()
{
ctx=document.getElementById("c2").getContext("2d");
ctx.fillStyle="#bbeeff";
degis();
}
var degis=function()
{
key="";
$("#file_error2").html("");
$("#file_error3").html("");
for(var i=0;i<6;i++)
{
var rnd= Math.random();
if(Math.round(rnd)==0)
key+=String.fromCharCode(48+9*Math.random());
else
key+=String.fromCharCode(65+25*Math.random());
}
ctx.clearRect(0,0,130,50);
ctx.fillRect(0,0,130,50);
ctx.font="30px calibri";
ctx.strokeText(key,10,24);

}

</script>
</body>
</html>
